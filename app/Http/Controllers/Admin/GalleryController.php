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
            // Handle main image
            if ($request->input('delete_image')) {
                if ($gallery->image) {
                    $this->deleteImage($gallery->image);
                }
                $data['image'] = null;
            } elseif ($request->hasFile('image')) {
                if ($gallery->image) {
                    $this->deleteImage($gallery->image);
                }
                $data['image'] = $this->uploadImage($request->file('image'), 'gallery', 800, 600);
            } else {
                $data['image'] = $gallery->image;
            }

            // Handle before image
            if ($request->input('delete_before_image')) {
                if ($gallery->before_image) {
                    $this->deleteImage($gallery->before_image);
                }
                $data['before_image'] = null;
            } elseif ($request->hasFile('before_image')) {
                if ($gallery->before_image) {
                    $this->deleteImage($gallery->before_image);
                }
                $data['before_image'] = $this->uploadBeforeAfterImage($request->file('before_image'), 'gallery/beforeafter');
            } else {
                $data['before_image'] = $gallery->before_image;
            }

            // Handle after image
            if ($request->input('delete_after_image')) {
                if ($gallery->after_image) {
                    $this->deleteImage($gallery->after_image);
                }
                $data['after_image'] = null;
            } elseif ($request->hasFile('after_image')) {
                if ($gallery->after_image) {
                    $this->deleteImage($gallery->after_image);
                }
                $data['after_image'] = $this->uploadBeforeAfterImage($request->file('after_image'), 'gallery/beforeafter');
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
