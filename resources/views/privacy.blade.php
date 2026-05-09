@extends('layouts.app')

@section('title', 'Privacy Policy | ' . ($settings['site_name'] ?? 'Vayo Clinic'))
@section('description', 'Privacy Policy for Vayo Clinic covering personal data, medical information, appointments, cookies, communications, and patient rights.')
@section('body-class', 'legal-page privacy-page')

@section('content')
    <div class="legal-hero">
        <div class="container">
            <div class="legal-hero-content">
                <span class="legal-eyebrow"><i class="bi bi-shield-lock"></i> Patient privacy first</span>
                <h1>Privacy Policy</h1>
                <p>How {{ $settings['site_name'] ?? 'Vayo Clinic' }} collects, uses, protects, and shares personal information when you use our website, request appointments, contact our team, or receive care through our clinic.</p>
                <div class="legal-meta">
                    <span>Effective date: {{ date('F d, Y') }}</span>
                    <span>Applies to website visitors, patients, and prospective patients</span>
                </div>
            </div>
        </div>
    </div>

    <section class="legal-content section">
        <div class="container">
            <div class="legal-layout">
                <aside class="legal-toc">
                    <a href="#overview">Overview</a>
                    <a href="#data">Information We Collect</a>
                    <a href="#use">How We Use Data</a>
                    <a href="#sharing">Sharing & Transfers</a>
                    <a href="#rights">Your Rights</a>
                    <a href="#contact-privacy">Contact</a>
                </aside>

                <article class="legal-card">
                    <section id="overview">
                        <h2>1. Overview</h2>
                        <p>We respect privacy as a core part of safe healthcare. This Policy explains our practices for personal data, appointment data, communications, website usage data, and limited health-related information you choose to provide online.</p>
                        <p>This Policy is designed to align with globally recognized privacy principles, including transparency, purpose limitation, data minimization, security, access rights, and responsible retention. It is not a substitute for country-specific medical consent forms or notices that may apply during treatment.</p>
                    </section>

                    <section id="data">
                        <h2>2. Information We Collect</h2>
                        <p>We may collect identity and contact details such as name, phone number, email address, country, preferred language, and appointment preferences.</p>
                        <p>When you submit an appointment, consultation, contact, or medical inquiry form, you may choose to share symptoms, treatment interests, doctor preferences, images, or other health-related details. Please share only information needed for the request.</p>
                        <p>Our website may collect technical data such as IP address, device type, browser, pages viewed, referral source, approximate location, and cookie identifiers to keep the site secure and improve performance.</p>
                    </section>

                    <section id="use">
                        <h2>3. How We Use Information</h2>
                        <p>We use information to respond to inquiries, schedule and manage appointments, coordinate care, personalize communication, provide patient support, improve clinic services, maintain records, prevent misuse, and comply with legal, medical, insurance, tax, and regulatory duties.</p>
                        <p>We do not sell personal information. We do not use health-related information for unrelated advertising without appropriate consent where required.</p>
                    </section>

                    <section id="sharing">
                        <h2>4. Sharing, Processors, and International Transfers</h2>
                        <p>We may share information with doctors, clinical staff, administrative staff, laboratories, payment providers, hosting providers, analytics providers, messaging tools, professional advisers, or authorities when necessary for care, operations, security, or legal compliance.</p>
                        <p>Because patients may contact us internationally, information may be processed in countries other than your own. Where required, we use reasonable safeguards for cross-border transfers.</p>
                    </section>

                    <section>
                        <h2>5. Cookies and Digital Tracking</h2>
                        <p>We may use essential cookies for navigation, security, language preference, and form functionality. Analytics or marketing cookies, if enabled, help us understand aggregate usage and improve the patient journey. You can manage cookies through your browser settings.</p>
                    </section>

                    <section>
                        <h2>6. Data Security and Retention</h2>
                        <p>We use administrative, technical, and organizational safeguards designed to protect information against unauthorized access, loss, misuse, alteration, or disclosure. No digital system is perfectly secure, but we continuously aim to reduce risk.</p>
                        <p>We retain information only as long as needed for the purposes described in this Policy, including healthcare recordkeeping, patient support, dispute resolution, and legal obligations.</p>
                    </section>

                    <section id="rights">
                        <h2>7. Your Privacy Rights</h2>
                        <p>Depending on your location, you may have the right to request access, correction, deletion, restriction, portability, objection to certain processing, or withdrawal of consent. Some requests may be limited by medical record, legal, or safety requirements.</p>
                        <p>We may verify your identity before responding to a request. We aim to respond within a reasonable period and according to applicable law.</p>
                    </section>

                    <section>
                        <h2>8. Children and Sensitive Information</h2>
                        <p>Our website is not directed to children without involvement of a parent or legal guardian. Medical services for minors require appropriate guardian consent according to applicable law.</p>
                    </section>

                    <section>
                        <h2>9. Updates to This Policy</h2>
                        <p>We may update this Policy to reflect changes in services, technology, law, or clinic operations. The latest version will be posted on this page with an updated effective date.</p>
                    </section>

                    <section id="contact-privacy">
                        <h2>10. Contact Us</h2>
                        <p>For privacy requests or questions, contact us at <a href="mailto:{{ $settings['contact_email'] ?? 'info@vayoclinic.com' }}">{{ $settings['contact_email'] ?? 'info@vayoclinic.com' }}</a> or call <a href="tel:{{ preg_replace('/\D+/', '', $settings['contact_phone'] ?? '+905550576555') }}">{{ $settings['contact_phone'] ?? '+90 555 057 65 55' }}</a>.</p>
                    </section>
                </article>
            </div>
        </div>
    </section>
@endsection
