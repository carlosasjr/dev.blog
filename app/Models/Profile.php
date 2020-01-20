<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = ['name', 'label'];


    public function rules($id = '')
    {
     return [
         'name'  => 'required|min:3|max:60',
         'label' => 'required|min:3|max:200',
     ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'profile_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_profile');
    }
}
