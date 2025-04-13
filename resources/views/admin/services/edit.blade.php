@extends('layouts.admin')

@section('title', __('messages.edit_service'))

@section('content')
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ __('messages.edit_service') }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                {{ __('messages.edit_service_desc') }}
            </p>
        </div>
        
        <div class="px-4 py-5 sm:p-6">
            <!-- Error Alert -->
            <div id="errorAlert" class="hidden mb-4 bg-red-50 border-l-4 border-red-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            {{ __('messages.form_validation_errors') }}
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul id="errorList" class="list-disc pl-5 space-y-1">
                                <!-- Error items will be inserted here by JavaScript -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- If Laravel validation errors exist -->
            @if ($errors->any())
            <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            {{ __('messages.validation_errors_occurred') }}
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            <form action="{{ route('admin.services.update', $service) }}" method="POST" id="serviceForm">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <div>
                        <label for="service_group_id" class="block text-sm font-medium text-gray-700">{{ __('messages.service_group') }}</label>
                        <div class="mt-1">
                            <select id="service_group_id" name="service_group_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option value="">{{ __('messages.select_group') }}</option>
                                @foreach($serviceGroups as $id => $name)
                                    <option value="{{ $id }}" {{ old('service_group_id', $service->service_group_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('service_group_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">{{ __('messages.service_name') }}</label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="{{ __('messages.service_name') }}" value="{{ old('name', $service->name) }}" required>
                        </div>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">{{ __('messages.description') }}</label>
                        <div class="mt-1">
                            <textarea name="description" id="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="{{ __('messages.description') }}">{{ old('description', $service->description) }}</textarea>
                        </div>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="url" class="block text-sm font-medium text-gray-700">{{ __('messages.service_url') }}</label>
                        <div class="mt-1">
                            <input type="url" name="url" id="url" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="https://api.example.com/status" value="{{ old('url', $service->url) }}" required>
                        </div>
                        @error('url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <div>
                            <label for="method" class="block text-sm font-medium text-gray-700">{{ __('messages.method') }}</label>
                            <div class="mt-1">
                                <select id="method" name="method" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    @foreach(['GET', 'POST', 'PUT', 'PATCH', 'DELETE'] as $method)
                                        <option value="{{ $method }}" {{ old('method', $service->method) == $method ? 'selected' : '' }}>{{ $method }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('method')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="expected_status_code" class="block text-sm font-medium text-gray-700">{{ __('messages.expected_status_code') }}</label>
                            <div class="mt-1">
                                <input type="number" name="expected_status_code" id="expected_status_code" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="200" value="{{ old('expected_status_code', $service->expected_status_code) }}">
                            </div>
                            @error('expected_status_code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <div>
                            <label for="timeout" class="block text-sm font-medium text-gray-700">{{ __('messages.service_timeout') }}</label>
                            <div class="mt-1">
                                <input type="number" name="timeout" id="timeout" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="5" value="{{ old('timeout', $service->timeout) }}" min="1" max="60">
                            </div>
                            @error('timeout')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="display_order" class="block text-sm font-medium text-gray-700">{{ __('messages.service_group_display_order') }}</label>
                            <div class="mt-1">
                                <input type="number" name="display_order" id="display_order" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="0" value="{{ old('display_order', $service->display_order) }}" min="0">
                            </div>
                            @error('display_order')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                        <label for="headers" class="block text-sm font-medium text-gray-700">{{ __('messages.headers') }}</label>
                        <div class="mt-1">
                            <textarea name="headers" id="headers" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md font-mono" placeholder='{"Authorization": "Bearer token", "Content-Type": "application/json"}'>{{ old('headers', $service->headers) }}</textarea>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">
                            {{ __('messages.headers_help') }}
                        </p>
                        @error('headers')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="payload" class="block text-sm font-medium text-gray-700">{{ __('messages.payload') }}</label>
                        <div class="mt-1">
                            <textarea name="payload" id="payload" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md font-mono" placeholder='{"key": "value"}'>{{ old('payload', $service->payload) }}</textarea>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">
                            {{ __('messages.payload_help') }}
                        </p>
                        @error('payload')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="relative flex items-start">
                        <div class="flex items-center h-5">
                            <input id="active" name="active" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ old('active', $service->active) ? 'checked' : '' }}>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="active" class="font-medium text-gray-700">{{ __('messages.service_active') }}</label>
                            <p class="text-gray-500">{{ __('messages.service_active_help') }}</p>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <a href="{{ route('admin.services.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('messages.service_cancel') }}
                        </a>
                        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('messages.update') }}
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
        const form = document.getElementById('serviceForm');
        const headersField = document.getElementById('headers');
        const payloadField = document.getElementById('payload');
        const errorAlert = document.getElementById('errorAlert');
        const errorList = document.getElementById('errorList');
        
        // Format JSON on blur
        headersField.addEventListener('blur', function() {
            formatJsonField(headersField);
        });
        
        payloadField.addEventListener('blur', function() {
            formatJsonField(payloadField);
        });
        
        // Validate form before submit
        form.addEventListener('submit', function(e) {
            // Clear previous errors
            errorList.innerHTML = '';
            errorAlert.classList.add('hidden');
            
            // Get all required fields
            const requiredFields = form.querySelectorAll('[required]');
            let hasErrors = false;
            let errorMessages = [];
            
            // Check required fields
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('border-red-500');
                    const fieldName = field.previousElementSibling?.textContent || field.name;
                    errorMessages.push(`${fieldName.trim()} {{ __('messages.field_required') }}`);
                    hasErrors = true;
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            // Validate JSON fields
            if (headersField.value.trim()) {
                try {
                    JSON.parse(headersField.value);
                } catch (e) {
                    headersField.classList.add('border-red-500');
                    errorMessages.push('{{ __('messages.invalid_json_headers') }}');
                    hasErrors = true;
                }
            }
            
            if (payloadField.value.trim()) {
                try {
                    JSON.parse(payloadField.value);
                } catch (e) {
                    payloadField.classList.add('border-red-500');
                    errorMessages.push('{{ __('messages.invalid_json_payload') }}');
                    hasErrors = true;
                }
            }
            
            if (hasErrors) {
                e.preventDefault();
                errorMessages.forEach(message => {
                    const li = document.createElement('li');
                    li.textContent = message;
                    errorList.appendChild(li);
                });
                errorAlert.classList.remove('hidden');
            }
        });
        
        function formatJsonField(field) {
            if (field.value.trim()) {
                try {
                    const json = JSON.parse(field.value);
                    field.value = JSON.stringify(json, null, 2);
                } catch (e) {
                    // Invalid JSON, leave as is
                }
            }
        }
    });
</script>
@endpush 