@extends('admin.layouts.admin')

@section('title', 'Edit Doctor')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Doctor</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update "{{ $doctor->name }}" profile</p>
            </div>
            <a href="{{ route('admin.doctors.index') }}"
                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                <i class="bi bi-arrow-left mr-2"></i> Back to Doctors
            </a>
        </div>

        <div
            class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Edit Doctor Details</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Modify the fields below. Leave image empty to keep
                    current.</p>
            </div>
            <div class="px-6 py-6">
                <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $doctor->name) }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                                required>
                            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Specialty <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="specialty" value="{{ old('specialty', $doctor->specialty) }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                                required>
                            @error('specialty') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" name="email" value="{{ old('email', $doctor->email) }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $doctor->phone) }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Years of
                                Experience</label>
                            <input type="number" name="years_experience"
                                value="{{ old('years_experience', $doctor->years_experience) }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            @error('years_experience') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rating (0.0 -
                                5.0)</label>
                            <input type="number" step="0.1" name="rating" value="{{ old('rating', $doctor->rating) }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            @error('rating') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reviews Count</label>
                            <input type="number" name="reviews_count"
                                value="{{ old('reviews_count', $doctor->reviews_count) }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            @error('reviews_count') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select name="status"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                <option value="available" {{ old('status', $doctor->status) == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="busy" {{ old('status', $doctor->status) == 'busy' ? 'selected' : '' }}>Busy
                                </option>
                                <option value="offline" {{ old('status', $doctor->status) == 'offline' ? 'selected' : '' }}>
                                    Offline</option>
                            </select>
                            @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Display Order</label>
                            <input type="number" name="order" value="{{ old('order', $doctor->order) }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            @error('order') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Associated Service
                                (optional)</label>
                            <select name="service_id"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                <option value="">-- None --</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_id', $doctor->service_id) == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                                @endforeach
                            </select>
                            @error('service_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Biography</label>
                            <textarea name="bio" rows="4"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">{{ old('bio', $doctor->bio) }}</textarea>
                            @error('bio') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Profile Image</label>
                            @if($doctor->image)
                                <div class="mt-2 mb-3 flex items-center gap-3">
                                    <img src="{{ asset('public/storage/'.$doctor->image) }}" class="h-16 w-16 rounded-full object-cover shadow-sm">
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Current image (leave empty to
                                        keep)</span>
                                </div>
                            @endif
                            <div
                                class="mt-1 flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600">
                                <div class="space-y-1 text-center p-4">
                                    <i class="bi bi-cloud-upload text-3xl text-gray-400"></i>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                        <label for="image"
                                            class="relative cursor-pointer rounded-md font-medium text-primary hover:text-primary/80 focus-within:outline-none">
                                            <span>Upload new file</span>
                                            <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Square image recommended (PNG, JPG,
                                        WEBP up to 2MB, leave empty to keep current)</p>
                                </div>
                            </div>
                            @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $doctor->is_active) ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700">
                            <label for="is_active" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Active (visible on
                                frontend)</label>
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end border-t border-gray-200 pt-6 dark:border-gray-700">
                        <button type="submit"
                            class="inline-flex items-center rounded-lg bg-primary px-6 py-2.5 text-sm font-medium text-white shadow-sm shadow-primary/20 transition-all hover:bg-primary/90">
                            <i class="bi bi-save mr-2 text-lg"></i> Update Doctor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
