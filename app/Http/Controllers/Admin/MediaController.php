<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    use ImageUploadTrait;

    public function upload(Request $request)
    {
        $request->validate([
            'file'       => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'model_type' => 'required|string',
            'model_id'   => 'required|integer',
            'collection' => 'nullable|string',
        ]);

        $modelClass = '\\App\\Models\\' . class_basename($request->model_type);
        if (! class_exists($modelClass)) {
            return response()->json(['error' => 'Invalid model type'], 400);
        }

        $model = $modelClass::find($request->model_id);
        if (! $model) {
            return response()->json(['error' => 'Model not found'], 404);
        }

        $media = $model->addMedia($request->file('file'), $request->collection ?? 'default');

        return response()->json([
            'success' => true,
            'media'   => $media,
            'url'     => $media->url,
        ]);
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'items'         => 'required|array',
            'items.*.id'    => 'required|exists:media,id',
            'items.*.order' => 'required|integer',
        ]);

        foreach ($request->items as $item) {
            Media::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        $this->deleteImage($media->file_path);
        $media->delete();

        return response()->json(['success' => true]);
    }

    public function apiIndex(Request $request)
    {
        $request->validate([
            'model_type' => 'required|string',
            'model_id'   => 'required|integer',
            'collection' => 'nullable|string',
        ]);

        $modelClass = '\\App\\Models\\' . class_basename($request->model_type);
        $model      = $modelClass::find($request->model_id);
        if (! $model) {
            return response()->json([]);
        }

        $media = $model->getMediaByCollection($request->collection ?? 'default');

        return response()->json($media);
    }
}
