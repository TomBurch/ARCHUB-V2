<?php

namespace App\Http\Controllers;

use App\Discord;
use App\Models\Mission;
use App\Models\MissionComment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Mission $mission)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Mission $mission)
    {
        $this->authorize('test-mission', $mission);

        $user = auth()->user();
        $text = $request->input('text');
        $published = $request->input('published');

        $comment = MissionComment::updateOrCreate([
            'user_id' => $user->id,
            'mission_id' => $mission->id,
            'published' => false,
        ], [
            'text' => $text,
            'published' => $published,
        ]);

        if ($published) {
            $message = "**{$comment->user->username}** commented on **{$comment->mission->display_name}**";
            Discord::missionUpdate($message, $comment->mission, true, $mission->url());
        }
    }
}
