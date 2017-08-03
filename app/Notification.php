<?php

namespace App\Models\Explore;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    public function user(){
    	return $this->belongsTo(User::class);
    }
}