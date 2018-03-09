<?php

namespace App;

use App\Address;
use App\Postcard;
use App\AddressList;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'email',
        'username',
        'password',
        'provider_id',
        'api_token',
        'active',
        'role_id',
        'address_id',
    ];

    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    public function fullName(){
        return $this->address()->name.' '.$this->address()->surnames;
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function isSuperadmin(){
        return $this->role->slug == 'superadmin';
    }

    public function isAdmin(){
        return $this->role->slug == 'superadmin'
            or $this->role->slug == 'admin';
    }

    public function isActiveUser(){
        return $this->active;
    }

    public function hasRole($role){
        return $this->role->slug == $role;
    }

    public function address(){
      return $this->belongsTo(Address::class);
    }

    public function postcards(){
        return $this->hasMany(Postcard::class);
    }

    public function addressLists(){
      return $this->hasMany(AddressList::class);
    }
}
