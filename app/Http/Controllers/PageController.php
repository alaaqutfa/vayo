<?php
namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (!$page && !in_array($slug, ['privacy', 'terms'], true)) {
            abort(404);
        }

        if (!$page) {
            $page = new Page([
                'title' => $slug === 'privacy' ? 'Privacy Policy' : 'Terms and Conditions',
                'slug' => $slug,
                'meta_description' => $slug === 'privacy'
                    ? 'How Vayo Clinic protects patient privacy, personal data, medical information, and digital communications.'
                    : 'The terms that govern use of Vayo Clinic services, website content, appointments, and communications.',
                'content' => '',
            ]);
        }

        if (View::exists($slug)) {
            return view($slug, compact('page'));
        }

        return view('page', compact('page'));
    }
}
