<?php

namespace App\Http\Controllers;

use App\Discord;
use App\Models\Missions\Mission;
use App\Models\Missions\MissionNote;

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
            Discord::missionUpdate("**{$note->user->username}** added a note", $mission, true);
        }
    }

    public function delete(Mission $mission, MissionNote $note)
    {
        $this->authorize('update-note', $note);

        $note->delete();
    }

    public function update(Request $request, Mission $mission, MissionNote $note)
    {
        $this->authorize('update-note', $note);
        $text = $request->input('text');

        $note->text = $text;
        $note->save();
    }
}
