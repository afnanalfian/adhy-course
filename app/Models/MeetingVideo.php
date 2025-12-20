<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'youtube_video_id',
        'title',
        'youtube_thumbnail_url',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    /**
     * Signed embed URL (ONLY when ready)
     */
    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        if (! $this->youtube_video_id) return null;

        return "https://www.youtube.com/embed/{$this->youtube_video_id}?modestbranding=1&rel=0&showinfo=0&iv_load_policy=3";
    }

}
