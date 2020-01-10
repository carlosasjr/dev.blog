<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'url',
        'image',
        'user_id',
        'category_id',
        'description',
        'date',
        'hour',
        'featured',
        'status'
    ];

    public function rules($id = '')
    {
        return [
            'title'         => "required|min:3|max:250|unique:posts,title,{$id},id",
            'category_id'   => 'required',
            'description'   => 'required|min:50|max:6000',
            'date'          => 'required|date',
            'hour'          => 'required',
            'status'        => 'required|in:A,R',
            'image'         => 'image',
        ];
    }
}
