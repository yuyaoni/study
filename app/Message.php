<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // Usersテーブルとの多対多リレーション
    // public function sender() {
    //     return $this->belongsToMany('App\User');
    // }
    
    // Teamsテーブルとの多対多リレーション
    // public function room() {
    //     return $this->belongsToMany('App\Team');
    // }
    
    protected $fillable = [
        'login_id', 'name', 'comment'
    ];

    protected $guarded = [
        'create_at', 'update_at'
    ];
}
