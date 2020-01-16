<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CommentAnswer extends Model
{
    protected $fillable = ['description', 'date', 'hour', 'user_id'];

   public function user()
   {
       return $this->belongsTo(User::class);
   }
}
