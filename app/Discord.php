<?php

namespace App;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Discord
{
    private static function getUser(int $discord_id)
    {
        return Cache::remember($discord_id, 60, function () use ($discord_id) {
            $url = "https://discord.com/api/v8/guilds/" .
            config('services.discord.server_id') . "/members/{$discord_id}";

            $response = HTTP::withHeaders([
                'Authorization' => "Bot ".config('services.discord.token')
            ])->get($url);
            
            if ($response->successful()) {
                return (array)$response->json();
            }

            throw new AuthorizationException("Error getting user from discord ". $response->status());
        });
    }

    public static function hasARole(int $discord_id, RoleEnum ...$roles)
    {
        $usersRoles = self::getUser($discord_id)["roles"];
        foreach ($roles as $role) {
            if (in_array($role->id(), $usersRoles)) {
                return true;
            }
        }
        return false;
    }
}
