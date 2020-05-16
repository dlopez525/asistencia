<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleRegister extends Model
{
    protected $table = 'schedules_register';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
