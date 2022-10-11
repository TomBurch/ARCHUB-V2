<?php

namespace App\Http\Controllers;

use App\Discord;
use App\Http\Controllers\Controller;
use App\Models\Missions\Mission;

use Illuminate\Http\Request;

class MissionMaintainerController extends Controller
{
    public function store(Request $request, Mission $mission)
    {
        $this->authorize('set-maintainers');

        $maintainer_id = $mission->user->id == $request->new_maintainer["id"] ? null : $request->new_maintainer["id"];

        if (!is_null($maintainer_id)) {
            Discord::missionUpdate("Now maintained by **{$request->new_maintainer["username"]}**", $mission, true);
        }

        $mission->maintainer_id = $maintainer_id;
        $mission->save();
    }
}
