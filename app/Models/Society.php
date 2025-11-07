<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    protected $fillable = [
        'user_id',
        'user_count',
    ];

    protected $casts = [
        'user_count' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
