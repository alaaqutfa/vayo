@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8 rounded-2xl bg-gradient-to-r from-primary/5 to-primary/10 p-6 backdrop-blur-sm dark:from-primary/20 dark:to-primary/5">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Welcome back, {{ Auth::user()->name }}!</p>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="group relative overflow-hidden rounded-xl bg-white shadow-md transition-all hover:shadow-lg dark:bg-gray-800">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary shadow-sm dark:bg-primary/20">
                            <i class="bi bi-briefcase text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Services</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\Service::count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-100 bg-gray-50/50 px-6 py-3 dark:border-gray-700 dark:bg-gray-800/50">
                    <div class="text-xs text-gray-500 dark:text-gray-400">All published services</div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-xl bg-white shadow-md transition-all hover:shadow-lg dark:bg-gray-800">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary shadow-sm dark:bg-primary/20">
                            <i class="bi bi-chat-quote text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Testimonials</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\Testimonial::count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-100 bg-gray-50/50 px-6 py-3 dark:border-gray-700 dark:bg-gray-800/50">
                    <div class="text-xs text-gray-500 dark:text-gray-400">Client feedback & reviews</div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-xl bg-white shadow-md transition-all hover:shadow-lg dark:bg-gray-800">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary shadow-sm dark:bg-primary/20">
                            <i class="bi bi-images text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Gallery Items</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\Gallery::count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-100 bg-gray-50/50 px-6 py-3 dark:border-gray-700 dark:bg-gray-800/50">
                    <div class="text-xs text-gray-500 dark:text-gray-400">Images & media assets</div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-xl bg-white shadow-md transition-all hover:shadow-lg dark:bg-gray-800">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary shadow-sm dark:bg-primary/20">
                            <i class="bi bi-files text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pages</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\Page::count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-100 bg-gray-50/50 px-6 py-3 dark:border-gray-700 dark:bg-gray-800/50">
                    <div class="text-xs text-gray-500 dark:text-gray-400">Published content pages</div>
                </div>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
                <div class="border-b border-gray-200 bg-gray-50/50 px-6 py-4 dark:border-gray-700 dark:bg-gray-800/50">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Services</h3>
                        <a href="{{ route('admin.services.index') }}" class="text-sm text-primary hover:underline dark:text-primary/80">View all</a>
                    </div>
                </div>
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse(\App\Models\Service::latest()->take(5)->get() as $service)
                        <div class="flex items-center justify-between px-6 py-4 transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10 text-primary">
                                    <i class="bi bi-box-seam text-sm"></i>
                                </div>
                                <span class="font-medium text-gray-800 dark:text-gray-200">{{ $service->name }}</span>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $service->created_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                            <i class="bi bi-inbox text-3xl"></i>
                            <p class="mt-2">No services yet.</p>
                            <a href="{{ route('admin.services.create') }}" class="mt-2 inline-block text-sm text-primary hover:underline">Create first service →</a>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
                <div class="border-b border-gray-200 bg-gray-50/50 px-6 py-4 dark:border-gray-700 dark:bg-gray-800/50">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Testimonials</h3>
                        <a href="{{ route('admin.testimonials.index') }}" class="text-sm text-primary hover:underline dark:text-primary/80">View all</a>
                    </div>
                </div>
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse(\App\Models\Testimonial::latest()->take(5)->get() as $testimonial)
                        <div class="flex items-center justify-between px-6 py-4 transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary">
                                    <i class="bi bi-person-circle text-sm"></i>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-800 dark:text-gray-200">{{ $testimonial->name }}</span>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-1">{{ \Str::limit($testimonial->content, 50) }}</p>
                                </div>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $testimonial->created_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                            <i class="bi bi-chat-dots text-3xl"></i>
                            <p class="mt-2">No testimonials yet.</p>
                            <a href="{{ route('admin.testimonials.create') }}" class="mt-2 inline-block text-sm text-primary hover:underline">Add first testimonial →</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="mt-8 rounded-xl bg-gradient-to-r from-primary/5 to-primary/10 p-6 backdrop-blur-sm dark:from-primary/20 dark:to-primary/5">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Quick Actions</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Manage content and settings with one click</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.services.create') }}" class="inline-flex items-center rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm transition-all hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:ring-offset-gray-800">
                        <i class="bi bi-plus-lg mr-2"></i> Add Service
                    </a>
                    <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        <i class="bi bi-chat-right-quote mr-2"></i> Add Testimonial
                    </a>
                    <a href="{{ route('admin.galleries.create') }}" class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        <i class="bi bi-image mr-2"></i> Upload to Gallery
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
