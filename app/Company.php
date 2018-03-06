<?php

namespace App;

use App\User;
use App\Address;
use App\Postcard;
use App\AddressList;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = ['user_id', 'address_id'];

    public function user(){
      return $this->belongsTo(User::class);
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
