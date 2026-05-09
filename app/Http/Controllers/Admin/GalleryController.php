<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Models\Gallery;
use App\Traits\ImageUploadTrait;

class GalleryController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $galleries = Gallery::orderBy('order', 'asc')->paginate(15);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(GalleryRequest $request)
    {
        $data = $request->validated();

        if ($data['type'] == 'image') {
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadImage($request->file('image'), 'gallery', 800, 600);
            }
            if ($request->hasFile('before_image')) {
                $data['before_image'] = $this->uploadBeforeAfterImage($request->file('before_image'), 'gallery/beforeafter');
            }
            if ($request->hasFile('after_image')) {
                $data['after_image'] = $this->uploadBeforeAfterImage($request->file('after_image'), 'gallery/beforeafter');
            }
            $data['video_url']  = null;
            $data['embed_code'] = null;
        } else {
            $data['image']        = null;
            $data['before_image'] = null;
            $data['after_image']  = null;
        }

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery item added successfully.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $data = $request->validated();

        if ($data['type'] == 'image') {
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadImage($request->file('image'), 'gallery', 800, 600, $gallery->image);
            } else {
                $data['image'] = $gallery->image;
            }

            if ($request->hasFile('before_image')) {
                $data['before_image'] = $this->uploadBeforeAfterImage($request->file('before_image'), 'gallery/beforeafter', $gallery->before_image);
            } else {
                $data['before_image'] = $gallery->before_image;
            }

            if ($request->hasFile('after_image')) {
                $data['after_image'] = $this->uploadBeforeAfterImage($request->file('after_image'), 'gallery/beforeafter', $gallery->after_image);
            } else {
                $data['after_image'] = $gallery->after_image;
            }

            $data['video_url']  = null;
            $data['embed_code'] = null;
        } else {
            // عند تغيير النوع إلى فيديو، احذف جميع الصور القديمة
            $this->deleteMultipleImages([$gallery->image, $gallery->before_image, $gallery->after_image]);
            $data['image']        = null;
            $data['before_image'] = null;
            $data['after_image']  = null;
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        $this->deleteMultipleImages([$gallery->image, $gallery->before_image, $gallery->after_image]);
        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery item deleted.');
    }

    public function toggleStatus(Gallery $gallery)
    {
        $gallery->is_active = ! $gallery->is_active;
        $gallery->save();

        return redirect()->back()->with('success', 'Status updated.');
    }
}
