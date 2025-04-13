@extends('layouts.admin')

@section('title', __('messages.services'))

@section('content')
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ __('messages.services') }}
            </h3>
            <a href="{{ route('admin.services.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none">
                {{ __('messages.add_new_service') }}
            </a>
        </div>
        
        @if($services->isEmpty())
            <div class="px-4 py-5 sm:p-6 text-center">
                <p class="text-gray-500">{{ __('messages.no_services_found') }}</p>
                <a href="{{ route('admin.services.create') }}" class="mt-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none">
                    {{ __('messages.create_first_service') }}
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('messages.name') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('messages.group') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('messages.url') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('messages.status') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('messages.active') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('messages.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($services as $service)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $service->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ $service->serviceGroup->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ Str::limit($service->url, 30) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $latestStatus = $service->latestStatus;
                                        
                                        if ($latestStatus) {
                                            $statusColor = $latestStatus->is_operational ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                                            $statusText = $latestStatus->is_operational ? __('messages.working') : __('messages.not_working');
                                        } else {
                                            $statusColor = 'bg-gray-100 text-gray-800';
                                            $statusText = __('messages.not_checked');
                                        }
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $service->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $service->active ? __('messages.yes') : __('messages.no') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.services.show', $service->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                        {{ __('messages.view') }}
                                    </a>
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                        {{ __('messages.edit') }}
                                    </a>
                                    <a href="{{ route('admin.services.check', $service->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                        {{ __('messages.check') }}
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