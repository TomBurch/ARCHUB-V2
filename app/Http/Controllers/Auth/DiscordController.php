<?php

namespace App\Http\Controllers\Auth;

use App\Discord;
use App\RoleEnum;
use App\Models\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class DiscordController extends Controller
{
    /**
     * Redirect the user to the Discord login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect()
    {
        return Socialite::driver('discord')->redirect();
    }

    /**
     * Handles the response from Discord.
     *
     * @return \Illuminate\Http\Response
     */
    public function callback(Request $request)
    {
        $user = Socialite::driver('discord')->user();

        if (Discord::hasARole($user->id, RoleEnum::ARMA_MEMBER, RoleEnum::ARMA_RECRUIT)) {
            return $this->create($user);
        }

        return [
            'error' => 'You are not a member.'
        ];
    }

    /**
     * Creates the user account and redirects with the access token.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($data)
    {
        $user = User::firstOrCreate(
            ['discord_id' => $data->id],
            ['username' => $data->name, 'avatar' => $data->avatar,]
        );

        auth()->login($user, true);

        if ($user->can('access-hub')) {
            return redirect('/hub');
        }
        return redirect('/');
    }
}
