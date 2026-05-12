@extends('layouts.app')

@section('title', 'Terms and Conditions | ' . ($settings['site_name'] ?? 'Vayu Clinic'))
@section('description', 'Terms and Conditions for using Vayu Clinic website, appointment requests, digital content, communications, and clinic services.')
@section('body-class', 'legal-page terms-page')

@section('content')
    <div class="legal-hero">
        <div class="container">
            <div class="legal-hero-content">
                <span class="legal-eyebrow"><i class="bi bi-file-earmark-text"></i> Clear patient commitments</span>
                <h1>Terms and Conditions</h1>
                <p>These Terms govern your use of the {{ $settings['site_name'] ?? 'Vayu Clinic' }} website, appointment tools, online communications, and digital content. Clinical care is also subject to consent forms, medical policies, and applicable law.</p>
                <div class="legal-meta">
                    <span>Effective date: {{ date('F d, Y') }}</span>
                    <span>Website, appointments, content, and communications</span>
                </div>
            </div>
        </div>
    </div>

    <section class="legal-content section">
        <div class="container">
            <div class="legal-layout">
                <aside class="legal-toc">
                    <a href="#acceptance">Acceptance</a>
                    <a href="#medical">Medical Disclaimer</a>
                    <a href="#appointments">Appointments</a>
                    <a href="#payments">Payments</a>
                    <a href="#content">Content</a>
                    <a href="#liability">Liability</a>
                </aside>

                <article class="legal-card">
                    <section id="acceptance">
                        <h2>1. Acceptance of Terms</h2>
                        <p>By accessing this website, submitting a form, contacting us through digital channels, or booking an appointment, you agree to these Terms. If you do not agree, please do not use the website or online services.</p>
                    </section>

                    <section id="medical">
                        <h2>2. Medical Information Is Not Emergency Care</h2>
                        <p>Website content is provided for general educational and informational purposes only. It does not replace a physical examination, diagnosis, medical advice, or treatment plan from a qualified professional.</p>
                        <p>If you have a medical emergency, severe pain, bleeding, breathing difficulty, allergic reaction, trauma, or any urgent condition, call local emergency services or go to the nearest emergency facility immediately.</p>
                    </section>

                    <section id="appointments">
                        <h2>3. Appointments and Communications</h2>
                        <p>Appointment requests submitted online are requests only until confirmed by our team. We may contact you by phone, email, WhatsApp, SMS, or other channels to confirm details, request additional information, or reschedule when necessary.</p>
                        <p>You are responsible for providing accurate contact and health information, arriving on time, following preparation instructions, and notifying us if you need to cancel or reschedule.</p>
                    </section>

                    <section id="payments">
                        <h2>4. Fees, Payments, Cancellations, and Refunds</h2>
                        <p>Fees may vary based on consultation type, doctor, procedure, materials, laboratory work, imaging, and treatment complexity. Any estimate provided before examination is informational and may change after clinical assessment.</p>
                        <p>Cancellation, refund, deposit, insurance, and payment policies may be communicated separately and may differ by service or treatment plan.</p>
                    </section>

                    <section>
                        <h2>5. Patient Responsibilities</h2>
                        <p>You agree to use the website lawfully, avoid submitting false or misleading information, respect clinic staff and other patients, follow medical instructions, disclose relevant medical history, and keep login or communication channels secure where applicable.</p>
                    </section>

                    <section id="content">
                        <h2>6. Intellectual Property and Website Content</h2>
                        <p>All website text, graphics, layout, logos, photographs, videos, icons, and interface elements are owned by or licensed to {{ $settings['site_name'] ?? 'Vayu Clinic' }} unless otherwise stated. You may not copy, modify, reproduce, publish, or commercially use content without written permission.</p>
                    </section>

                    <section>
                        <h2>7. Third-Party Links and Tools</h2>
                        <p>The website may link to third-party websites, maps, video platforms, social networks, messaging platforms, payment tools, or analytics services. We are not responsible for third-party content, policies, security, or availability.</p>
                    </section>

                    <section id="liability">
                        <h2>8. Limitation of Liability</h2>
                        <p>To the maximum extent permitted by law, {{ $settings['site_name'] ?? 'Vayu Clinic' }} is not liable for indirect, incidental, special, consequential, or punitive damages arising from website use, interrupted access, inaccurate user submissions, third-party services, or reliance on general content.</p>
                        <p>Nothing in these Terms limits liability that cannot be limited under applicable law or changes obligations owed during direct clinical care.</p>
                    </section>

                    <section>
                        <h2>9. Privacy</h2>
                        <p>Our handling of personal information is described in our <a href="{{ route('privacy') }}">Privacy Policy</a>. By using the website or submitting information, you acknowledge that personal data will be processed according to that Policy.</p>
                    </section>

                    <section>
                        <h2>10. Changes to Terms</h2>
                        <p>We may update these Terms when services, laws, technology, or clinic operations change. The latest version will be posted on this page and will apply from the effective date shown above.</p>
                    </section>

                    <section>
                        <h2>11. Contact</h2>
                        <p>For questions about these Terms, contact <a href="mailto:{{ $settings['contact_email'] ?? 'info@vayuclinic.com' }}">{{ $settings['contact_email'] ?? 'info@vayuclinic.com' }}</a> or call <a href="tel:{{ preg_replace('/\D+/', '', $settings['contact_phone'] ?? '+905550576555') }}">{{ $settings['contact_phone'] ?? '+90 555 057 65 55' }}</a>.</p>
                    </section>
                </article>
            </div>
        </div>
    </section>
@endsection
