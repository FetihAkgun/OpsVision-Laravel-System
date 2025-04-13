@extends('layouts.admin')

@section('title', __('service-groups.edit.title'))

@section('content')
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ __('service-groups.edit.title') }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                {{ __('service-groups.edit.description') }}
            </p>
        </div>
        
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('admin.service-groups.update', $serviceGroup->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">{{ __('service-groups.edit.form.name') }}</label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('name', $serviceGroup->name) }}" required>
                        </div>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">{{ __('service-groups.edit.form.description') }}</label>
                        <div class="mt-1">
                            <textarea name="description" id="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('description', $serviceGroup->description) }}</textarea>
                        </div>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="display_order" class="block text-sm font-medium text-gray-700">{{ __('service-groups.edit.form.display_order') }}</label>
                        <div class="mt-1">
                            <input type="number" name="display_order" id="display_order" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('display_order', $serviceGroup->display_order) }}" min="0">
                        </div>
                        <p class="mt-2 text-sm text-gray-500">
                            {{ __('service-groups.edit.form.display_order_help') }}
                        </p>
                        @error('display_order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex justify-end">
                        <a href="{{ route('admin.service-groups.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('service-groups.edit.form.cancel') }}
                        </a>
                        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('service-groups.edit.form.submit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection 