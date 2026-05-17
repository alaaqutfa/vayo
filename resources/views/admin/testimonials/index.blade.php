@extends('admin.layouts.admin')

@section('title', 'Manage Testimonials')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header with gradient card --}}
        <div class="mb-8 rounded-2xl bg-gradient-to-r from-primary/5 to-primary/10 p-6 backdrop-blur-sm dark:from-primary/20 dark:to-primary/5">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Testimonials</h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Manage patient testimonials and reviews.</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('admin.testimonials.create') }}"
                       class="inline-flex items-center rounded-lg bg-primary px-5 py-2.5 text-sm font-medium text-white shadow-sm shadow-primary/20 transition-all hover:bg-primary/90 hover:shadow-primary/30 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:ring-offset-gray-800">
                        <i class="bi bi-plus-lg mr-2 text-lg"></i> Add Testimonial
                    </a>
                </div>
            </div>
        </div>

        {{-- Success Alert --}}
        @if(session('success'))
            <div class="mb-6 rounded-lg border-l-4 border-green-500 bg-green-50 p-4 dark:bg-green-900/30" role="alert">
                <div class="flex items-center">
                    <i class="bi bi-check-circle-fill text-green-500 dark:text-green-400 mr-3 text-xl"></i>
                    <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- Testimonials Table Card --}}
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800/50">
                        <tr>
                            <th class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 sm:pl-6">ID</th>
                            <th class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Image</th>
                            <th class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Name</th>
                            <th class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Rating</th>
                            <th class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Status</th>
                            <th class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Order</th>
                            <th class="relative px-4 py-4 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 sm:pr-6">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                        @foreach($testimonials as $testimonial)
                            <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900 dark:text-white sm:pl-6">{{ $testimonial->id }}</td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    @if($testimonial->image)
                                        <img src="src="{{ asset('public/storage'.$testimonial->image) }}"
                                             class="h-10 w-10 rounded-full object-cover shadow-sm">
                                    @else
                                        <span class="flex items-center justify-center text-center text-bold h-10 w-10 rounded-full bg-gray-100 dark:bg-gray-700">{{ (substr($testimonial->name, 0, 1)) }}</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $testimonial->name }}</td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm">
                                    <div class="flex items-center gap-0.5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star-fill {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }} text-sm"></i>
                                        @endfor
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4">
                                    <form action="{{ route('admin.testimonials.toggle-status', $testimonial) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="rounded-full px-2.5 py-0.5 text-xs font-medium transition-colors
                                                {{ $testimonial->is_active
                                                    ? 'bg-green-100 text-green-800 hover:bg-green-200 dark:bg-green-900/30 dark:text-green-300 dark:hover:bg-green-900/50'
                                                    : 'bg-red-100 text-red-800 hover:bg-red-200 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50' }}">
                                            {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $testimonial->order }}</td>
                                <td class="whitespace-nowrap px-4 py-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                                       class="inline-flex items-center text-primary hover:text-primary/80 dark:text-primary/80">
                                        <i class="bi bi-pencil-square mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="inline ml-3" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center text-red-600 hover:text-red-800 dark:text-red-400">
                                            <i class="bi bi-trash3 mr-1"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($testimonials->hasPages())
                <div class="border-t border-gray-200 px-6 py-4 dark:border-gray-700">
                    {{ $testimonials->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
