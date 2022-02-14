<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Permission;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
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
        try {
            Permission::get()->map(function ($permission) {
                Gate::define($permission->slug, function ($user) use ($permission) {
                    return $user->hasPermissionThroughRole($permission);
                });
            });
        } catch (\Exception $e) {
            report($e);
            return false;
        }

        Gate::define('restaurant-profile', function (Account $account, Account $profile) {
            return $account->id === $profile->id;
        });


//        Blade directive for deleting offer
        Blade::if('canDelete', function () {
            if ((auth()->user()->account_type_id == Account::IS_ADMIN && auth()->user()->can('manage-offers')) || auth()->user()->account_type_id == Account::IS_RESTAURANT){
                return true;
            }
        });
    }
}
