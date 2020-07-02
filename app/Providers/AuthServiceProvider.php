<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //Admin Role
        Gate::define('isVendor', function($user){
            return $user->role == '3' || $user->role == '2' || $user->role == '1';
        });
        //Admin Role
        Gate::define('isAdmin', function($user){
            return $user->role == '2' || $user->role == '1';
        });
        // Super Admin Role
        Gate::define('isSuperAdmin', function($user){
            return $user->role == '1';
        });
        //
    }
}
