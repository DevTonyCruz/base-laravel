<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\User;
use App\Models\Roles;
use App\Models\Configurations;

class GlobalVariablesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $total_roles = (Schema::hasTable('roles')) ? Roles::count() : 0;
        view()->share('total_roles', $total_roles);

        $total_users = (Schema::hasTable('users')) ? User::count() : 0;
        view()->share('total_users', $total_users);

        $total_configutarions = (Schema::hasTable('configuration')) ? Configurations::count() : 0;
        view()->share('total_configutarions', $total_configutarions);
    }
}
