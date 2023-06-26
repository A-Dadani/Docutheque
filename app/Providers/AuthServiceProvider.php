<?php

namespace App\Providers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('view-messages', function(User $user) {
            return (($user->confirmed) && (($user->role == 'RespoCommunication') || ($user->role == 'admin'))); //Change or add rules here
        });

        Gate::define('delete-messages', function(User $user) {
            return (($user->confirmed) && (($user->role == 'RespoCommunication') || ($user->role == 'admin'))); //Change or add rules here
        });

        Gate::define('view-registration-requests', function(User $user) {
            return (($user->confirmed) && ($user->role == 'admin'));
        });

        Gate::define('delete-registration-requests', function(User $user) {
            return (($user->confirmed) && ($user->role == 'admin'));
        });

        Gate::define('confirm-user', function(User $user) {
            return (($user->confirmed) && ($user->role == 'admin'));
        });

        Gate::define('delete-department', function(User $user) {
            return (($user->confirmed) && ($user->role == 'admin'));
        });

        Gate::define('add-department', function(User $user) {
            return (($user->confirmed) && ($user->role == 'admin'));
        });

        Gate::define('view-documents', function(User $user) {
            return (($user->confirmed) 
                && (($user->role == 'admin') || ($user->role == 'chefDep') || ($user->role == 'employeDep')));
        });

        Gate::define('delete-documents', function(User $user) {
            return (($user->confirmed) 
                && (($user->role == 'admin') || ($user->role == 'chefDep')));
        });

        Gate::define('access-specific-document', function(User $user, Document $document) {
            return (($user->confirmed)
                && (($user->role == 'admin') || ($user['department_id'] == $document['department_id'])));
        });

        Gate::define('create-documents', function(User $user) {
            return (($user->confirmed)
                && ($user->role == 'admin' 
                    || $user->role == 'chefDep')
                    || $user->role == 'employeDep');
        });
    }
}
