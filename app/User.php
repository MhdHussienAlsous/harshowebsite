<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


use Zizaco\Entrust\Traits\EntrustUserTrait;
use Eloquent;


class User extends Authenticatable
{
    use EntrustUserTrait;
    
    // relationship one to one between person and user
    public function person(){
        return $this->hasOne(Person::class , 'user_id');
    }

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

}
