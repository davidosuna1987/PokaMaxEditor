<?php

namespace App;

use App\Address;
use App\Postcard;
use Illuminate\Database\Eloquent\Model;

class PostcardAddress extends Model
{
    protected $table = 'postcard_addresses';

    protected $fillable = ['postcard_id', 'address_id', 'type'];

    public function postcard(){
      return $this->belongsTo(Postcard::class);
    }

    public function address(){
      return $this->belongsTo(Address::class);
    }
}
