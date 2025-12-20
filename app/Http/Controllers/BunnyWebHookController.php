<?php

namespace App\Http\Controllers;

use App\Models\MeetingVideo;
use App\Services\BunnyVideoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BunnyWebhookController extends Controller
{
    public function handle(Request $request)
    {
        if ($request->query('secret') !== config('services.bunny.webhook_secret')) {
            abort(403);
        }

        $videoGuid = $request->input('VideoGuid');
        $status    = (int) $request->input('Status');

        if (! $videoGuid) {
            return response()->json(['ignored' => true]);
        }

        $video = MeetingVideo::where('bunny_video_id', $videoGuid)->first();
        if (! $video) {
            return response()->json(['not_found' => true]);
        }

        // Status mapping Bunny
        if ($status === 3) { // Finished
            $meta = BunnyVideoService::fetchVideoMeta(
                $video->library_id,
                $videoGuid
            );

            $video->update([
                'status'        => 'ready',
                'duration'      => $meta['length'] ?? null,
                'thumbnail_url' => $meta['thumbnail'] ?? null,
            ]);
        }

        if ($status === 4) { // Failed
            $video->update(['status' => 'failed']);
        }

        return response()->json(['ok' => true]);
    }
}
