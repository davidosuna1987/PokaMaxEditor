<?php

namespace App;

use App\User;
use App\Address;
use Illuminate\Database\Eloquent\Model;

class AddressList extends Model
{
    protected $table = 'address_lists';

    protected $fillable = ['user_id', 'name'];

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function addresses(){
      return $this->hasMany(Address::class);
    }
}
