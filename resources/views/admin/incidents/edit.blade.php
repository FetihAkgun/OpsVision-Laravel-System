@extends('layouts.admin')

@section('title', __('incidents.edit.title'))

@section('content')
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ __('incidents.edit.title') }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                {{ __('incidents.edit.description') }}
            </p>
        </div>
        
        <div class="px-4 py-5 sm:p-6">
            @if ($errors->any())
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                <p class="font-bold">{{ __('incidents.edit.form.validation.required_fields') }}</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <form action="{{ route('admin.incidents.update', $incident) }}" method="POST" id="incidentForm">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">{{ __('incidents.edit.form.title') }}</label>
                        <div class="mt-1">
                            <input type="text" name="title" id="title" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="{{ __('incidents.edit.form.title_placeholder') }}" value="{{ old('title', $incident->title) }}" required>
                        </div>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">{{ __('incidents.edit.form.description') }}</label>
                        <div class="mt-1">
                            <textarea name="description" id="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="{{ __('incidents.edit.form.description_placeholder') }}" required>{{ old('description', $incident->description) }}</textarea>
                        </div>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">{{ __('incidents.edit.form.status') }}</label>
                        <div class="mt-1">
                            <select id="status" name="status" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                @foreach(__('incidents.edit.status_options') as $value => $label)
                                    <option value="{{ $value }}" {{ old('status', $incident->status) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="impact" class="block text-sm font-medium text-gray-700">{{ __('incidents.edit.form.impact') }}</label>
                        <div class="mt-1">
                            <select id="impact" name="impact" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                @foreach(__('incidents.edit.impact_options') as $value => $label)
                                    <option value="{{ $value }}" {{ old('impact', $incident->impact) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('impact')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('incidents.edit.form.affected_services') }}</label>
                        <div class="mt-2 max-h-60 overflow-y-auto">
                            @foreach($services as $serviceId => $serviceName)
                            <div class="relative flex items-start py-2">
                                <div class="flex items-center h-5">
                                    <input id="service-{{ $serviceId }}" name="services[]" value="{{ $serviceId }}" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" 
                                        {{ (old('services', $selectedServices) && in_array($serviceId, old('services', $selectedServices))) ? 'checked' : '' }}>
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="service-{{ $serviceId }}" class="font-medium text-gray-700">{{ $serviceName }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @error('services')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <div>
                            <label for="started_at" class="block text-sm font-medium text-gray-700">{{ __('incidents.edit.form.start_date') }}</label>
                            <div class="mt-1">
                                <input type="datetime-local" name="started_at" id="started_at" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" 
                                    value="{{ old('started_at', $incident->started_at ? $incident->started_at->format('Y-m-d\TH:i') : '') }}">
                            </div>
                            <p class="mt-2 text-xs text-gray-500">
                                {{ __('incidents.edit.form.start_date_help') }}
                            </p>
                            @error('started_at')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="resolved_at" class="block text-sm font-medium text-gray-700">{{ __('incidents.edit.form.resolution_date') }}</label>
                            <div class="mt-1">
                                <input type="datetime-local" name="resolved_at" id="resolved_at" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" 
                                    value="{{ old('resolved_at', $incident->resolved_at ? $incident->resolved_at->format('Y-m-d\TH:i') : '') }}">
                            </div>
                            <p class="mt-2 text-xs text-gray-500">
                                {{ __('incidents.edit.form.resolution_date_help') }}
                            </p>
                            @error('resolved_at')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="relative flex items-start">
                        <div class="flex items-center h-5">
                            <input id="visible" name="visible" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" value="1" {{ old('visible', $incident->visible) ? 'checked' : '' }}>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="visible" class="font-medium text-gray-700">{{ __('incidents.edit.form.visible') }}</label>
                            <p class="text-gray-500">{{ __('incidents.edit.form.visible_help') }}</p>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <a href="{{ route('admin.incidents.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('incidents.edit.form.cancel') }}
                        </a>
                        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="submitButton">
                            {{ __('incidents.edit.form.submit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('incidentForm');
        const submitButton = document.getElementById('submitButton');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const servicesSelected = document.querySelectorAll('input[name="services[]"]:checked');
            if (servicesSelected.length === 0) {
                alert('{{ __("incidents.edit.form.validation.no_services") }}');
                return false;
            }
            
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');
            let errorMessages = [];
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('border-red-500');
                    errorMessages.push(`${field.name} alanı boş olamaz.`);
                    isValid = false;
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            if (!isValid) {
                alert('{{ __("incidents.edit.form.validation.required_fields") }}\n\n' + errorMessages.join('\n'));
                return false;
            }
            
            form.submit();
        });
        
        form.addEventListener('submit', function() {
            submitButton.disabled = true;
            submitButton.innerHTML = '{{ __("incidents.edit.form.saving") }}';
        });
    });
</script>
@endpush 