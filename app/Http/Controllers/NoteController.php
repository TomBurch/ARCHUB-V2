<?php

namespace App\Http\Controllers;

use App\Discord;
use App\Models\Mission;
use App\Models\MissionNote;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Mission $mission)
    {
    }

    public function store(Request $request, Mission $mission)
    {
        $this->authorize('test-mission', $mission);

        $user = auth()->user();
        $text = $request->input('text');
        $published = $request->input('published');

        $note = MissionNote::updateOrCreate([
            'user_id' => $user->id,
            'mission_id' => $mission->id,
            'published' => false,
        ], [
            'text' => $text,
            'published' => $published,
        ]);

        if ($published) {
            $content = "**{$note->user->username}** added a note to **{$note->mission->display_name}**";
            Discord::missionUpdate($content, $mission, true, $note->mission->url());
        }
    }

    public function delete(Mission $mission, MissionNote $note)
    {
        $this->authorize('delete-note', $note);

        $note->delete();
    }
}
