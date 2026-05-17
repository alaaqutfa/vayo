@extends('admin.layouts.admin')

@section('title', 'Website Settings')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header with gradient card --}}
        <div class="mb-8 rounded-2xl bg-gradient-to-r from-primary/5 to-primary/10 p-6 backdrop-blur-sm dark:from-primary/20 dark:to-primary/5">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Settings</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Manage general website configuration</p>
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

        {{-- Settings Form Card --}}
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">General Configuration</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Update your website information below</p>
            </div>
            <div class="px-6 py-6">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Site Information Section --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white border-l-4 border-primary pl-3 mb-4">Site Information</h3>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="site_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Site Name</label>
                                <input type="text" name="site_name" id="site_name"
                                       value="{{ old('site_name', $settings['site_name'] ?? 'Vayu Clinic') }}"
                                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                            <div>
                                <label for="footer_text" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Footer Text</label>
                                <input type="text" name="footer_text" id="footer_text"
                                       value="{{ old('footer_text', $settings['footer_text'] ?? 'Providing modern, patient-centered healthcare...') }}"
                                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                        </div>
                    </div>

                    {{-- Contact Details Section --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white border-l-4 border-primary pl-3 mb-4">Contact Details</h3>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="contact_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Phone</label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="bi bi-telephone text-gray-400"></i>
                                    </div>
                                    <input type="text" name="contact_phone" id="contact_phone"
                                           value="{{ old('contact_phone', $settings['contact_phone'] ?? '+90 555 057 65 55') }}"
                                           class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="emergency_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Emergency Phone</label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="bi bi-exclamation-triangle text-gray-400"></i>
                                    </div>
                                    <input type="text" name="emergency_phone" id="emergency_phone"
                                           value="{{ old('emergency_phone', $settings['emergency_phone'] ?? '+90 555 057 65 55') }}"
                                           class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="contact_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Email</label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="bi bi-envelope text-gray-400"></i>
                                    </div>
                                    <input type="email" name="contact_email" id="contact_email"
                                           value="{{ old('contact_email', $settings['contact_email'] ?? 'info@vayuclinic.com') }}"
                                           class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="contact_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="bi bi-geo-alt text-gray-400"></i>
                                    </div>
                                    <input type="text" name="contact_address" id="contact_address"
                                           value="{{ old('contact_address', $settings['contact_address'] ?? 'Vayu Clinic Medical Center, Istanbul, Türkiye') }}"
                                           class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Colors Section --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white border-l-4 border-primary pl-3 mb-4">Theme Colors</h3>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="primary_color" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Primary Color</label>
                                <div class="mt-1 flex items-center gap-3">
                                    <input type="color" name="primary_color" id="primary_color_picker"
                                           value="{{ old('primary_color', $settings['primary_color'] ?? '#33FF99') }}"
                                           class="h-10 w-10 rounded border border-gray-300 cursor-pointer">
                                    <input type="text" name="primary_color" id="primary_color_hex"
                                           value="{{ old('primary_color', $settings['primary_color'] ?? '#33FF99') }}"
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                </div>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Used for buttons, links, and accents</p>
                            </div>
                            <div>
                                <label for="secondary_color" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Secondary Color</label>
                                <div class="mt-1 flex items-center gap-3">
                                    <input type="color" name="secondary_color" id="secondary_color_picker"
                                           value="{{ old('secondary_color', $settings['secondary_color'] ?? '#012119') }}"
                                           class="h-10 w-10 rounded border border-gray-300 cursor-pointer">
                                    <input type="text" name="secondary_color" id="secondary_color_hex"
                                           value="{{ old('secondary_color', $settings['secondary_color'] ?? '#012119') }}"
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                </div>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Used for backgrounds, footers, etc.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Media Section --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white border-l-4 border-primary pl-3 mb-4">Media</h3>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="site_logo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Site Logo</label>
                                <input type="file" name="site_logo" id="site_logo" accept="image/*"
                                       class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                                              file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold
                                              file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                                @if(isset($settings['site_logo']) && $settings['site_logo'])
                                    <div class="mt-3 flex items-center gap-3">
                                        <img src="{{ asset('public/storage/'.$settings['site_logo']) }}" class="h-12 w-auto object-contain">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">Current logo</span>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <label for="favicon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Favicon</label>
                                <input type="file" name="favicon" id="favicon" accept="image/png,image/ico,image/x-icon"
                                       class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                                              file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold
                                              file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                                @if(isset($settings['favicon']) && $settings['favicon'])
                                    <div class="mt-3 flex items-center gap-3">
                                        <img src="{{ asset('public/storage/'.$settings['favicon']) }}" class="h-8 w-auto object-contain">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">Current favicon</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Footer Text (full width) --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white border-l-4 border-primary pl-3 mb-4">Social Media Links</h3>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="social_facebook" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Facebook</label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="bi bi-facebook text-gray-400"></i>
                                    </div>
                                    <input type="url" name="social_facebook" id="social_facebook"
                                           placeholder="https://facebook.com/yourpage"
                                           value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}"
                                           class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="social_twitter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Twitter/X</label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="bi bi-twitter text-gray-400"></i>
                                    </div>
                                    <input type="url" name="social_twitter" id="social_twitter"
                                           placeholder="https://twitter.com/yourhandle"
                                           value="{{ old('social_twitter', $settings['social_twitter'] ?? '') }}"
                                           class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="social_instagram" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Instagram</label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="bi bi-instagram text-gray-400"></i>
                                    </div>
                                    <input type="url" name="social_instagram" id="social_instagram"
                                           placeholder="https://instagram.com/yourhandle"
                                           value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}"
                                           class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="social_linkedin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">LinkedIn</label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="bi bi-linkedin text-gray-400"></i>
                                    </div>
                                    <input type="url" name="social_linkedin" id="social_linkedin"
                                           placeholder="https://linkedin.com/company/yourcompany"
                                           value="{{ old('social_linkedin', $settings['social_linkedin'] ?? '') }}"
                                           class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="social_youtube" class="block text-sm font-medium text-gray-700 dark:text-gray-300">YouTube</label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="bi bi-youtube text-gray-400"></i>
                                    </div>
                                    <input type="url" name="social_youtube" id="social_youtube"
                                           placeholder="https://youtube.com/yourhandle"
                                           value="{{ old('social_youtube', $settings['social_youtube'] ?? '') }}"
                                           class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="social_tiktok" class="block text-sm font-medium text-gray-700 dark:text-gray-300">TikTok</label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="bi bi-tiktok text-gray-400"></i>
                                    </div>
                                    <input type="url" name="social_tiktok" id="social_tiktok"
                                           placeholder="https://tiktok.com/@yourhandle"
                                           value="{{ old('social_tiktok', $settings['social_tiktok'] ?? '') }}"
                                           class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="social_whatsapp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">WhatsApp</label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="bi bi-whatsapp text-gray-400"></i>
                                    </div>
                                    <input type="text" name="social_whatsapp" id="social_whatsapp"
                                           placeholder="+1234567890 (or https://wa.me/1234567890)"
                                           value="{{ old('social_whatsapp', $settings['social_whatsapp'] ?? '') }}"
                                           class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Footer Text (full width) --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white border-l-4 border-primary pl-3 mb-4">Footer Text</h3>
                        <textarea name="footer_text" rows="4"
                                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">{{ old('footer_text', $settings['footer_text'] ?? 'Providing modern, patient-centered healthcare...') }}</textarea>
                    </div>

                    {{-- Submit Button --}}
                    <div class="mt-8 flex justify-end border-t border-gray-200 pt-6 dark:border-gray-700">
                        <button type="submit"
                                class="inline-flex items-center rounded-lg bg-primary px-6 py-2.5 text-sm font-medium text-white shadow-sm shadow-primary/20 transition-all hover:bg-primary/90 hover:shadow-primary/30 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:ring-offset-gray-800">
                            <i class="bi bi-save mr-2 text-lg"></i> Save All Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Sync color picker with hex input for Primary Color
                const primaryPicker = document.getElementById('primary_color_picker');
                const primaryHex = document.getElementById('primary_color_hex');
                if (primaryPicker && primaryHex) {
                    primaryPicker.addEventListener('input', function () {
                        primaryHex.value = this.value;
                    });
                    primaryHex.addEventListener('input', function () {
                        primaryPicker.value = this.value;
                    });
                }

                // Sync color picker with hex input for Secondary Color
                const secondaryPicker = document.getElementById('secondary_color_picker');
                const secondaryHex = document.getElementById('secondary_color_hex');
                if (secondaryPicker && secondaryHex) {
                    secondaryPicker.addEventListener('input', function () {
                        secondaryHex.value = this.value;
                    });
                    secondaryHex.addEventListener('input', function () {
                        secondaryPicker.value = this.value;
                    });
                }
            });
        </script>
    @endpush
@endsection
