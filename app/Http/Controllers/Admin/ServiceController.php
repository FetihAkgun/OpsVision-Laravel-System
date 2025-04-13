<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceGroup;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JsonException;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with(['serviceGroup', 'latestStatus'])
            ->orderBy('display_order')
            ->get();
        
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $serviceGroups = ServiceGroup::orderBy('name')->pluck('name', 'id');
        return view('admin.services.create', compact('serviceGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Custom validation for JSON fields
        $rules = [
            'service_group_id' => 'required|exists:service_groups,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',
            'method' => 'required|in:GET,POST,PUT,PATCH,DELETE',
            'headers' => 'nullable',
            'payload' => 'nullable',
            'timeout' => 'nullable|integer|min:1|max:60',
            'expected_status_code' => 'nullable|integer',
            'display_order' => 'nullable|integer',
            'active' => 'boolean',
        ];
        
        // Ensure active is either 0 or 1
        if (!$request->has('active')) {
            $request->merge(['active' => false]);
        } else {
            // Convert string values to boolean
            $active = $request->input('active');
            if (is_string($active)) {
                $request->merge(['active' => $active === '1' || $active === 'true' || $active === 'on']);
            }
        }

        // Create custom validator to handle JSON validation separately
        $validator = Validator::make($request->all(), $rules);

        // Validate JSON fields separately
        $validator->after(function ($validator) use ($request) {
            // Check headers format if provided
            if ($request->filled('headers')) {
                try {
                    json_decode($request->headers, true, 512, JSON_THROW_ON_ERROR);
                } catch (JsonException $e) {
                    $validator->errors()->add('headers', 'The headers field must contain valid JSON: ' . $e->getMessage());
                }
            }
            
            // Check payload format if provided
            if ($request->filled('payload')) {
                try {
                    json_decode($request->payload, true, 512, JSON_THROW_ON_ERROR);
                } catch (JsonException $e) {
                    $validator->errors()->add('payload', 'The payload field must contain valid JSON: ' . $e->getMessage());
                }
            }
        });

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create service with validated data
        $validated = $validator->validated();
        $service = Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::with(['serviceGroup', 'statuses' => function($query) {
            $query->latest()->limit(20);
        }])->findOrFail($id);
        
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        $serviceGroups = ServiceGroup::orderBy('name')->pluck('name', 'id');
        
        return view('admin.services.edit', compact('service', 'serviceGroups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);
        
        // Custom validation for JSON fields
        $rules = [
            'service_group_id' => 'required|exists:service_groups,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',
            'method' => 'required|in:GET,POST,PUT,PATCH,DELETE',
            'headers' => 'nullable',
            'payload' => 'nullable',
            'timeout' => 'nullable|integer|min:1|max:60',
            'expected_status_code' => 'nullable|integer',
            'display_order' => 'nullable|integer',
            'active' => 'boolean',
        ];
        
        // Ensure active is either 0 or 1
        if (!$request->has('active')) {
            $request->merge(['active' => false]);
        } else {
            // Convert string values to boolean
            $active = $request->input('active');
            if (is_string($active)) {
                $request->merge(['active' => $active === '1' || $active === 'true' || $active === 'on']);
            }
        }

        // Create custom validator to handle JSON validation separately
        $validator = Validator::make($request->all(), $rules);

        // Validate JSON fields separately
        $validator->after(function ($validator) use ($request) {
            // Check headers format if provided
            if ($request->filled('headers')) {
                try {
                    json_decode($request->headers, true, 512, JSON_THROW_ON_ERROR);
                } catch (JsonException $e) {
                    $validator->errors()->add('headers', 'The headers field must contain valid JSON: ' . $e->getMessage());
                }
            }
            
            // Check payload format if provided
            if ($request->filled('payload')) {
                try {
                    json_decode($request->payload, true, 512, JSON_THROW_ON_ERROR);
                } catch (JsonException $e) {
                    $validator->errors()->add('payload', 'The payload field must contain valid JSON: ' . $e->getMessage());
                }
            }
        });

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update service with validated data
        $validated = $validator->validated();
        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    /**
     * Check service status
     */
    public function check(string $id, ApiService $apiService)
    {
        $service = Service::findOrFail($id);
        $status = $apiService->checkService($service);

        return redirect()->route('admin.services.show', $service->id)
            ->with('success', 'Service checked successfully. Status: ' . 
                  ($status->is_operational ? 'Operational' : 'Not Operational'));
    }
}
