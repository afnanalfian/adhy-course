<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingVideo;
use Illuminate\Http\Request;

class MeetingVideoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CREATE (form tambah video)
    |--------------------------------------------------------------------------
    */
    public function create(Meeting $meeting)
    {
        abort_if($meeting->video !== null, 409);

        return view('meetings.videos.create', compact('meeting'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE (simpan youtube video id)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request, Meeting $meeting)
    {
        abort_if(
            $meeting->video()->exists(),
            409,
            'Meeting sudah memiliki video'
        );

        $request->validate([
            'youtube_video_id' => 'required|string'
        ]);

        MeetingVideo::create([
            'meeting_id'        => $meeting->id,
            'title'             => $meeting->title,
            'youtube_video_id'  => $request->youtube_video_id,
        ]);

        return redirect()
            ->route('meeting.show', $meeting)
            ->with('success', 'Video berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT (form edit video title + id)
    |--------------------------------------------------------------------------
    */
    public function edit(Meeting $meeting)
    {
        abort_if($meeting->video === null, 404);

        return view('meetings.videos.edit', [
            'meeting' => $meeting,
            'video'   => $meeting->video,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE (update metadata)
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Meeting $meeting)
    {
        $video = $meeting->video;
        abort_if(! $video, 404);

        $request->validate([
            'title'             => 'required|string|max:255',
            'youtube_video_id'  => 'required|string',
        ]);

        $video->update([
            'title'             => $request->title,
            'youtube_video_id'  => $request->youtube_video_id,
        ]);

        return redirect()
            ->route('meeting.show', $meeting)
            ->with('success', 'Metadata video diperbarui');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY (hapus video dari database)
    |--------------------------------------------------------------------------
    */
    public function destroy(Meeting $meeting)
    {
        $video = $meeting->video;
        abort_if(! $video, 404);

        $video->delete();

        return redirect()
            ->route('meeting.show', $meeting)
            ->with('success', 'Video berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | PLAYBACK (tampilkan youtube player)
    |--------------------------------------------------------------------------
    */
    public function playback(Meeting $meeting)
    {
        $video = $meeting->video;
        abort_if(! $video, 404);

        // generate embed url
        $embedUrl = "https://www.youtube.com/embed/{$video->youtube_video_id}?modestbranding=1&rel=0&showinfo=0";

        return view('meetings.videos.playback', compact(
            'meeting',
            'video',
            'embedUrl'
        ));
    }
}
