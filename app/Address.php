<?php

namespace App;

use App\Postcard;
use App\AddressList;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
      'address_line_1',
      'address_line_2',
      'city',
      'country',
      'zip_code',
      'company',
      'title',
      'name',
      'surnames',
      'birthday',
      'address_list_id'
    ];

    public function postcards(){
      return $this->belongsToMany(Postcard::class);
    }

    public function addressList(){
      return $this->belongsTo(AddressList::class);
    }
}
