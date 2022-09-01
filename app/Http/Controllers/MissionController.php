<?php

namespace App\Http\Controllers;

use App\Helpers\PBOMission\PBOMission;
use App\Models\Mission;

use \stdClass;
use Faker\Factory;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function index(Mission $mission)
    {
        $mission = Mission::with('user:id,username')->select('id', 'user_id', 'display_name', 'mode', 'summary')->firstWhere('id', $mission->id)->toArray();
        return inertia('Hub/Missions/Mission', [
            'mission' => $mission,
        ]);
    }

    public function store(Request $request)
    {
        $missionFile = $request->file('mission');
        $fileName = $missionFile->getClientOriginalName();
        $user = auth()->user();

        // Temporarily store locally
        $path = $missionFile->storeAs(
            "missions/{$user->id}",
            $fileName
        );

        $contents = $this->getMissionContents($path);
        $details = $this->getDetailsFromFileName($fileName);
        
        $mission = Mission::create([
            'user_id' => $user->id,
            'display_name' => $contents['mission']['name'],
            'mode' => $details->mode,
            'summary' => $contents['mission']['description'],
        ]);
    }

    public function getMissionContents(string $path) {
        $mission = new PBOMission(storage_path("app/{$path}"));
        $contents = $mission->export();

        // if ($mission->error) {
        //     return new Exception($mission->errorReason);
        // }

        return $contents;
    }

    public function getDetailsFromFileName($name) {
        $name = substr($name, 0, -4);
        $mapName = last(explode('.', $name));
        $parts = explode('_', rtrim($name, ".{$mapName}"));
        $mode = strtolower($parts[1]);

        $details = new stdClass();
        $details->mode = $mode;
        $details->map = $mapName;

        return $details;
    }
}
