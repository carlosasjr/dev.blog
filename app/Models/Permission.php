<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'label'];

    public function rules($id = '')
    {
        return [
            'name'  => 'required|min:3|max:60',
            'label' => 'required|min:3|max:200',
        ];
    }


    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'permission_profile');
    }
}
