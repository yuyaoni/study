<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // Teamsテーブルとのリレーション （主テーブル側）
    public function o_teams() {
       return $this->hasMany('App\Team');
   }
   
    // Teamsテーブルとの多対多リレーション
     public function my_teams() {
        return $this->belongsToMany('App\Team');
    }
    
    // Recordテーブルとの多対多リレーション
    //  public function records() {
    //     return $this->belongsToMany('App\Record');
    // }
}
