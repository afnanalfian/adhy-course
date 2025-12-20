<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingVideo;
use App\Services\BunnyVideoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MeetingVideoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CREATE (form)
    |--------------------------------------------------------------------------
    */
    public function create(Meeting $meeting)
    {
        abort_if($meeting->video !== null, 409);

        return view('meetings.videos.create', compact('meeting'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE (upload to Bunny)
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
            'video' => 'required|file|mimes:mp4,mov|max:2048000',
        ]);

        try {
            // Upload ke Bunny (EXTERNAL)
            $result = BunnyVideoService::upload(
                $request->file('video'),
                $meeting->title
            );

            // Simpan DB (LOCAL)
            DB::transaction(function () use ($meeting, $result) {
                MeetingVideo::create([
                    'meeting_id'     => $meeting->id,
                    'bunny_video_id' => $result['guid'],
                    'library_id'     => config('services.bunny.library_id'),
                    'title'          => $meeting->title,
                    'status'         => 'uploading',
                ]);
            });

            return redirect()
                ->route('meetings.show', $meeting)
                ->with('success', 'Video berhasil diupload & sedang diproses');

        } catch (\Throwable $e) {
            report($e);

            return back()->withErrors('Upload video gagal');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT (replace video)
    |--------------------------------------------------------------------------
    */
    public function edit(Meeting $meeting)
    {
        abort_if($meeting->video === null, 404);

        return view('meeting-videos.edit', [
            'meeting' => $meeting,
            'video'   => $meeting->video,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE 
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Meeting $meeting)
    {
        $video = $meeting->video;
        abort_if(! $video, 404);

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $video->update([
            'title' => $request->title,
        ]);

        return redirect()
            ->route('meetings.show', $meeting)
            ->with('success', 'Metadata video diperbarui');
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY (delete from Bunny + DB)
    |--------------------------------------------------------------------------
    */
    public function destroy(Meeting $meeting)
    {
        $video = $meeting->video;
        abort_if(! $video, 404);

        DB::beginTransaction();

        try {
            BunnyVideoService::delete($video->bunny_video_id);
            $video->delete();

            DB::commit();

            return redirect()
                ->route('meetings.show', $meeting)
                ->with('success', 'Video berhasil dihapus');

        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withErrors('Gagal menghapus video');
        }
    }

    public function playback(Meeting $meeting)
    {
        $video = $meeting->video;

        abort_if(! $video, 404);
        abort_if($video->status !== 'ready', 423);
        // abort_if(! Auth::user()->can('view', $meeting), 403);

        $embedUrl = BunnyVideoService::embedUrl(
            $video->library_id,
            $video->bunny_video_id,
            Auth::id()
        );

        return view('meetings.videos.playback', compact(
            'meeting',
            'video',
            'embedUrl'
        ));
    }

}
