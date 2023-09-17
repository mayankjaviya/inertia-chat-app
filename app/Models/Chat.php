<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['msg_from', 'msg_to', 'message'];

    public function msgFrom()
    {
        return $this->belongsTo(User::class, 'msg_from');
    }

    public function msgTo()
    {
        return $this->belongsTo(User::class, 'msg_to');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'msg_from');
    }
}
