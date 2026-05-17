@extends('admin.layouts.admin')

@section('title', 'Edit Page')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header with back button --}}
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Page</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update "{{ $page->title }}" content</p>
            </div>
            <a href="{{ route('admin.pages.index') }}"
                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                <i class="bi bi-arrow-left mr-2"></i> Back to Pages
            </a>
        </div>

        {{-- Form Card --}}
        <div
            class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Edit Page Details</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Modify the fields below. Leave image empty to keep
                    current.</p>
            </div>
            <div class="px-6 py-6">
                <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="space-y-8">
                        {{-- Title & Order --}}
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title
                                    <span class="text-red-500">*</span></label>
                                <input type="text" name="title" id="title" value="{{ old('title', $page->title) }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                                    required>
                                @error('title') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="order"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Order</label>
                                <input type="number" name="order" id="order" value="{{ old('order', $page->order) }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                @error('order') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Featured Image --}}
                        <div>
                            <label for="featured_image"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Featured Image</label>
                            @if($page->featured_image)
                                <div class="mt-2 mb-3">
                                    <img src="{{ asset('public/storage'.$page->featured_image) }}"
                                        class="h-20 w-auto rounded-lg object-cover shadow-sm">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Current image (leave empty to keep)
                                    </p>
                                </div>
                            @endif
                            <div
                                class="mt-1 flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 px-6 pt-5 pb-6 dark:border-gray-600">
                                <div class="space-y-1 text-center">
                                    <i class="bi bi-cloud-upload text-3xl text-gray-400"></i>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                        <label for="featured_image"
                                            class="relative cursor-pointer rounded-md font-medium text-primary hover:text-primary/80 focus-within:outline-none">
                                            <span>Upload new image</span>
                                            <input id="featured_image" name="featured_image" type="file" accept="image/*"
                                                class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP up to 2MB (leave
                                        empty to keep current)</p>
                                </div>
                            </div>
                            @error('featured_image') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}
                            </p> @enderror
                        </div>

                        {{-- Content (CKEditor) --}}
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content
                                <span class="text-red-500">*</span></label>
                            <textarea name="content" id="editor" rows="10"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                required>{{ old('content', $page->content) }}</textarea>
                            @error('content') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Meta Description --}}
                        <div>
                            <label for="meta_description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Description (for
                                SEO)</label>
                            <textarea name="meta_description" id="meta_description" rows="3"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">{{ old('meta_description', $page->meta_description) }}</textarea>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Recommended: 150-160 characters.</p>
                            @error('meta_description') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}
                            </p> @enderror
                        </div>

                        {{-- Active Checkbox --}}
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $page->is_active) ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700">
                            <label for="is_active" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Active
                                (visible on frontend)</label>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end border-t border-gray-200 pt-6 dark:border-gray-700">
                        <button type="submit"
                            class="inline-flex items-center rounded-lg bg-primary px-6 py-2.5 text-sm font-medium text-white shadow-sm shadow-primary/20 transition-all hover:bg-primary/90 hover:shadow-primary/30 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:ring-offset-gray-800">
                            <i class="bi bi-save mr-2 text-lg"></i> Update Page
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        {{-- CKEditor 5 Classic CDN --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                ClassicEditor
                    .create(document.querySelector('#editor'), {
                        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo'],
                        heading: {
                            options: [
                                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                            ]
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        </script>
    @endpush
@endsection
