@extends('layouts.admin')

@section('title', __('messages.incidents'))

@section('content')
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ __('messages.incidents') }}
            </h3>
            <a href="{{ route('admin.incidents.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none">
                {{ __('messages.report_incident') }}
            </a>
        </div>
        
        @if($incidents->isEmpty())
            <div class="px-4 py-5 sm:p-6 text-center">
                <p class="text-gray-500">{{ __('messages.no_incidents_found') }}</p>
                <a href="{{ route('admin.incidents.create') }}" class="mt-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none">
                    {{ __('messages.create_first_incident') }}
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('messages.title') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('messages.service') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('messages.status') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('messages.impact') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('messages.date') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('messages.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($incidents as $incident)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ Str::limit($incident->title, 40) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        @if($incident->services->isNotEmpty())
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($incident->services->take(2) as $service)
                                                    <span class="bg-gray-100 px-1 rounded text-xs">{{ $service->name }}</span>
                                                @endforeach
                                                @if($incident->services->count() > 2)
                                                    <span class="bg-gray-100 px-1 rounded text-xs">+{{ $incident->services->count() - 2 }}</span>
                                                @endif
                                            </div>
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColor = match($incident->status) {
                                            'investigating' => 'bg-yellow-100 text-yellow-800',
                                            'identified' => 'bg-blue-100 text-blue-800',
                                            'monitoring' => 'bg-indigo-100 text-indigo-800',
                                            'resolved' => 'bg-green-100 text-green-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };

                                        $statusText = match($incident->status) {
                                            'investigating' => __('messages.investigating'),
                                            'identified' => __('messages.identified'),
                                            'monitoring' => __('messages.monitoring'),
                                            'resolved' => __('messages.resolved'),
                                            default => ucfirst($incident->status),
                                        };
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $impactColor = match($incident->impact) {
                                            'critical' => 'bg-red-100 text-red-800',
                                            'major' => 'bg-orange-100 text-orange-800',
                                            'minor' => 'bg-yellow-100 text-yellow-800',
                                            'none' => 'bg-green-100 text-green-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };

                                        $impactText = match($incident->impact) {
                                            'critical' => __('messages.critical'),
                                            'major' => __('messages.major'),
                                            'minor' => __('messages.minor'),
                                            'none' => __('messages.none'),
                                            default => ucfirst($incident->impact),
                                        };
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $impactColor }}">
                                        {{ $impactText }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ $incident->created_at->format('d.m.Y H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.incidents.show', $incident->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                        {{ __('messages.view') }}
                                    </a>
                                    <a href="{{ route('admin.incidents.edit', $incident->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                        {{ __('messages.edit') }}
                                    </a>
                                    <form action="{{ route('admin.incidents.destroy', $incident->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('{{ __('messages.delete_incident_confirmation') }}')">
                                            {{ __('messages.delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection 