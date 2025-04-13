<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incidents = Incident::with('services')
            ->latest()
            ->get();
        
        return view('admin.incidents.index', compact('incidents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::orderBy('name')->pluck('name', 'id');
        $statuses = ['investigating', 'identified', 'monitoring', 'resolved'];
        $impacts = ['none', 'minor', 'major', 'critical'];
        
        return view('admin.incidents.create', compact('services', 'statuses', 'impacts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Tüm inputları yakala ve loglama
            $allInputs = $request->all();
            Log::info('Incident create - form verileri:', $allInputs);
            
            // Özellikle servisleri loglama
            Log::info('Servis seçimleri:', [
                'services_array' => $request->input('services', []),
                'has_services' => $request->has('services'),
                'services_count' => count($request->input('services', [])),
            ]);
            
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'status' => 'required|in:investigating,identified,monitoring,resolved',
                'impact' => 'required|in:none,minor,major,critical',
                'services' => 'required|array', // En az bir servis seçilmesi zorunlu
                'services.*' => 'exists:services,id',
                'started_at' => 'nullable|date',
                'resolved_at' => 'nullable|date',
                'visible' => 'nullable|boolean', // nullable ekledik
            ], [
                'services.required' => 'En az bir servis seçmelisiniz.',
                'services.*.exists' => 'Seçilen bir veya daha fazla servis veritabanında bulunamadı.',
                'title.required' => 'Başlık alanı boş bırakılamaz.',
                'description.required' => 'Açıklama alanı boş bırakılamaz.',
                'status.required' => 'Durum seçilmelidir.',
                'impact.required' => 'Etki seviyesi seçilmelidir.',
            ]);
            
            if ($validator->fails()) {
                Log::warning('Incident validation failed:', [
                    'errors' => $validator->errors()->toArray(),
                    'input' => $request->all()
                ]);
                return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
            }
            
            $validated = $validator->validated();
            
            // visible değeri checkbox olarak gönderilirse, son gelen değeri kullan
            // (HTML'de önce hidden field (0), sonra checkbox (1) geliyor, 
            // checkbox işaretlenirse 1 değeri kullanılır, işaretlenmezse sadece 0 gönderilir)
            $validated['visible'] = (bool)$request->input('visible');
            
            // Automatically set started_at if not provided
            if (empty($validated['started_at'])) {
                $validated['started_at'] = now();
            }

            // Automatically set resolved_at if status is resolved
            if ($validated['status'] === 'resolved' && empty($validated['resolved_at'])) {
                $validated['resolved_at'] = now();
            }

            // Remove services from main data
            $services = $validated['services'] ?? [];
            unset($validated['services']);

            // Logla
            Log::info('Incident create - validated verileri:', $validated);
            Log::info('Servisler sync edilecek:', ['services' => $services]);
            
            $incident = Incident::create($validated);
            Log::info('Incident oluşturuldu:', ['incident_id' => $incident->id]);

            // Attach services
            if (!empty($services)) {
                $incident->services()->sync($services);
                Log::info('Incident servisler eklendi:', [
                    'incident_id' => $incident->id, 
                    'services' => $services,
                    'pivot_table_query' => 'INSERT INTO incident_service (incident_id, service_id) VALUES...'
                ]);
            } else {
                Log::warning('Servis seçimi olmadan incident oluşturuldu!', ['incident_id' => $incident->id]);
            }

            return redirect()->route('admin.incidents.index')
                ->with('success', 'Incident created successfully.');
                
        } catch (\Exception $e) {
            Log::error('Incident oluşturulurken hata:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Incident oluşturulurken bir hata oluştu: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $incident = Incident::with('services')->findOrFail($id);
        
        return view('admin.incidents.show', compact('incident'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $incident = Incident::with('services')->findOrFail($id);
        $services = Service::orderBy('name')->pluck('name', 'id');
        $statuses = ['investigating', 'identified', 'monitoring', 'resolved'];
        $impacts = ['none', 'minor', 'major', 'critical'];
        
        // Seçili servislerin ID'lerini al
        $selectedServices = $incident->services->pluck('id')->toArray();
        
        return view('admin.incidents.edit', compact('incident', 'services', 'statuses', 'impacts', 'selectedServices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $incident = Incident::findOrFail($id);
        
        // Debug için mevcut visible değerini logla
        Log::debug("Incident #{$id} update edilmeden önce: visible=" . ($incident->visible ? 'true' : 'false'));
        Log::debug("Update için gelen visible değeri: " . json_encode($request->input('visible')));
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:investigating,identified,monitoring,resolved',
            'impact' => 'required|in:none,minor,major,critical',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
            'started_at' => 'nullable|date',
            'resolved_at' => 'nullable|date',
            'visible' => 'nullable|boolean',
        ]);

        // Başlangıç ​​tarihi sağlanmadıysa ve yoksa ekle
        if (empty($validated['started_at']) && empty($incident->started_at)) {
            $validated['started_at'] = now();
        }

        // Çözüldü durumuna geçtiğinde tarih ekle
        if ($validated['status'] === 'resolved' && $incident->status !== 'resolved') {
            $validated['resolved_at'] = now();
        }
        
        // Çözüldü durumundan başka bir duruma geçince çözülme tarihini temizle
        if ($validated['status'] !== 'resolved') {
            $validated['resolved_at'] = null;
        }
        
        // Servisleri ayrı işle
        $services = $request->input('services', []);
        unset($validated['services']);
        
        // Visible değerinin doğru atanmasını sağla
        // Checkbox'lar unchecked olduğunda request'te hiç gelmez, bu yüzden has kontrolü yapılmalı
        $validated['visible'] = (bool)$request->input('visible');
        
        // Debug için yeni değerleri loglayalım
        Log::debug("Incident #{$id} update edilecek visible değeri: " . ($validated['visible'] ? 'true' : 'false'));

        $incident->update($validated);
        
        // Servisleri güncelle
        $incident->services()->sync($services);
        
        Log::debug("Incident #{$id} update tamamlandı, yeni visible değeri: " . ($incident->visible ? 'true' : 'false'));

        return redirect()->route('admin.incidents.index')
            ->with('success', 'Incident updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $incident = Incident::findOrFail($id);
        $incident->delete();

        return redirect()->route('admin.incidents.index')
            ->with('success', 'Incident deleted successfully.');
    }
}
