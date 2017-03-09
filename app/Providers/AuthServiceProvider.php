<?php

namespace App\Providers;

use App\Group;
use App\Membership;
use App\Policies\GroupPolicy;
use App\Policies\MemberPolicy;
use App\Policies\NotePolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Group::class => GroupPolicy::class,
        User::class => MemberPolicy::class,
        Note::class => NotePolicy::class,
        Membership::class => Membership::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
