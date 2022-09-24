<?php

namespace App;

use App\Models\Missions\Mission;
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
                'Authorization' => "Bot " . config('services.discord.token')
            ])->get($url);

            if ($response->successful()) {
                return (array)$response->json();
            }

            throw new AuthorizationException("Error getting user from discord " . $response->status());
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

    public static function notifyChannel(ChannelEnum $channel, string $content = null, Embed $embed = null)
    {
        $response = HTTP::post($channel->id(), [
            'content' => $content,
            'embeds' => [$embed],
        ]);

        return $response;
    }

    public static function missionUpdate(string $content, Mission $mission, bool $tagAuthor = false)
    {
        $pings = "";
        if ($tagAuthor && !$mission->user->is(auth()->user())) {
            $pings = "<@{$mission->user->discord_id}>";
        }

        $color = match ($mission->mode) {
            'coop' => 1267441,
            'tvt' => 13963300,
            'ade' => 889631,
        };
        $embed = new Embed($mission->display_name, $content, $color, $mission->url());

        self::notifyChannel(ChannelEnum::ARCHUB, $pings, $embed);
    }
}
