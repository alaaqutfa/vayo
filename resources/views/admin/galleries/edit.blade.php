@extends('admin.layouts.admin')

@section('title', 'Edit Gallery Item')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Gallery Item</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update item #{{ $gallery->id }}</p>
            </div>
            <a href="{{ route('admin.galleries.index') }}"
                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                <i class="bi bi-arrow-left mr-2"></i> Back to Gallery
            </a>
        </div>

        <div
            class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Edit Gallery Item</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Modify the fields below. Leave file inputs empty to keep
                    existing files.</p>
            </div>
            <div class="px-6 py-6">
                <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="space-y-8">
                        {{-- Type Selection --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type <span
                                    class="text-red-500">*</span></label>
                            <div class="mt-2 flex flex-wrap gap-6">
                                <label
                                    class="inline-flex cursor-pointer items-center rounded-lg border border-gray-300 px-4 py-2 transition-all has-[:checked]:border-primary has-[:checked]:bg-primary/5 dark:border-gray-600 dark:has-[:checked]:border-primary">
                                    <input type="radio" name="type" value="image"
                                        class="form-radio text-primary focus:ring-primary" {{ old('type', $gallery->type) == 'image' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300"><i
                                            class="bi bi-image mr-1"></i> Image / Before-After</span>
                                </label>
                                <label
                                    class="inline-flex cursor-pointer items-center rounded-lg border border-gray-300 px-4 py-2 transition-all has-[:checked]:border-primary has-[:checked]:bg-primary/5 dark:border-gray-600 dark:has-[:checked]:border-primary">
                                    <input type="radio" name="type" value="video"
                                        class="form-radio text-primary focus:ring-primary" {{ old('type', $gallery->type) == 'video' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300"><i
                                            class="bi bi-play-circle mr-1 text-primary"></i> Video / Embed</span>
                                </label>
                            </div>
                            @error('type') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-amber-600 dark:text-amber-400">
                                <i class="bi bi-exclamation-triangle mr-1"></i> Changing type will clear previously uploaded
                                images or embed data.
                            </p>
                        </div>

                        {{-- Image Fields --}}
                        <div id="image-fields"
                            class="{{ old('type', $gallery->type) == 'video' ? 'hidden' : '' }} space-y-6">
                            {{-- Main Image --}}
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Main
                                    Image</label>
                                <div
                                    class="mt-1 flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 px-6 pt-5 pb-6 dark:border-gray-600">
                                    <div class="space-y-1 text-center">
                                        <i class="bi bi-cloud-upload text-3xl text-gray-400"></i>
                                        <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                            <label for="image"
                                                class="relative cursor-pointer rounded-md font-medium text-primary hover:text-primary/80">
                                                <span>Upload new image</span>
                                                <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">JPG, PNG, WEBP up to 5MB (leave
                                            empty to keep current)</p>
                                    </div>
                                </div>
                                {{-- Preview for new image --}}
                                <div id="image-preview" class="mt-3 hidden">
                                    <img id="image-preview-img" class="h-20 w-20 rounded-lg object-cover shadow-sm">
                                    <button type="button" id="clear-image" class="text-xs text-red-600 mt-1">Remove new
                                        selection</button>
                                </div>
                                @if($gallery->image)
                                    <div class="mt-2 mb-3" id="current-image-container">
                                        <img src="{{ asset('storage/' . $gallery->image) }}"
                                            class="h-20 w-20 rounded-lg object-cover shadow-sm">
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Current image (leave empty to
                                            keep)</p>
                                    </div>
                                @endif
                                @error('image') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid gap-6 sm:grid-cols-2">
                                {{-- Before Image --}}
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
                                                    <span>Choose new file</span>
                                                    <input id="before_image" name="before_image" type="file"
                                                        accept="image/*" class="sr-only">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="before-preview" class="mt-3 hidden">
                                        <img id="before-preview-img" class="h-16 w-16 rounded object-cover shadow-sm">
                                        <button type="button" id="clear-before" class="text-xs text-red-600 mt-1">Remove new
                                            selection</button>
                                    </div>
                                    @if($gallery->before_image)
                                        <div class="mt-2 mb-2" id="current-before-container">
                                            <img src="{{ asset('storage/' . $gallery->before_image) }}"
                                                class="h-16 w-16 rounded object-cover shadow-sm">
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Current</p>
                                        </div>
                                    @endif
                                    @error('before_image') <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                        {{ $message }}
                                    </p> @enderror
                                </div>

                                {{-- After Image --}}
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
                                                    <span>Choose new file</span>
                                                    <input id="after_image" name="after_image" type="file" accept="image/*"
                                                        class="sr-only">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="after-preview" class="mt-3 hidden">
                                        <img id="after-preview-img" class="h-16 w-16 rounded object-cover shadow-sm">
                                        <button type="button" id="clear-after" class="text-xs text-red-600 mt-1">Remove new
                                            selection</button>
                                    </div>
                                    @if($gallery->after_image)
                                        <div class="mt-2 mb-2" id="current-after-container">
                                            <img src="{{ asset('storage/' . $gallery->after_image) }}"
                                                class="h-16 w-16 rounded object-cover shadow-sm">
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Current</p>
                                        </div>
                                    @endif
                                    @error('after_image') <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                        {{ $message }}
                                    </p> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Video Fields --}}
                        <div id="video-fields"
                            class="{{ old('type', $gallery->type) == 'image' ? 'hidden' : '' }} space-y-6">
                            <div>
                                <label for="video_url"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Video URL <span
                                        class="text-xs text-gray-500">(optional)</span></label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="bi bi-play-btn text-gray-500 dark:text-gray-400"></i>
                                    </div>
                                    <input type="url" name="video_url" id="video_url"
                                        value="{{ old('video_url', $gallery->video_url) }}"
                                        placeholder="https://example.com/video.mp4 or https://youtu.be/..."
                                        class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                </div>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Direct video file (.mp4/.webm) or
                                    platform URL (YouTube, Vimeo, etc.)</p>
                                @error('video_url') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}
                                </p> @enderror
                            </div>

                            <div>
                                <label for="embed_code"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Embed Code <span
                                        class="text-xs text-gray-500">(optional)</span></label>
                                <textarea name="embed_code" id="embed_code" rows="4"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white font-mono text-sm"
                                    placeholder='<iframe src="https://www.instagram.com/p/.../embed" ...></iframe>'>{{ old('embed_code', $gallery->embed_code) }}</textarea>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Paste embed code from Instagram,
                                    TikTok, Facebook, YouTube, etc. Leave empty if you use Video URL.</p>
                            </div>
                        </div>

                        {{-- Common Fields --}}
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title
                                    (Optional)</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $gallery->title) }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                            <div>
                                <label for="order"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Order</label>
                                <input type="number" name="order" id="order" value="{{ old('order', $gallery->order) }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                        </div>

                        <div>
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description
                                (Optional)</label>
                            <textarea name="description" id="description" rows="3"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">{{ old('description', $gallery->description) }}</textarea>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700">
                            <label for="is_active" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Active
                                (visible on frontend)</label>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end border-t border-gray-200 pt-6 dark:border-gray-700">
                        <button type="submit"
                            class="inline-flex items-center rounded-lg bg-primary px-6 py-2.5 text-sm font-medium text-white shadow-sm shadow-primary/20 transition-all hover:bg-primary/90 hover:shadow-primary/30 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:ring-offset-gray-800">
                            <i class="bi bi-save mr-2 text-lg"></i> Update Gallery Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Toggle image/video fields
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
                toggleFields();

                // Preview function that hides the "current" container when a new file is selected
                function setupPreview(inputId, previewContainerId, imgId, clearBtnId, currentContainerId = null) {
                    const input = document.getElementById(inputId);
                    const container = document.getElementById(previewContainerId);
                    const img = document.getElementById(imgId);
                    const clearBtn = document.getElementById(clearBtnId);
                    const currentContainer = currentContainerId ? document.getElementById(currentContainerId) : null;

                    if (!input) return;

                    input.addEventListener('change', function (e) {
                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (ev) {
                                img.src = ev.target.result;
                                container.classList.remove('hidden');
                                if (currentContainer) currentContainer.style.display = 'none';
                            }
                            reader.readAsDataURL(file);
                        } else {
                            container.classList.add('hidden');
                            if (currentContainer) currentContainer.style.display = '';
                        }
                    });

                    if (clearBtn) {
                        clearBtn.addEventListener('click', function () {
                            input.value = '';
                            container.classList.add('hidden');
                            img.src = '';
                            if (currentContainer) currentContainer.style.display = '';
                        });
                    }
                }

                // Main image
                setupPreview('image', 'image-preview', 'image-preview-img', 'clear-image', 'current-image-container');
                // Before image
                setupPreview('before_image', 'before-preview', 'before-preview-img', 'clear-before', 'current-before-container');
                // After image
                setupPreview('after_image', 'after-preview', 'after-preview-img', 'clear-after', 'current-after-container');
            });
        </script>
    @endpush
@endsection
