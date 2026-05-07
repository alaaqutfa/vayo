<?php
namespace App\Traits;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 * @method \Illuminate\Database\Eloquent\Relations\MorphMany morphMany(string $related, string $name, string $type = null, string $id = null, string $localKey = null)
 */
trait HasMediaTrait
{
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function getMediaByCollection($collection = 'default')
    {
        return $this->media()->where('collection_name', $collection)->orderBy('order')->get();
    }

    public function addMedia($file, $collection = 'default', $fileName = null)
    {
        $uploadedPath = $this->uploadImage($file, 'media/' . $collection, 1024, 768);

        return $this->media()->create([
            'collection_name' => $collection,
            'file_path'       => $uploadedPath,
            'file_name'       => $fileName ?? $file->getClientOriginalName(),
            'mime_type'       => $file->getMimeType(),
            'size'            => $file->getSize(),
            'order'           => $this->media()->where('collection_name', $collection)->count() + 1,
        ]);
    }

    public function deleteMedia($mediaId)
    {
        $media = $this->media()->find($mediaId);
        if ($media) {
            $this->deleteImage($media->file_path);
            $media->delete();
        }
    }

    public function clearMediaCollection($collection)
    {
        $medias = $this->media()->where('collection_name', $collection)->get();
        foreach ($medias as $media) {
            $this->deleteImage($media->file_path);
            $media->delete();
        }
    }
}
