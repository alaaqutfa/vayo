<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'before_image',
        'after_image',
        'type',
        'video_url',
        'description',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'type'      => 'string',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function scopeImages($query)
    {
        return $query->where('type', 'image');
    }

    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }

    // هل هي صورة قبل/بعد؟
    public function isBeforeAfter(): bool
    {
        return $this->before_image && $this->after_image;
    }

    // استخراج معرف الفيديو من يوتيوب
    public function getYouTubeIdAttribute(): ?string
    {
        if (! $this->video_url) {
            return null;
        }

        preg_match('/(?:youtube\.com\/watch\?v=|youtube\.com\/shorts\/|youtu\.be\/)([^&?\/]+)/', $this->video_url, $matches);
        return $matches[1] ?? null;
    }

    public function getIsDirectVideoAttribute(): bool
    {
        return (bool) preg_match('/\.(mp4|webm|ogg|mov)(\?.*)?$/i', $this->video_url ?? '');
    }

    public function getEmbedUrlAttribute(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        if ($this->youtube_id) {
            return 'https://www.youtube.com/embed/' . $this->youtube_id;
        }

        if (str_contains($this->video_url, 'vimeo.com/')) {
            $path = trim(parse_url($this->video_url, PHP_URL_PATH) ?? '', '/');
            $id = explode('/', $path)[0] ?? null;
            return $id ? 'https://player.vimeo.com/video/' . $id : null;
        }

        return null;
    }

    public function getBeforeAfterImages()
    {
        return $this->getMediaByCollection('before_after');
    }
}
