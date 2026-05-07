@extends('admin.layouts.admin')

@section('title', 'Message Details')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header with back button --}}
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Message Details</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">From {{ $contactMessage->name }} ({{ $contactMessage->email }})</p>
            </div>
            <a href="{{ route('admin.contact-messages.index') }}"
               class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                <i class="bi bi-arrow-left mr-2"></i> Back to Messages
            </a>
        </div>

        {{-- Success Alert (if any) --}}
        @if(session('success'))
            <div class="mb-6 rounded-lg border-l-4 border-green-500 bg-green-50 p-4 dark:bg-green-900/30" role="alert">
                <div class="flex items-center">
                    <i class="bi bi-check-circle-fill text-green-500 dark:text-green-400 mr-3 text-xl"></i>
                    <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            {{-- Main Message Card --}}
            <div class="lg:col-span-2">
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Message Content</h2>
                            @if(!$contactMessage->is_read)
                                <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                    <i class="bi bi-envelope-exclamation mr-1"></i> Unread
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                    <i class="bi bi-check-circle-fill mr-1"></i> Read
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="px-6 py-6">
                        <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
                                <dd class="mt-1 text-base text-gray-900 dark:text-white">{{ $contactMessage->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                <dd class="mt-1 text-base text-gray-900 dark:text-white">
                                    <a href="mailto:{{ $contactMessage->email }}" class="text-primary hover:underline">{{ $contactMessage->email }}</a>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Subject</dt>
                                <dd class="mt-1 text-base text-gray-900 dark:text-white">{{ $contactMessage->subject }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Received</dt>
                                <dd class="mt-1 text-base text-gray-900 dark:text-white">{{ $contactMessage->created_at->format('F j, Y, g:i a') }}</dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Message</dt>
                                <dd class="mt-2 text-base text-gray-800 dark:text-gray-200 bg-gray-50 dark:bg-gray-900 rounded-lg p-4 whitespace-pre-wrap">
                                    {{ $contactMessage->message }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            {{-- Actions Card --}}
            <div>
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Actions</h2>
                    </div>
                    <div class="px-6 py-6 space-y-4">
                        {{-- Mark as Read/Unread (optional) --}}
                        @if(!$contactMessage->is_read)
                            <form action="{{ route('admin.contact-messages.mark-read', $contactMessage) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="inline-flex w-full justify-center rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm shadow-primary/20 transition-all hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:ring-offset-gray-800">
                                    <i class="bi bi-envelope-check mr-2"></i> Mark as Read
                                </button>
                            </form>
                        @endif

                        {{-- Reply via email button --}}
                        <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ $contactMessage->subject }}"
                           class="inline-flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="bi bi-reply mr-2"></i> Reply via Email
                        </a>

                        {{-- Delete button --}}
                        <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST" onsubmit="return confirm('Permanently delete this message?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex w-full justify-center rounded-lg border border-red-300 bg-white px-4 py-2 text-sm font-medium text-red-700 shadow-sm transition-all hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:border-red-700 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/30">
                                <i class="bi bi-trash3 mr-2"></i> Delete Message
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Info Card --}}
                <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-800/50">
                    <div class="px-6 py-4">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Message Status</h3>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">
                            @if($contactMessage->is_read)
                                Read on {{ $contactMessage->read_at ? $contactMessage->read_at->format('F j, Y, g:i a') : '—' }}
                            @else
                                Not read yet
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
