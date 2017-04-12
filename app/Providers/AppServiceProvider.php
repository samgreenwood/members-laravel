<?php

namespace App\Providers;

use App\Group;
use App\Observers\User\LdapObserver as UserLdapObserver;
use App\Observers\Group\LdapObserver as GroupLdapObserver;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if(config('app.force_https')) {
            url()->forceScheme('https');
        }

        if(app()->environment('local')) {
            app()->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }

        User::observe(UserLdapObserver::class);
        Group::observe(GroupLdapObserver::class);
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        Schema::defaultStringLength(191);
        Carbon::setToStringFormat('Y-m-d');
    }
}
