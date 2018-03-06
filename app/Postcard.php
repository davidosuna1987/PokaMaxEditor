<?php

namespace App;

use App\Address;
use App\Company;
use App\PostcardAddress;
use Illuminate\Database\Eloquent\Model;

class Postcard extends Model
{
    protected $table = 'postcards';

    protected $fillable = [
      'company_id',
      'status',
      'product_name',
      'front_cropped_file_path',
      'front_original_file_path',
      'back_text',
      'font_family',
      'font_size'
      // 'sender_address_id',
      // 'reciever_address_id'
    ];

    public function company(){
      return $this->belongsTo(Company::class);
    }

    public function addresses(){
      return $this->hasMany(PostcardAddress::class);
    }

    public function senderAddress(){
      return $this->hasMany(PostcardAddress::class)->where('type', 'sender');
    }

    public function recieverAddresses(){
      return $this->hasMany(PostcardAddress::class)->where('type', 'reciever');
    }
}
