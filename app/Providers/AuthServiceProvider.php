<?php

namespace App\Providers;

use App\Models\Mission;
use App\Models\MissionComment;
use App\Models\MissionNote;
use App\RoleEnum;
use App\Models\User;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-hub', function (User $user) {
            return $user->hasARole(RoleEnum::ARMA_MEMBER, RoleEnum::ARMA_RECRUIT);
        });

        Gate::define('test-mission', function (User $user, Mission $mission) {
            // Includes adding notes, downloading missions,
            // reading locked briefings, and seeing unverified missions
            return $mission->user->is($user) || $user->hasARole(RoleEnum::TESTER);
        });

        Gate::define('verify-missions', function (User $user) {
            return $user->hasARole(RoleEnum::SENIOR_TESTER);
        });

        Gate::define('delete-comment', function (User $user, MissionComment $comment) {
            return $comment->user->is($user);
        });

        Gate::define('delete-note', function (User $user, MissionNote $note) {
            return $note->user->is($user);
        });
    }
}
