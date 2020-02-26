<?php

namespace App\Models;

use App\User;
use App\Models\like;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function like(){
        $this->likes()->firstOrCreate([
            'user_id' => auth()->id()
        ]);
    }

    public function isLiked(){
        $this->likes()->where('user_id', auth()->id())->exists();
    }
}
