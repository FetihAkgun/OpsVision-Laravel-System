@extends('layouts.admin')

@section('title', __('incidents.show.title'))

@section('content')
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ __('incidents.show.title') }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    {{ $incident->title }}
                </p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.incidents.edit', $incident) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('incidents.show.actions.edit') }}
                </a>
                <form action="{{ route('admin.incidents.destroy', $incident) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('{{ __("incidents.show.actions.delete_confirm") }}')" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        {{ __('incidents.show.actions.delete') }}
                    </button>
                </form>
                <a href="{{ route('admin.incidents.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('incidents.show.actions.back') }}
                </a>
            </div>
        </div>
        
        <div class="px-4 py-5 sm:p-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">{{ __('incidents.show.details.title') }}</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $incident->title }}</dd>
                </div>
                
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">{{ __('incidents.show.details.description') }}</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $incident->description }}</dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">{{ __('incidents.show.details.status') }}</dt>
                    <dd class="mt-1 text-sm">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $incident->status === 'resolved' ? 'bg-green-100 text-green-800' : 
                           ($incident->status === 'monitoring' ? 'bg-blue-100 text-blue-800' : 
                           ($incident->status === 'identified' ? 'bg-yellow-100 text-yellow-800' : 
                           'bg-red-100 text-red-800')) }}">
                            {{ __("incidents.show.status.{$incident->status}") }}
                        </span>
                    </dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">{{ __('incidents.show.details.impact') }}</dt>
                    <dd class="mt-1 text-sm">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $incident->impact === 'minor' ? 'bg-green-100 text-green-800' : 
                           ($incident->impact === 'major' ? 'bg-yellow-100 text-yellow-800' : 
                           'bg-red-100 text-red-800') }}">
                            {{ __("incidents.show.impact.{$incident->impact}") }}
                        </span>
                    </dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">{{ __('incidents.show.details.start_date') }}</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $incident->started_at ? $incident->started_at->format('d.m.Y H:i') : 'N/A' }}
                    </dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">{{ __('incidents.show.details.resolution_date') }}</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $incident->resolved_at ? $incident->resolved_at->format('d.m.Y H:i') : 'N/A' }}
                    </dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">{{ __('incidents.show.details.visible') }}</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ __("incidents.show.visibility." . ($incident->visible ? 'yes' : 'no')) }}</dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">{{ __('incidents.show.details.created_at') }}</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $incident->created_at->format('d.m.Y H:i') }}</dd>
                </div>
                
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">{{ __('incidents.show.details.affected_services') }}</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @forelse($incident->services as $service)
                                <div class="p-3 border border-gray-200 rounded-md">
                                    <span class="font-medium">{{ $service->name }}</span>
                                    @if($service->description)
                                        <p class="text-xs text-gray-500 mt-1">{{ $service->description }}</p>
                                    @endif
                                </div>
                            @empty
                                <div class="text-gray-500">{{ __('incidents.show.details.no_services') }}</div>
                            @endforelse
                        </div>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
@endsection 