<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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



    public static function loginWithFacebook($socialiteUser)
    {
        $instance = (new static)->firstOrNew([
            'email' => $socialiteUser->email, 
        ])->fill([
            'name' => $socialiteUser->name,
            'fb_access_token' => $socialiteUser->token, 
            'active' => 1, 
        ]); 

        $instance->save(); 

        auth()->login($instance, true); 

        return $instance; 
    }


    public function activate()
    {
        $this->active = 1; 
        $this->save(); 
        return $this; 
    }


    public function isActive()
    {
        return $this->active == 1; 
    }


    public function isAdmin()
    {
        return $this->is_admin == 1;         
    }

}
