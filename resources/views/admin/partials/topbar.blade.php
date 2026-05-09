<nav class="fixed top-0 z-40 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button data-drawer-target="top-bar-sidebar" data-drawer-toggle="top-bar-sidebar"
                    aria-controls="top-bar-sidebar" type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary dark:text-gray-400 dark:hover:bg-gray-700">
                    <span class="sr-only">Open sidebar</span>
                    <i class="bi bi-list text-2xl"></i>
                </button>
                <a href="{{ route('admin.dashboard') }}" class="flex ml-2 md:mr-24">
                    <img src="{{ asset('assets/img/logo.png') }}" class="h-8 w-auto" alt="Logo">
                    {{-- <span
                        class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-primary dark:text-primary/90 ml-2">
                        {{ $settings['site_name'] ?? 'Vayo Clinic' }}
                    </span> --}}
                </a>
            </div>

            <div class="flex items-center gap-3">
                <!-- Language Switcher -->
                <div class="relative">
                    <button type="button" id="langMenuButton"
                        class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 transition-colors"
                        title="Change Language">
                        <i class="bi bi-globe text-xl"></i>
                    </button>
                    <div id="langDropdown"
                        class="absolute right-0 z-50 hidden w-40 mt-2 bg-white rounded-md shadow-lg py-1 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        @php
                            $languages = \App\Models\Language::where('is_active', true)->get();
                            $currentLocale = app()->getLocale();
                        @endphp
                        @foreach($languages as $lang)
                            <a href="{{ route('lang.switch', $lang->code) }}"
                                class="flex items-center px-4 py-2 text-sm {{ $currentLocale == $lang->code ? 'bg-primary/10 text-primary dark:bg-primary/20' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                                <span class="mr-2">{{ $lang->code === 'ar' ? '🇸🇦' : ($lang->code === 'en' ? '🇬🇧' : '🇫🇷') }}</span>
                                {{ $lang->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Dark Mode Toggle (اختياري) -->
                {{-- <button id="darkModeToggle"
                    class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                    <i class="bi bi-moon-fill dark:hidden text-xl"></i>
                    <i class="bi bi-sun-fill hidden dark:inline-block text-xl"></i>
                </button> --}}

                <!-- User Dropdown -->
                <div class="relative">
                    <button type="button" id="userMenuButton"
                        class="flex text-sm bg-gray-800 rounded-full focus:ring-2 focus:ring-primary dark:focus:ring-primary"
                        aria-expanded="false">
                        <div
                            class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white font-bold uppercase">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </button>
                    <div id="userDropdown"
                        class="absolute right-0 z-50 hidden w-48 mt-2 bg-white rounded-md shadow-lg py-1 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('admin.dashboard') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">Dashboard</a>
                        <a href="{{ route('admin.settings.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">Settings</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:text-red-400 dark:hover:bg-gray-700">
                                <i class="bi bi-box-arrow-right mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle language dropdown
            const langBtn = document.getElementById('langMenuButton');
            const langDropdown = document.getElementById('langDropdown');
            if (langBtn && langDropdown) {
                langBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    langDropdown.classList.toggle('hidden');
                });
                document.addEventListener('click', (e) => {
                    if (!langBtn.contains(e.target) && !langDropdown.contains(e.target)) {
                        langDropdown.classList.add('hidden');
                    }
                });
            }

            // Toggle user dropdown
            const userBtn = document.getElementById('userMenuButton');
            const userDropdown = document.getElementById('userDropdown');
            if (userBtn && userDropdown) {
                userBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    userDropdown.classList.toggle('hidden');
                });
                document.addEventListener('click', (e) => {
                    if (!userBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                        userDropdown.classList.add('hidden');
                    }
                });
            }
            // Dark mode toggle (simple)
            // const darkToggle = document.getElementById('darkModeToggle');
            // if (darkToggle) {
            //     darkToggle.addEventListener('click', () => {
            //         document.documentElement.classList.toggle('dark');
            //         localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
            //     });
            //     if (localStorage.getItem('darkMode') === 'true') {
            //         document.documentElement.classList.add('dark');
            //     }
            // }
        });
    </script>
@endpush
