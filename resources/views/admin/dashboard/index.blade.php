@extends('layouts.admin')

@section('title', __('messages.dashboard'))

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Services -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                {{ __('messages.total_services') }}
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">{{ $servicesCount }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-4 sm:px-6">
                <div class="text-sm">
                    <a href="{{ route('admin.services.index') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        {{ __('messages.view_all_services') }} <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service Groups -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                {{ __('messages.service_groups') }}
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">{{ $serviceGroupsCount }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-4 sm:px-6">
                <div class="text-sm">
                    <a href="{{ route('admin.service-groups.index') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        {{ __('messages.view_all_groups') }} <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Active Incidents -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                {{ __('messages.active_incidents') }}
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">{{ $activeIncidentsCount }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-4 sm:px-6">
                <div class="text-sm">
                    <a href="{{ route('admin.incidents.index') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        {{ __('messages.view_all_incidents') }} <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service Status -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                {{ __('messages.service_status') }}
                            </dt>
                            <dd>
                                <div class="text-sm text-gray-900 mt-1">
                                    <div class="flex items-center">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $serviceStatusSummary['operational'] }} {{ __('messages.operational') }}
                                        </span>
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ $serviceStatusSummary['issues'] }} {{ __('messages.issues') }}
                                        </span>
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $serviceStatusSummary['not_checked'] }} {{ __('messages.not_checked') }}
                                        </span>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-4 sm:px-6">
                <div class="text-sm">
                    <a href="{{ route('status.index') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        {{ __('messages.view_status_page') }} <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ __('messages.quick_actions') }}
            </h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <a href="{{ route('admin.services.create') }}" class="block p-6 bg-gray-50 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('messages.add_new_service') }}</h3>
                    <p class="mt-2 text-sm text-gray-500">{{ __('messages.add_new_service_desc') }}</p>
                </a>
                
                <a href="{{ route('admin.service-groups.create') }}" class="block p-6 bg-gray-50 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('messages.create_service_group') }}</h3>
                    <p class="mt-2 text-sm text-gray-500">{{ __('messages.create_service_group_desc') }}</p>
                </a>
                
                <a href="{{ route('admin.incidents.create') }}" class="block p-6 bg-gray-50 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('messages.report_incident') }}</h3>
                    <p class="mt-2 text-sm text-gray-500">{{ __('messages.report_incident_desc') }}</p>
                </a>
            </div>
        </div>
    </div>
@endsection 