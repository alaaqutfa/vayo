@extends('admin.layouts.admin')

@section('title', 'Gallery')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header with gradient card --}}
        <div class="mb-8 rounded-2xl bg-gradient-to-r from-primary/5 to-primary/10 p-6 backdrop-blur-sm dark:from-primary/20 dark:to-primary/5">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Gallery</h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Manage images, before/after results, reels, and video links.</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('admin.galleries.create') }}"
                       class="inline-flex items-center rounded-lg bg-primary px-5 py-2.5 text-sm font-medium text-white shadow-sm shadow-primary/20 transition-all hover:bg-primary/90 hover:shadow-primary/30 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:ring-offset-gray-800">
                        <i class="bi bi-plus-lg mr-2 text-lg"></i> Add New
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

        {{-- Gallery Table Card --}}
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800/50">
                        <tr>
                            <th class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 sm:pl-6">ID</th>
                            <th class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Type</th>
                            <th class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Preview</th>
                            <th class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Title</th>
                            <th class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Status</th>
                            <th class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Order</th>
                            <th class="relative px-4 py-4 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 sm:pr-6">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                        @foreach($galleries as $item)
                            <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900 dark:text-white sm:pl-6">{{ $item->id }}</td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm">
                                    @if($item->type == 'image')
                                        <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-blue-900/30 dark:text-gray-300" style="color: #33FF99 !important;">
                                            <i class="bi bi-image mr-1 text-xs"></i> Image
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-purple-100 px-2.5 py-0.5 text-xs font-medium text-purple-800 dark:bg-purple-900/30 dark:text-purple-300">
                                            <i class="bi bi-youtube mr-1 text-xs"></i> Video
                                        </span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    @if($item->type == 'image')
                                        @if($item->image)
                                            <img src="{{ asset($item->image) }}" loading="lazy"
                                                 class="h-10 w-10 rounded-lg object-cover shadow-sm">
                                        @elseif($item->before_image)
                                            <div class="flex items-center gap-1">
                                                <img src="{{ asset($item->before_image) }}" loading="lazy"
                                                     class="h-8 w-8 rounded object-cover">
                                                <i class="bi bi-arrow-right-short text-gray-500"></i>
                                                <img src="{{ asset($item->after_image) }}" loading="lazy"
                                                     class="h-8 w-8 rounded object-cover">
                                            </div>
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    @else
                                        <i class="bi bi-youtube text-2xl text-red-600 dark:text-red-400"></i>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 dark:text-white">{{ $item->title ?? '—' }}</td>
                                <td class="whitespace-nowrap px-4 py-4">
                                    <form action="{{ route('admin.galleries.toggle-status', $item) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="rounded-full px-2.5 py-0.5 text-xs font-medium transition-colors
                                                {{ $item->is_active
                                                    ? 'bg-green-100 text-green-800 hover:bg-green-200 dark:bg-green-900/30 dark:text-green-300 dark:hover:bg-green-900/50'
                                                    : 'bg-red-100 text-red-800 hover:bg-red-200 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50' }}">
                                            {{ $item->is_active ? 'Active' : 'Inactive' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $item->order }}</td>
                                <td class="whitespace-nowrap px-4 py-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="{{ route('admin.galleries.edit', $item) }}"
                                       class="inline-flex items-center text-primary hover:text-primary/80 dark:text-primary/80">
                                        <i class="bi bi-pencil-square mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.galleries.destroy', $item) }}" method="POST" class="inline ml-3" onsubmit="return confirm('Are you sure?');">
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
            @if($galleries->hasPages())
                <div class="border-t border-gray-200 px-6 py-4 dark:border-gray-700">
                    {{ $galleries->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
