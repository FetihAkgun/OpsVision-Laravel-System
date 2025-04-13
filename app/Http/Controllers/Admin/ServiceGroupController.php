<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceGroup;
use Illuminate\Http\Request;

class ServiceGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceGroups = ServiceGroup::withCount('services')
            ->orderBy('display_order')
            ->get();
        
        return view('admin.service-groups.index', compact('serviceGroups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.service-groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer',
        ]);

        $serviceGroup = ServiceGroup::create($validated);

        return redirect()->route('admin.service-groups.index')
            ->with('success', 'Service group created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $serviceGroup = ServiceGroup::with(['services' => function($query) {
            $query->orderBy('display_order');
        }])->findOrFail($id);
        
        return view('admin.service-groups.show', compact('serviceGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $serviceGroup = ServiceGroup::findOrFail($id);
        
        return view('admin.service-groups.edit', compact('serviceGroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $serviceGroup = ServiceGroup::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer',
        ]);

        $serviceGroup->update($validated);

        return redirect()->route('admin.service-groups.index')
            ->with('success', 'Service group updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $serviceGroup = ServiceGroup::findOrFail($id);
        
        // Check if there are services using this group
        if ($serviceGroup->services()->exists()) {
            return redirect()->route('admin.service-groups.index')
                ->with('error', 'Cannot delete service group with attached services.');
        }
        
        $serviceGroup->delete();

        return redirect()->route('admin.service-groups.index')
            ->with('success', 'Service group deleted successfully.');
    }
}
