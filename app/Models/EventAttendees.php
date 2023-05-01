<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAttendees extends Model
{
    use HasFactory;


    public function event()
    {
        return $this->belongsTo(Events::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'attendee_id');
    }

    public function inviter()
    {
        return $this->belongsTo(User::class, 'attendee_invited_by');
    }

  
}