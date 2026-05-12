<?php
namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * عرض نموذج الاتصال
     */
    public function create()
    {
        return view('contact');
    }

    /**
     * معالجة نموذج الاتصال وتخزين الرسالة
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // تخزين الرسالة في قاعدة البيانات
        $contact = ContactMessage::create($validated);

        // إرسال إشعار إلى المسؤول (اختياري)
        // Mail::to(config('mail.admin_address'))->send(new ContactNotification($contact));

        // إرسال رد آلي للمستخدم (اختياري)
        // Mail::to($contact->email)->send(new ContactAutoReply($contact));

        return redirect()
            ->route('contact')
            ->with('success', __t('contact_success_message'));
    }
}
