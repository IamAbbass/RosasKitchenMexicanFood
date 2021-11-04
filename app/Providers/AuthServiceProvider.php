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

        /* define owner permission */
        Gate::define('isOwner', function($user) {
            return $user->role->permission == 'Owner';
        });

        /* define admin permission */
        Gate::define('isAdmin', function($user) {
            return $user->role->permission == 'Admin';
        });

        /* define manager permission */
        Gate::define('isManager', function($user) {
            return $user->role->permission == 'Manager';
        });

        /* define user permission */
        Gate::define('isUser', function($user) {
            return $user->role->permission == 'User';
        });

        ###########################################
        ###########################################

        /* define index permission */
        Gate::define('isIndex', function($user) {
            return $user->role->index == true;
        });

        /* define create permission */
        Gate::define('isCreate', function($user) {
            return $user->role->create == true;
        });

        /* define store permission */
        Gate::define('isStore', function($user) {
            return $user->role->store == true;
        });

        /* define show permission */
        Gate::define('isShow', function($user) {
            return $user->role->show == true;
        });

        /* define edit permission */
        Gate::define('isEdit', function($user) {
            return $user->role->edit == true;
        });

        /* define update permission */
        Gate::define('isUpdate', function($user) {
            return $user->role->update == true;
        });

        /* define destroy permission */
        Gate::define('isDestroy', function($user) {
            return $user->role->destroy == true;
        });

        /* define status permission */
        Gate::define('isAvailable', function($user) {
            return $user->role->is_available == true;
        });
        
    }
}
