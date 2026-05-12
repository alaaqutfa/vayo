@extends('admin.layouts.admin')

@section('title', 'Translations')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header with gradient card --}}
        <div
            class="mb-8 rounded-2xl bg-gradient-to-r from-primary/5 to-primary/10 p-6 backdrop-blur-sm dark:from-primary/20 dark:to-primary/5">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Translations</h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Manage all text translations for the website.
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 flex flex-wrap gap-3">
                    <select id="localeSwitcher"
                        class="rounded-lg border-gray-300 bg-white shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                        @foreach($languages as $lang)
                            <option value="{{ $lang->code }}" {{ $locale == $lang->code ? 'selected' : '' }}>
                                {{ $lang->name }} ({{ $lang->code }})
                            </option>
                        @endforeach
                    </select>
                    <button type="button"
                        onclick="window.location.href='{{ route('admin.translations.index') }}?locale='+document.getElementById('localeSwitcher').value"
                        class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        <i class="bi bi-arrow-repeat mr-2"></i> Switch
                    </button>
                    <button type="button" onclick="document.getElementById('addKeyModal').classList.remove('hidden')"
                        class="inline-flex items-center rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm shadow-primary/20 transition-all hover:bg-primary/90 hover:shadow-primary/30 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:ring-offset-gray-800">
                        <i class="bi bi-plus-lg mr-2 text-lg"></i> Add Key
                    </button>
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

        {{-- Translations Table Card --}}
        <div
            class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <form action="{{ route('admin.translations.update') }}" method="POST">
                @csrf
                <input type="hidden" name="locale" value="{{ $locale }}">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800/50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Key</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Value ({{ strtoupper($locale) }})</th>
                                <th
                                    class="px-6 py-4 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                            @foreach($translations as $trans)
                                <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $trans->key }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="text" name="translations[{{ $trans->key }}]" value="{{ $trans->value }}"
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                        <button type="button"
                                            onclick="if(confirm('Are you sure?')) document.getElementById('delete-form-{{ $trans->id }}').submit();"
                                            class="inline-flex items-center text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                            <i class="bi bi-trash3 mr-1"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-6 py-4 dark:border-gray-700">
                    <button type="submit"
                        class="inline-flex items-center rounded-lg bg-primary px-5 py-2.5 text-sm font-medium text-white shadow-sm shadow-primary/20 transition-all hover:bg-primary/90 hover:shadow-primary/30 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:ring-offset-gray-800">
                        <i class="bi bi-save mr-2 text-lg"></i> Save All Changes
                    </button>
                </div>
            </form>

            @if($translations->hasPages())
                <div class="border-t border-gray-200 px-6 py-4 dark:border-gray-700">
                    {{ $translations->appends(['locale' => $locale])->links() }}
                </div>
            @endif
        </div>
    </div>

    @foreach($translations as $trans)
        <form id="delete-form-{{ $trans->id }}" action="{{ route('admin.translations.destroy', $trans->id) }}" method="POST"
            class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

    {{-- Modal for adding new translation key --}}
    <div id="addKeyModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex min-h-screen items-end justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
            {{-- Background overlay --}}
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity dark:bg-gray-900 dark:bg-opacity-80"
                onclick="document.getElementById('addKeyModal').classList.add('hidden')"></div>

            {{-- Modal panel --}}
            <div
                class="inline-block transform overflow-hidden rounded-xl bg-white text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:align-middle dark:bg-gray-800">
                <form action="{{ route('admin.translations.key.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="locale" value="{{ $locale }}">

                    <div class="bg-white px-6 pt-5 pb-4 dark:bg-gray-800 sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between pb-3">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="modal-title">Add New
                                Translation Key</h3>
                            <button type="button" onclick="document.getElementById('addKeyModal').classList.add('hidden')"
                                class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                                <i class="bi bi-x-lg text-xl"></i>
                            </button>
                        </div>

                        <div class="mt-4">
                            <label for="key_input" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Key
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="key" id="key_input" required placeholder="e.g., home.title, about.hero"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Use dot notation for grouping (e.g.,
                                home.welcome).</p>
                        </div>

                        <div class="mt-4">
                            <label for="value_input"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Value
                                ({{ strtoupper($locale) }})</label>
                            <textarea name="value" id="value_input" rows="3"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                                placeholder="Translation text..."></textarea>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-6 py-3 dark:bg-gray-900 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="submit"
                            class="inline-flex w-full justify-center rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm shadow-primary/20 transition-all hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 sm:ml-3 sm:w-auto dark:ring-offset-gray-800">
                            <i class="bi bi-check-lg mr-2"></i> Create
                        </button>
                        <button type="button" onclick="document.getElementById('addKeyModal').classList.add('hidden')"
                            class="mt-3 inline-flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 sm:mt-0 sm:w-auto dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Close modal when pressing ESC key
                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape') {
                        const modal = document.getElementById('addKeyModal');
                        if (modal && !modal.classList.contains('hidden')) {
                            modal.classList.add('hidden');
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
