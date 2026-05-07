<aside id="top-bar-sidebar"
    class="fixed top-0 left-0 z-30 w-64 h-full transition-transform -translate-x-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700 sm:translate-x-0"
    aria-label="Sidenav">
    <div class="overflow-y-auto pt-20 pb-5 px-3 h-full">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('admin.dashboard') ? 'sidebar-active' : '' }}">
                    <i
                        class="bi bi-speedometer2 w-5 h-5 text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.services.index') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('admin.services.*') ? 'sidebar-active' : '' }}">
                    <i
                        class="bi bi-briefcase w-5 h-5 text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="ml-3">Services</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.testimonials.index') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('admin.testimonials.*') ? 'sidebar-active' : '' }}">
                    <i
                        class="bi bi-chat-quote w-5 h-5 text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="ml-3">Testimonials</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.galleries.index') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('admin.galleries.*') ? 'sidebar-active' : '' }}">
                    <i
                        class="bi bi-images w-5 h-5 text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="ml-3">Gallery</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pages.index') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('admin.pages.*') ? 'sidebar-active' : '' }}">
                    <i
                        class="bi bi-files w-5 h-5 text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="ml-3">Pages</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.faqs.index') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('admin.faqs.*') ? 'sidebar-active' : '' }}">
                    <i
                        class="bi bi-question-circle w-5 h-5 text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="ml-3">FAQs</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.appointments.index') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('admin.appointments.*') ? 'sidebar-active' : '' }}">
                    <i
                        class="bi bi-calendar-check w-5 h-5 text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="ml-3">Appointments</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.contact-messages.index') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('admin.contact-messages.*') ? 'sidebar-active' : '' }}">
                    <i
                        class="bi bi-envelope w-5 h-5 text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="ml-3">Contact Messages</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.translations.index') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('admin.translations.*') ? 'sidebar-active' : '' }}">
                    <i
                        class="bi bi-translate w-5 h-5 text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="ml-3">Translations</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings.index') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('admin.settings.*') ? 'sidebar-active' : '' }}">
                    <i
                        class="bi bi-gear w-5 h-5 text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="ml-3">Settings</span>
                </a>
            </li>
        </ul>
        <div class="pt-5 mt-5 border-t border-gray-200 dark:border-gray-700">
            <a href="{{ url('/') }}" target="_blank"
                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                <i
                    class="bi bi-eye w-5 h-5 text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                <span class="ml-3">Visit Site</span>
            </a>
        </div>
    </div>
</aside>
