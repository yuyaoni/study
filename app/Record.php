<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    // Userテーブルとの多対多リレーション
    // public function owners() {
    //     return $this->belongsToMany('App\User');
    // }
    
    protected $fillable = [
        'user_id', 'date', 'target_time','target_page','record_time','record_page'
    ];

    protected $guarded = [
        'create_at', 'update_at'
    ];
}
