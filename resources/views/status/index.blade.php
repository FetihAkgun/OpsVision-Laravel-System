@extends('layouts.app')

@section('title', __('status.title'))

@section('content')
    <div class="space-y-8">
        @if($activeIncidents->count() > 0)
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            {{ __('status.active_incidents.warning') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ __('status.active_incidents.title') }}
                    </h3>
                </div>
                <ul class="divide-y divide-gray-200">
                    @foreach($activeIncidents as $incident)
                        <li>
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm font-medium text-indigo-600 truncate">
                                        {{ $incident->title }}
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        @switch($incident->impact)
                                            @case('critical')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    {{ __('status.active_incidents.impact.critical') }}
                                                </span>
                                                @break
                                            @case('major')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                                    {{ __('status.active_incidents.impact.major') }}
                                                </span>
                                                @break
                                            @case('minor')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    {{ __('status.active_incidents.impact.minor') }}
                                                </span>
                                                @break
                                            @default
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    {{ __('status.active_incidents.impact.none') }}
                                                </span>
                                        @endswitch
                                    </div>
                                </div>
                                <div class="mt-2 text-sm text-gray-500">
                                    <p>{{ $incident->description }}</p>
                                </div>
                                <div class="mt-2 text-xs text-gray-500">
                                    <p>{{ __('status.active_incidents.status') }}: <span class="font-semibold">{{ ucfirst($incident->status) }}</span></p>
                                    @if($incident->services->isNotEmpty())
                                        <p class="mt-1">{{ __('status.active_incidents.affected_services') }}: 
                                            <span class="font-semibold">
                                                @foreach($incident->services as $service)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{ $service->name }}
                                                    </span>
                                                    @if(!$loop->last) &nbsp; @endif
                                                @endforeach
                                            </span>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="bg-green-50 border-l-4 border-green-400 p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            {{ __('status.all_systems_operational') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        @foreach($serviceGroups as $group)
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $group->name }}
                    </h3>
                    @if($group->description)
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            {{ $group->description }}
                        </p>
                    @endif
                </div>
                <div>
                    <dl>
                        @foreach($group->services as $service)
                            @php
                                $latestStatus = $service->latestStatus;
                                $uptime = "99.9%";
                                
                                if ($latestStatus) {
                                    $statusColor = $latestStatus->is_operational ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                                    $statusText = $latestStatus->is_operational ? __('status.service.status.operational') : __('status.service.status.not_operational');
                                    $responseTime = $latestStatus->response_time ?? '-';
                                } else {
                                    $statusColor = 'bg-gray-100 text-gray-800';
                                    $statusText = __('status.service.status.not_checked');
                                    $responseTime = '-';
                                }
                                
                                $hasActiveIncident = $activeIncidents->filter(function($incident) use ($service) {
                                    return $incident->services->contains($service->id);
                                })->isNotEmpty();
                            @endphp
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 {{ !$loop->last ? 'border-b border-gray-200' : '' }}">
                                <dt class="text-sm font-medium text-gray-500 flex items-center">
                                    {{ $service->name }}
                                    @if($hasActiveIncident)
                                        <span class="ml-2 text-yellow-500" title="{{ __('status.active_incidents.incident_reported') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    @endif
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                                {{ $statusText }}
                                            </span>
                                            @if($responseTime != '-')
                                                <span class="ml-2 text-xs text-gray-500">
                                                    {{ $responseTime }}ms
                                                </span>
                                            @endif
                                            @if($hasActiveIncident)
                                                <span class="ml-2 px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">
                                                    {{ __('status.active_incidents.incident_reported') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ __('status.service.uptime', ['percentage' => $uptime]) }}
                                        </div>
                                    </div>
                                </dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>
        @endforeach
    </div>
@endsection 