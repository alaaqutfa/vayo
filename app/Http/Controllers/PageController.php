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
                    ? 'How Vayu Clinic protects patient privacy, personal data, medical information, and digital communications.'
                    : 'The terms that govern use of Vayu Clinic services, website content, appointments, and communications.',
                'content' => '',
            ]);
        }

        if (View::exists($slug)) {
            return view($slug, compact('page'));
        }

        return view('page', compact('page'));
    }

    public function showAbout()
    {
        $page = Page::where('slug', 'about')
            ->where('is_active', true)
            ->first();

        if (!$page) {
            $page = new Page([
                'title' => 'About Vayu Dental Clinic',
                'slug' => 'about',
                'meta_description' => 'Your smile is our passion. Advanced cosmetic dentistry, gentle care, and exceptional results at Vayu Clinic.',
                'content' => '',
            ]);
        }

        return view('about', compact('page'));
    }
}
