<?php

namespace App;

use App\User;
use App\Address;
use App\Company;
use Illuminate\Database\Eloquent\Model;

class AddressList extends Model
{
    protected $table = 'address_lists';

    protected $fillable = ['company_id', 'name'];

    public function company(){
      return $this->belongsTo(Company::class);
    }

    public function addresses(){
      return $this->hasMany(Address::class);
    }
}
