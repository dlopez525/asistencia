<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function role()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    public function degree()
    {
        return $this->hasMany('App\Degree')
                    ->using('App\DegreeUser');
    }

    public function courses()
    {
        return $this->hasManyThrough(
            'App\Course',
            'App\DegreeUser',
            'user_id',
            'degree_id',
            'id',
            'degree_id'
        );
    }

    public function schedule()
    {
        return $this->hasMany('App\Schedule');
    }

    public function asistence()
    {
        return $this->hasMany('App\ScheduleRegister');
    }
}
