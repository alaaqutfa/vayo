@extends('admin.layouts.admin')

@section('title', __t('Edit Guide Category'))

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __t('Edit Guide Category') }}</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ __t('Update the selected guide category details.') }}</p>
            </div>
            <a href="{{ route('admin.guide-categories.index') }}"
                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                <i class="bi bi-arrow-left mr-2"></i> {{ __t('Back to Categories') }}
            </a>
        </div>

        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ __t('Category Information') }}</h2>
            </div>

            <form action="{{ route('admin.guide-categories.update', $guideCategory) }}" method="POST" class="px-6 py-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __t('Name') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $guideCategory->name) }}"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                            required>
                        @error('name') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __t('Slug') }}</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $guideCategory->slug) }}"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                        @error('slug') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="parent_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __t('Parent Category') }}</label>
                        <select name="parent_id" id="parent_id"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            <option value="">{{ __t('No parent') }}</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}" @selected(old('parent_id', $guideCategory->parent_id) == $parent->id)>{{ $parent->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_id') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __t('Icon (CSS class)') }}</label>
                        <input type="text" name="icon" id="icon" value="{{ old('icon', $guideCategory->icon) }}"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                            placeholder="bi bi-grid">
                        @error('icon') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __t('Display Order') }}</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $guideCategory->order) }}"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                        @error('order') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center pt-6">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $guideCategory->is_active) ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700">
                        <label for="is_active" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">{{ __t('Active') }}</label>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __t('Description') }}</label>
                    <textarea name="description" id="description" rows="5"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">{{ old('description', $guideCategory->description) }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <div class="mt-8 flex justify-end border-t border-gray-200 pt-6 dark:border-gray-700">
                    <button type="submit"
                        class="inline-flex items-center rounded-lg bg-primary px-6 py-2.5 text-sm font-medium text-white shadow-sm transition-all hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:ring-offset-gray-800">
                        <i class="bi bi-check-lg mr-2"></i> {{ __t('Save Changes') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

