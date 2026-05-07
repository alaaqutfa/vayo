@extends('admin.layouts.admin')

@section('title', 'Add Testimonial')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header with back button --}}
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Add New Testimonial</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Create a patient review or testimonial</p>
            </div>
            <a href="{{ route('admin.testimonials.index') }}"
               class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                <i class="bi bi-arrow-left mr-2"></i> Back to Testimonials
            </a>
        </div>

        {{-- Form Card --}}
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Testimonial Information</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Fill in the details below to add a new testimonial.</p>
            </div>
            <div class="px-6 py-6">
                <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                        {{-- Left Column --}}
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                                       required>
                                @error('name') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Position / Title</label>
                                <input type="text" name="position" id="position" value="{{ old('position') }}"
                                       placeholder="e.g. Patient, CEO"
                                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm">
                                @error('position') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="rating" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rating (1-5) <span class="text-red-500">*</span></label>
                                <select name="rating" id="rating"
                                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                                        required>
                                    <option value="5" {{ old('rating', 5) == 5 ? 'selected' : '' }}>5 ★★★★★</option>
                                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 ★★★★☆</option>
                                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 ★★★☆☆</option>
                                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 ★★☆☆☆</option>
                                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 ★☆☆☆☆</option>
                                </select>
                                @error('rating') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Display Order</label>
                                <input type="number" name="order" id="order" value="{{ old('order', 0) }}"
                                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                @error('order') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                       class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700">
                                <label for="is_active" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Active (visible on frontend)</label>
                            </div>
                        </div>

                        {{-- Right Column --}}
                        <div class="space-y-6">
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Testimonial Text <span class="text-red-500">*</span></label>
                                <textarea name="content" id="content" rows="6"
                                          class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                                          required>{{ old('content') }}</textarea>
                                @error('content') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Profile Image</label>
                                <div class="mt-1 flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 px-6 pt-5 pb-6 dark:border-gray-600">
                                    <div class="space-y-1 text-center">
                                        <i class="bi bi-cloud-upload text-3xl text-gray-400"></i>
                                        <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                            <label for="image" class="relative cursor-pointer rounded-md font-medium text-primary hover:text-primary/80 focus-within:outline-none">
                                                <span>Upload a file</span>
                                                <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Square image recommended (PNG, JPG, WEBP up to 2MB)</p>
                                    </div>
                                </div>
                                @error('image') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end border-t border-gray-200 pt-6 dark:border-gray-700">
                        <button type="submit"
                                class="inline-flex items-center rounded-lg bg-primary px-6 py-2.5 text-sm font-medium text-white shadow-sm shadow-primary/20 transition-all hover:bg-primary/90 hover:shadow-primary/30 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:ring-offset-gray-800">
                            <i class="bi bi-check-lg mr-2 text-lg"></i> Create Testimonial
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
