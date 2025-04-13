@extends('layouts.admin')

@section('title', __('service-groups.show.title'))

@section('content')
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ $serviceGroup->name }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    {{ __('service-groups.show.description') }}
                </p>
            </div>
            <div>
                <a href="{{ route('admin.service-groups.edit', $serviceGroup->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('service-groups.show.actions.edit') }}
                </a>
            </div>
        </div>
        
        <div class="px-4 py-5 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">
                        {{ __('service-groups.show.details.name') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $serviceGroup->name }}
                    </dd>
                </div>
                
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">
                        {{ __('service-groups.show.details.display_order') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $serviceGroup->display_order }}
                    </dd>
                </div>
                
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">
                        {{ __('service-groups.show.details.description') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $serviceGroup->description ?: __('service-groups.show.details.no_description') }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>
    
    <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ __('service-groups.show.details.services') }}
            </h3>
            <a href="{{ route('admin.services.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none">
                {{ __('service-groups.show.actions.add_service') }}
            </a>
        </div>
        
        @if($serviceGroup->services->isEmpty())
            <div class="px-4 py-5 sm:p-6 text-center">
                <p class="text-gray-500">{{ __('service-groups.show.details.no_services') }}</p>
                <a href="{{ route('admin.services.create') }}" class="mt-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none">
                    {{ __('service-groups.show.actions.add_first_service') }}
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('service-groups.show.table.name') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('service-groups.show.table.url') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('service-groups.show.table.status') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('service-groups.show.table.display_order') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('service-groups.show.table.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($serviceGroup->services as $service)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $service->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ Str::limit($service->url, 40) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $latestStatus = $service->latestStatus;
                                        
                                        if ($latestStatus) {
                                            $statusColor = $latestStatus->is_operational ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                                            $statusText = $latestStatus->is_operational ? __('service-groups.show.status.operational') : __('service-groups.show.status.not_operational');
                                        } else {
                                            $statusColor = 'bg-gray-100 text-gray-800';
                                            $statusText = __('service-groups.show.status.not_checked');
                                        }
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ $service->display_order }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.services.show', $service->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                        {{ __('service-groups.show.table.view') }}
                                    </a>
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                        {{ __('service-groups.show.table.edit') }}
                                    </a>
                                    <a href="{{ route('admin.services.check', $service->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                        {{ __('service-groups.show.table.check') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection 