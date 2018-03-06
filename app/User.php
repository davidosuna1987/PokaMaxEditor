<?php

namespace App;

use App\Company;
use App\Postcard;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'surnames', 'email', 'username', 'password',
        'provider_id', 'api_token', 'active', 'role_id',
    ];

    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    public function fullName(){
        return $this->name.' '.$this->surnames;
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role){
        return $this->role->slug == $role;
    }

    public function isGod(){
        return $this->role->slug == 'god';
    }

    public function isAdmin(){
        return $this->role->slug == 'god'
                or $this->role->slug == 'admin'
                or $this->role->slug == 'developer';
    }

    public function isActiveUser(){
        return $this->active;
    }

    public function postcards(){
        return $this->hasMany(Postcard::class);
    }

    public function companies(){
        return $this->hasMany(Company::class);
    }
}
