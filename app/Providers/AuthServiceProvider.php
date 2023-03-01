<?php

namespace App\Providers;

use App\RoleEnum;
use App\Models\Missions\Mission;
use App\Models\Missions\MissionComment;
use App\Models\Missions\MissionNote;
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

    private function userOwnsMission($user, $mission) {
        return $mission->user->is($user) || $mission->maintainer->is($user);
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-hub', function (User $user) {
            return $user->hasARole(RoleEnum::ARMA_MEMBER, RoleEnum::ARMA_RECRUIT, RoleEnum::RETIRED);
        });

        Gate::define('test-missions', function (User $user) {
            return $user->hasARole(RoleEnum::TESTER);
        });

        Gate::define('test-mission', function (User $user, Mission $mission) {
            // Includes adding notes, downloading missions,
            // reading locked briefings, and seeing unverified missions
            return $this->userOwnsMission($user, $mission) || $user->hasARole(RoleEnum::TESTER);
        });

        Gate::define('view-mission', function (User $user, Mission $mission) {
            return $mission->verified_by || $user->can('test-mission', $mission);
        });

        Gate::define('verify-missions', function (User $user) {
            return $user->hasARole(RoleEnum::SENIOR_TESTER);
        });

        Gate::define('lock-briefings', function (User $user, Mission $mission) {
            return $this->userOwnsMission($user, $mission);
        });

        Gate::define('update-mission', function (User $user, Mission $mission) {
            return $this->userOwnsMission($user, $mission) || $user->hasARole(RoleEnum::OPERATIONS);
        });

        Gate::define('manage-media', function (User $user, Mission $mission) {
            return $this->userOwnsMission($user, $mission);
        });

        Gate::define('update-comment', function (User $user, MissionComment $comment) {
            return $comment->user->is($user);
        });

        Gate::define('update-note', function (User $user, MissionNote $note) {
            return $note->user->is($user);
        });

        Gate::define('view-applications', function (User $user) {
            return $user->hasARole(RoleEnum::STAFF);
        });

        Gate::define('manage-operations', function (User $user) {
            return $user->hasARole(RoleEnum::OPERATIONS);
        });

        Gate::define('delete-mission', function (User $user, Mission $mission) {
            return $user->hasARole(RoleEnum::OPERATIONS) || ($mission->user->is($user) && !($mission->last_played || !$mission->operations->isEmpty()));
        });

        Gate::define('set-maintainers', function (User $user) {
            return $user->hasARole(RoleEnum::OPERATIONS);
        });

        Gate::define('assign-tags', function (User $user, Mission $mission) {
            return $this->userOwnsMission($user, $mission) || $user->hasARole(RoleEnum::OPERATIONS);
        });

        Gate::define('manage-tags', function (User $user) {
            return $user->hasARole(RoleEnum::OPERATIONS);
        });
    }
}