<?php

namespace App\Models\Explore;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'register_users';

    public function post(){
    	return $this->hasMany(Post::class);
    }

    public function comment(){
    	return $this->hasMany(Comment::class);
    }

    public function notification(){
    	return $this->hasMany(Notification::class);
    }
}