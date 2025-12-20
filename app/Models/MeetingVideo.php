<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Services\BunnyVideoService;

class MeetingVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'bunny_video_id',
        'library_id',
        'title',
        'thumbnail_url',
        'duration',
        'status',
    ];

    protected $casts = [
        'duration' => 'integer',
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

    /*
    |--------------------------------------------------------------------------
    | State helpers
    |--------------------------------------------------------------------------
    */
    public function isReady(): bool
    {
        return $this->status === 'ready';
    }

    public function isProcessing(): bool
    {
        return in_array($this->status, ['uploading', 'processing']);
    }

    /*
    |--------------------------------------------------------------------------
    | Computed attributes
    |--------------------------------------------------------------------------
    */

    /**
     * Signed embed URL (ONLY when ready)
     */
    public function getEmbedUrlAttribute(): ?string
    {
        if (! $this->isReady()) {
            return null;
        }

        return BunnyVideoService::signedEmbed($this->bunny_video_id);
    }
}
