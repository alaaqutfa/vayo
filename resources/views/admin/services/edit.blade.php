@extends('admin.layouts.admin')

@section('title', 'Edit Service')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Service</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update details for "{{ $service->name }}"</p>
            </div>
            <a href="{{ route('admin.services.index') }}"
               class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                <i class="bi bi-arrow-left mr-2"></i> Back to Services
            </a>
        </div>

        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Service Information</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Modify the fields below to update this service.</p>
            </div>
            <div class="px-6 py-6">
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Service Name <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}"
                                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                                       required>
                                @error('name') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="icon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Icon (CSS class)</label>
                                <div class="relative mt-1">
                                    <input type="text" name="icon" id="icon" value="{{ old('icon', $service->icon) }}"
                                           placeholder="bi bi-heart-pulse"
                                           class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                    <i class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 {{ $service->icon }}"></i>
                                </div>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Use Bootstrap Icons class (e.g., bi bi-briefcase)</p>
                                @error('icon') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Service Image</label>
                                @if($service->image)
                                    <div class="mt-2 mb-3">
                                        <img src="{{ asset('public/storage/'.$service->image) }}" class="h-24 w-24 rounded-lg object-cover shadow-sm">
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Current image</p>
                                    </div>
                                @endif
                                <div class="mt-1 flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 px-6 pt-5 pb-6 dark:border-gray-600">
                                    <div class="space-y-1 text-center">
                                        <i class="bi bi-cloud-upload text-3xl text-gray-400"></i>
                                        <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                            <label for="image" class="relative cursor-pointer rounded-md font-medium text-primary hover:text-primary/80 focus-within:outline-none">
                                                <span>Upload a new file</span>
                                                <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP up to 2MB (leave empty to keep current)</p>
                                    </div>
                                </div>
                                @error('image') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Display Order</label>
                                <input type="number" name="order" id="order" value="{{ old('order', $service->order) }}"
                                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                @error('order') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                                       class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700">
                                <label for="is_active" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Active (visible on frontend)</label>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description <span class="text-red-500">*</span></label>
                                <textarea name="description" id="description" rows="6"
                                          class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                                          required>{{ old('description', $service->description) }}</textarea>
                                @error('description') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Features (key points)</label>
                                <div id="features-container" class="space-y-3 mt-2">
                                    @if(old('features'))
                                        @foreach(old('features') as $feature)
                                            <div class="feature-row flex gap-2">
                                                <input type="text" name="features[]" value="{{ $feature }}"
                                                       class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                                <button type="button" class="remove-feature rounded-lg bg-red-100 px-3 py-2 text-sm text-red-700 transition-colors hover:bg-red-200 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50">Remove</button>
                                            </div>
                                        @endforeach
                                    @else
                                        @php $features = is_array($service->features) ? $service->features : json_decode($service->features, true) ?? []; @endphp
                                        @forelse($features as $feature)
                                            <div class="feature-row flex gap-2">
                                                <input type="text" name="features[]" value="{{ $feature }}"
                                                       class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                                <button type="button" class="remove-feature rounded-lg bg-red-100 px-3 py-2 text-sm text-red-700 transition-colors hover:bg-red-200 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50">Remove</button>
                                            </div>
                                        @empty
                                            <div class="feature-row flex gap-2">
                                                <input type="text" name="features[]" placeholder="e.g., 24/7 Emergency Cardiac Care"
                                                       class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                                <button type="button" class="remove-feature hidden rounded-lg bg-red-100 px-3 py-2 text-sm text-red-700 transition-colors hover:bg-red-200 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50">Remove</button>
                                            </div>
                                        @endforelse
                                    @endif
                                </div>
                                <button type="button" id="add-feature"
                                        class="mt-3 inline-flex items-center rounded-lg text-sm font-medium text-primary transition-colors hover:text-primary/80 dark:text-primary/80 dark:hover:text-primary">
                                    <i class="bi bi-plus-circle mr-1"></i> Add another feature
                                </button>
                            </div>
                        </div>
                    </div>

                    @include('admin.partials.media-manager', [
                        'modelType' => 'Service',
                        'modelId' => $service->id,
                        'collection' => 'gallery'
                    ])

                    <div class="mt-8 flex justify-end border-t border-gray-200 pt-6 dark:border-gray-700">
                        <button type="submit"
                                class="inline-flex items-center rounded-lg bg-primary px-6 py-2.5 text-sm font-medium text-white shadow-sm shadow-primary/20 transition-all hover:bg-primary/90 hover:shadow-primary/30 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:ring-offset-gray-800">
                            <i class="bi bi-save mr-2 text-lg"></i> Update Service
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('features-container');
                const addBtn = document.getElementById('add-feature');

                function updateRemoveButtons() {
                    const rows = container.querySelectorAll('.feature-row');
                    rows.forEach((row, idx) => {
                        const removeBtn = row.querySelector('.remove-feature');
                        if (rows.length > 1) {
                            removeBtn.classList.remove('hidden');
                        } else {
                            removeBtn.classList.add('hidden');
                        }
                    });
                }

                addBtn.addEventListener('click', () => {
                    const newRow = document.createElement('div');
                    newRow.className = 'feature-row flex gap-2 mt-3';
                    newRow.innerHTML = `
                        <input type="text" name="features[]" placeholder="New feature" class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                        <button type="button" class="remove-feature rounded-lg bg-red-100 px-3 py-2 text-sm text-red-700 transition-colors hover:bg-red-200 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50">Remove</button>
                    `;
                    container.appendChild(newRow);
                    updateRemoveButtons();
                });

                container.addEventListener('click', (e) => {
                    if (e.target.classList.contains('remove-feature')) {
                        e.target.closest('.feature-row').remove();
                        updateRemoveButtons();
                    }
                });

                updateRemoveButtons();
            });
        </script>
    @endpush
@endsection
