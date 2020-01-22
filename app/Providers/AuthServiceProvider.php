<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Post;
use App\Policies\PostPolicy;
use App\User;
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
       //  Post::class => PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
      //  $this->registerPolicies();

      $permissions = Permission::all();

      foreach ($permissions as $permission) {
          Gate::define($permission->name , function (User $user) use ($permission) {
              return $user->hasPermission($permission);
          })  ;
      }

      Gate::before(function (User $user, $ability) {
          if ($user->hasProfile('Admin')) {
              return true;
          }
      });




     /*
         //Usando Gate de forma direta
        //O ideal é utilizar Policies
        Gate::define('post_view', function (User $user, Post $post) {
           return $user->id == $post->user_id;
        });



        //definir condição que não tem restrição
        //se a condição for atendida nenhum Gate acima terá validade
        Gate::before(function (User $user) {
           return $user->email == 'contato@carlosasjr.com.br';
        });*/
    }
}
