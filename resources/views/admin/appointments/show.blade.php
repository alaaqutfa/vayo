@extends('admin.layouts.admin')

@section('title', 'Appointment Details')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header with back button --}}
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Appointment Details</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">View and manage appointment #{{ $appointment->id }}
                </p>
            </div>
            <a href="{{ route('admin.appointments.index') }}"
                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                <i class="bi bi-arrow-left mr-2"></i> Back to Appointments
            </a>
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

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            {{-- Main Information Card --}}
            <div class="lg:col-span-2">
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Patient Information</h2>
                    </div>
                    <div class="px-6 py-6">
                        <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</dt>
                                <dd class="mt-1 text-base text-gray-900 dark:text-white">{{ $appointment->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Address</dt>
                                <dd class="mt-1 text-base text-gray-900 dark:text-white">
                                    <a href="mailto:{{ $appointment->email }}"
                                        class="text-primary hover:underline">{{ $appointment->email }}</a>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone Number</dt>
                                <dd class="mt-1 text-base text-gray-900 dark:text-white">
                                    <a href="tel:{{ $appointment->phone }}"
                                        class="text-primary hover:underline">{{ $appointment->phone }}</a>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Preferred Date</dt>
                                <dd class="mt-1 text-base text-gray-900 dark:text-white">{{ $appointment->date }}
                                    @if($appointment->time) at {{ $appointment->time }} @endif</dd>
                            </div>
                            @if($appointment->department)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Department</dt>
                                    <dd class="mt-1 text-base text-gray-900 dark:text-white">{{ $appointment->department }}</dd>
                                </div>
                            @endif
                            @if($appointment->doctor)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Doctor</dt>
                                    <dd class="mt-1 text-base text-gray-900 dark:text-white">{{ $appointment->doctor }}</dd>
                                </div>
                            @endif
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Message / Notes</dt>
                                <dd class="mt-1 text-base text-gray-900 dark:text-white">{{ $appointment->message ?? '—' }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</dt>
                                <dd class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $appointment->created_at->format('F j, Y, g:i a') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</dt>
                                <dd class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $appointment->updated_at->diffForHumans() }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            {{-- Status Update Card --}}
            <div>
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Status Management</h2>
                    </div>
                    <div class="px-6 py-6">
                        <div class="mb-6">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Current Status</p>
                            <div
                                class="mt-1 inline-flex rounded-full px-3 py-1 text-sm font-medium
                                    {{ $appointment->status == 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300' : '' }}
                                    {{ $appointment->status == 'confirmed' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : '' }}
                                    {{ $appointment->status == 'cancelled' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' : '' }}">
                                {{ ucfirst($appointment->status) }}
                            </div>
                        </div>

                        <form action="{{ route('admin.appointments.update-status', $appointment) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Change
                                Status</label>
                            <select name="status" id="status"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>
                                    Confirmed</option>
                                <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                            <div class="mt-4">
                                <button type="submit"
                                    class="inline-flex w-full justify-center rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm shadow-primary/20 transition-all hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:ring-offset-gray-800">
                                    <i class="bi bi-save mr-2"></i> Update Status
                                </button>
                            </div>
                        </form>

                        <div class="mt-6 border-t border-gray-200 pt-6 dark:border-gray-700">
                            <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST"
                                onsubmit="return confirm('Permanently delete this appointment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex w-full justify-center rounded-lg border border-red-300 bg-white px-4 py-2 text-sm font-medium text-red-700 shadow-sm transition-all hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:border-red-700 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/30">
                                    <i class="bi bi-trash3 mr-2"></i> Delete Appointment
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
