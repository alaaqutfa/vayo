@extends('admin.layouts.admin')

@section('title', 'Appointments')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header with gradient card --}}
        <div
            class="mb-8 rounded-2xl bg-gradient-to-r from-primary/5 to-primary/10 p-6 backdrop-blur-sm dark:from-primary/20 dark:to-primary/5">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Appointments</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Manage patient appointment requests</p>
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

        {{-- Appointments Table Card --}}
        <div
            class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800/50">
                        <tr>
                            <th
                                class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 sm:pl-6">
                                ID</th>
                            <th
                                class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Name</th>
                            <th
                                class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Email</th>
                            <th
                                class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Phone</th>
                            <th
                                class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Date</th>
                            <th
                                class="px-4 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Status</th>
                            <th
                                class="relative px-4 py-4 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 sm:pr-6">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                        @foreach($appointments as $app)
                            <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                <td
                                    class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900 dark:text-white sm:pl-6">
                                    {{ $app->id }}</td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 dark:text-white">{{ $app->name }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $app->email }}</td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $app->phone }}</td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $app->date }} @if($app->time) {{ $app->time }} @endif</td>
                                <td class="whitespace-nowrap px-4 py-4">
                                    <form action="{{ route('admin.appointments.update-status', $app) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                            class="rounded-lg border-gray-300 text-sm shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white
                                                        {{ $app->status == 'pending' ? 'border-yellow-300 bg-yellow-50 dark:bg-yellow-900/30' : '' }}
                                                        {{ $app->status == 'confirmed' ? 'border-green-300 bg-green-50 dark:bg-green-900/30' : '' }}
                                                        {{ $app->status == 'cancelled' ? 'border-red-300 bg-red-50 dark:bg-red-900/30' : '' }}">
                                            <option value="pending" {{ $app->status == 'pending' ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="confirmed" {{ $app->status == 'confirmed' ? 'selected' : '' }}>
                                                Confirmed</option>
                                            <option value="cancelled" {{ $app->status == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="{{ route('admin.appointments.show', $app) }}"
                                        class="inline-flex items-center text-primary hover:text-primary/80 dark:text-primary/80">
                                        <i class="bi bi-eye mr-1"></i> View
                                    </a>
                                    <form action="{{ route('admin.appointments.destroy', $app) }}" method="POST"
                                        class="inline ml-3" onsubmit="return confirm('Delete this appointment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center text-red-600 hover:text-red-800 dark:text-red-400">
                                            <i class="bi bi-trash3 mr-1"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($appointments->hasPages())
                <div class="border-t border-gray-200 px-6 py-4 dark:border-gray-700">
                    {{ $appointments->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
