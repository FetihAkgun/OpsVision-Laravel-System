<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use App\Models\Service;
use App\Models\ServiceGroup;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $servicesCount = Service::count();
        $serviceGroupsCount = ServiceGroup::count();
        $activeIncidentsCount = Incident::active()->count();
        $serviceStatusSummary = [
            'operational' => Service::whereHas('latestStatus', function ($query) {
                $query->where('is_operational', true);
            })->count(),
            'issues' => Service::whereHas('latestStatus', function ($query) {
                $query->where('is_operational', false);
            })->count(),
            'not_checked' => Service::whereDoesntHave('statuses')->count(),
        ];

        return view('admin.dashboard.index', compact(
            'servicesCount', 
            'serviceGroupsCount', 
            'activeIncidentsCount',
            'serviceStatusSummary'
        ));
    }
}
