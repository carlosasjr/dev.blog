<?php

namespace App;

use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'facebook',
        'twitter',
        'github',
        'site',
        'bibliograply',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    private static function crypt($model)
    {
        if (isset($model->password)) {
            $model->password = bcrypt($model->password);
        }
    }


    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
           self::crypt($model);
        });

        self::updating(function ($model) {
            self::crypt($model);
        });
    }

    public function rules($id = '')
    {
        return [
            'name' => 'required|min:3|max:100',
            'email' => "required|min:3|max:100|email|unique:users,email,{$id},id",
            'password' => 'required|min:3|max:20|confirmed',
            'facebook' => 'min:3|max:100',
            'twitter' => 'min:3|max:100',
            'github' => 'min:3|max:100',
            'site' => 'min:3|max:100',
            'bibliograply' => 'min:3|max:1000',
            'image' => 'image'
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_user');
    }


    public function hasPermission(Permission $permission)
    {
        return $this->hasProfile($permission->profiles()->get());
    }


    public function hasProfile($profile)
    {
        if (is_string($profile)) {
            return $this->profiles()->get()->contains('name', $profile);
        }

        return !!$profile->intersect($this->profiles()->get())->count();
    }

}
