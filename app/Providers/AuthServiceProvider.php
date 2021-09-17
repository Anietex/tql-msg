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

       Gate::define('manage-admins', function (){
           $user = auth()->user();
           if($user){
               return $user->role->name === 'superadmin';
           }
           return false;
       });


        Gate::define('manage-companies', function (){
            $user = auth()->user();
            if($user){
                return in_array($user->role->name, ['admin','superadmin']);
            }
            return false;
        });


        Gate::define('manage-employees', function (){
            $user = auth()->user();
            if($user){
                return in_array($user->role->name, ['admin','superadmin','company']);
            }
            return false;
        });
    }
}
