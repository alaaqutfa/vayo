@extends('admin.layouts.admin')

@section('title', 'Add Gallery Item')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header with back button --}}
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Add New Gallery Item</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Upload image (standard or before/after) or embed a
                    video link</p>
            </div>
            <a href="{{ route('admin.galleries.index') }}"
                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                <i class="bi bi-arrow-left mr-2"></i> Back to Gallery
            </a>
        </div>

        {{-- Form Card --}}
        <div
            class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Gallery Item Details</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Select type and fill in the required fields.</p>
            </div>
            <div class="px-6 py-6">
                <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-8">
                        {{-- Type Selection --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type <span
                                    class="text-red-500">*</span></label>
                            <div class="mt-2 flex flex-wrap gap-6">
                                <label
                                    class="inline-flex cursor-pointer items-center rounded-lg border border-gray-300 px-4 py-2 transition-all has-[:checked]:border-primary has-[:checked]:bg-primary/5 dark:border-gray-600 dark:has-[:checked]:border-primary">
                                    <input type="radio" name="type" value="image"
                                        class="form-radio text-primary focus:ring-primary" {{ old('type', 'image') == 'image' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                        <i class="bi bi-image mr-1"></i> Image / Before-After
                                    </span>
                                </label>
                                <label
                                    class="inline-flex cursor-pointer items-center rounded-lg border border-gray-300 px-4 py-2 transition-all has-[:checked]:border-primary has-[:checked]:bg-primary/5 dark:border-gray-600 dark:has-[:checked]:border-primary">
                                    <input type="radio" name="type" value="video"
                                        class="form-radio text-primary focus:ring-primary" {{ old('type') == 'video' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                        <i class="bi bi-youtube mr-1 text-red-600"></i> video link
                                    </span>
                                </label>
                            </div>
                            @error('type') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Image Fields (shown when type = image) --}}
                        <div id="image-fields" class="{{ old('type', 'image') == 'video' ? 'hidden' : '' }} space-y-6">
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Main
                                    Image <span class="text-red-500">*</span></label>
                                <div
                                    class="mt-1 flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 px-6 pt-5 pb-6 dark:border-gray-600">
                                    <div class="space-y-1 text-center">
                                        <i class="bi bi-cloud-upload text-3xl text-gray-400"></i>
                                        <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                            <label for="image"
                                                class="relative cursor-pointer rounded-md font-medium text-primary hover:text-primary/80 focus-within:outline-none">
                                                <span>Upload main image</span>
                                                <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">JPG, PNG, WEBP up to 5MB</p>
                                    </div>
                                </div>
                                @error('image') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid gap-6 sm:grid-cols-2">
                                <div>
                                    <label for="before_image"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Before Image
                                        (Optional)</label>
                                    <div
                                        class="mt-1 flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 px-4 pt-4 pb-4 dark:border-gray-600">
                                        <div class="space-y-1 text-center">
                                            <i class="bi bi-camera text-2xl text-gray-400"></i>
                                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                                <label for="before_image"
                                                    class="relative cursor-pointer rounded-md font-medium text-primary hover:text-primary/80">
                                                    <span>Choose file</span>
                                                    <input id="before_image" name="before_image" type="file"
                                                        accept="image/*" class="sr-only">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('before_image') <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="after_image"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">After Image
                                        (Optional)</label>
                                    <div
                                        class="mt-1 flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 px-4 pt-4 pb-4 dark:border-gray-600">
                                        <div class="space-y-1 text-center">
                                            <i class="bi bi-camera text-2xl text-gray-400"></i>
                                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                                <label for="after_image"
                                                    class="relative cursor-pointer rounded-md font-medium text-primary hover:text-primary/80">
                                                    <span>Choose file</span>
                                                    <input id="after_image" name="after_image" type="file" accept="image/*"
                                                        class="sr-only">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('after_image') <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Video Fields (shown when type = video) --}}
                        <div id="video-fields" class="{{ old('type', 'image') == 'image' ? 'hidden' : '' }}">
                            <label for="video_url"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Video URL <span
                                    class="text-red-500">*</span></label>
                            <div class="relative mt-1">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="bi bi-youtube text-red-600 dark:text-red-400"></i>
                                </div>
                                <input type="url" name="video_url" id="video_url" value="{{ old('video_url') }}"
                                    placeholder="https://example.com/video.mp4 or https://youtu.be/..."
                                    class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm">
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Only Video URLs are accepted (e.g.,
                                https://youtu.be/... or https://example.com/video.mp4 or https://youtu.be/...)</p>
                            @error('video_url') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Common Fields --}}
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title
                                    (Optional)</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                            <div>
                                <label for="order"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Order</label>
                                <input type="number" name="order" id="order" value="{{ old('order', 0) }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                        </div>

                        <div>
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description
                                (Optional)</label>
                            <textarea name="description" id="description" rows="3"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm">{{ old('description') }}</textarea>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700">
                            <label for="is_active" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Active
                                (visible on frontend)</label>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end border-t border-gray-200 pt-6 dark:border-gray-700">
                        <button type="submit"
                            class="inline-flex items-center rounded-lg bg-primary px-6 py-2.5 text-sm font-medium text-white shadow-sm shadow-primary/20 transition-all hover:bg-primary/90 hover:shadow-primary/30 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:ring-offset-gray-800">
                            <i class="bi bi-check-lg mr-2 text-lg"></i> Add Gallery Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const radios = document.querySelectorAll('input[name="type"]');
                const imageFields = document.getElementById('image-fields');
                const videoFields = document.getElementById('video-fields');

                function toggleFields() {
                    const selectedType = document.querySelector('input[name="type"]:checked').value;
                    if (selectedType === 'image') {
                        imageFields.classList.remove('hidden');
                        videoFields.classList.add('hidden');
                    } else {
                        imageFields.classList.add('hidden');
                        videoFields.classList.remove('hidden');
                    }
                }

                radios.forEach(radio => radio.addEventListener('change', toggleFields));
                toggleFields(); // initial state
            });
        </script>
    @endpush
@endsection
