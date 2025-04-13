<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\ServiceGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StatusPageController extends Controller
{
    public function index()
    {
        $serviceGroups = ServiceGroup::with(['services' => function($query) {
            $query->orderBy('display_order');
        }, 'services.latestStatus'])->orderBy('display_order')->get();

        // Aktif ve görünür incident'ları al
        $activeIncidents = Incident::where('status', '!=', 'resolved')
            ->where('visible', true)
            ->with('services')
            ->latest()
            ->get();
        
        return view('status.index', compact('serviceGroups', 'activeIncidents'));
    }


    public function iframe()
    {
        $activeIncidents = Incident::where('status', '!=', 'resolved')
            ->where('visible', true)
            ->with('services')
            ->latest()
            ->get();

        return view('status.iframe', compact('activeIncidents'));
    }
}
