<?php

namespace App\Models;

use App\User;
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function views()
    {
        return $this->hasMany(PostView::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);


        /*return $this->hasMany(Comment::class)
                    ->join('users', 'users.id', 'comments.user_id')
                    ->select('comments.id', 'comments.description', 'comments.name', 'users.image as image_user')
            ->where('comments.status', 'A');*/
    }
}
