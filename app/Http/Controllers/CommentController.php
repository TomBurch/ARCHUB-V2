<?php

namespace App\Http\Controllers;

use App\Discord;
use App\Models\Missions\Mission;
use App\Models\Missions\MissionComment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Mission $mission)
    {
    }

    public function store(Request $request, Mission $mission)
    {
        $this->authorize('test-mission', $mission);

        $text = $request->input('text');
        $published = $request->input('published');

        $comment = MissionComment::updateOrCreate([
            'user_id' => auth()->user()->id,
            'mission_id' => $mission->id,
            'published' => false,
        ], [
            'text' => $text,
            'published' => $published,
        ]);

        if ($published) {
            Discord::missionUpdate("**{$comment->user->username}** added a comment", $comment->mission, true);
        }
    }

    public function delete(Mission $mission, MissionComment $comment)
    {
        $this->authorize('update-comment', $comment);

        $comment->delete();
    }

    public function update(Request $request, Mission $mission, MissionComment $comment)
    {
        $this->authorize('update-comment', $comment);
        $text = $request->input('text');

        $comment->text = $text;
        $comment->save();
    }
}
