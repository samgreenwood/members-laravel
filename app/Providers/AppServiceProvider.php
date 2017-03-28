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
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserLdapObserver::class);
        Group::observe(GroupLdapObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
        Carbon::setToStringFormat('Y-m-d');
    }
}
