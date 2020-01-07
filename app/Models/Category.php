<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'url', 'image', 'description'];

    public function rules($id = '')
    {
        return [
            'name'        => 'required|min:3|max:100',
            'url'         => "required|min:3|max:100|unique:categories,url,{$id},id",
            'description' => 'required|min:3|max:200',
            'image'       => 'image'
        ];
    }
}
