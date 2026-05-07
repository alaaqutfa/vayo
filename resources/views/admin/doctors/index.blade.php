@extends('admin.layouts.admin')

@section('title', 'Doctors')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div
            class="mb-8 rounded-2xl bg-gradient-to-r from-primary/5 to-primary/10 p-6 backdrop-blur-sm dark:from-primary/20 dark:to-primary/5">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Doctors</h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Manage your medical team members.</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('admin.doctors.create') }}"
                        class="inline-flex items-center rounded-lg bg-primary px-5 py-2.5 text-sm font-medium text-white shadow-sm shadow-primary/20 transition-all hover:bg-primary/90">
                        <i class="bi bi-plus-lg mr-2 text-lg"></i> Add Doctor
                    </a>
                </div>
            </div>
        </div>

        {{-- Success Alert --}}
        @if(session('success'))
            <div class="mb-6 rounded-lg border-l-4 border-green-500 bg-green-50 p-4 dark:bg-green-900/30">
                <div class="flex items-center">
                    <i class="bi bi-check-circle-fill text-green-500 dark:text-green-400 mr-3 text-xl"></i>
                    <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- Doctors Table --}}
        <div
            class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800/50">
                        <tr>
                            <th
                                class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                ID</th>
                            <th
                                class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Image</th>
                            <th
                                class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Name</th>
                            <th
                                class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Specialty</th>
                            <th
                                class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Status</th>
                            <th
                                class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Active</th>
                            <th
                                class="px-4 py-4 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                        @forelse($doctors as $doctor)
                            <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $doctor->id }}</td>
                                <td class="whitespace-nowrap px-4 py-4">
                                    <img src="{{ $doctor->image_url }}" class="h-10 w-10 rounded-full object-cover shadow-sm">
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $doctor->name }}</td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $doctor->specialty }}</td>
                                <td class="whitespace-nowrap px-4 py-4">
                                    <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold
                                            @if($doctor->status == 'available') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300
                                            @elseif($doctor->status == 'busy') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300
                                            @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @endif">
                                        {{ ucfirst($doctor->status) }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4">
                                    <form action="{{ route('admin.doctors.toggle-status', $doctor) }}" method="POST"
                                        class="inline">
                                        @csrf @method('PATCH')
                                        <button type="submit"
                                            class="rounded-full px-2.5 py-0.5 text-xs font-medium transition-colors
                                                {{ $doctor->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200 dark:bg-green-900/30 dark:text-green-300' : 'bg-red-100 text-red-800 hover:bg-red-200 dark:bg-red-900/30 dark:text-red-300' }}">
                                            {{ $doctor->is_active ? 'Active' : 'Inactive' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-right text-sm font-medium">
                                    <a href="{{ route('admin.doctors.edit', $doctor) }}"
                                        class="inline-flex items-center text-primary hover:text-primary/80">
                                        <i class="bi bi-pencil-square mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST"
                                        class="inline ml-3" onsubmit="return confirm('Are you sure?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center text-red-600 hover:text-red-800">
                                            <i class="bi bi-trash3 mr-1"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                    No doctors found. <a href="{{ route('admin.doctors.create') }}"
                                        class="text-primary hover:underline">Add your first doctor</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(is_object($doctors) && method_exists($doctors, 'hasPages') && $doctors->hasPages())
                <div class="border-t border-gray-200 px-6 py-4 dark:border-gray-700">
                    {{ $doctors->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
