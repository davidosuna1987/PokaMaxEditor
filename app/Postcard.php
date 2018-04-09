<?php

namespace App;

use App\User;
use App\Address;
use App\PostcardAddress;
use Illuminate\Database\Eloquent\Model;

class Postcard extends Model
{
    protected $table = 'postcards';

    protected $fillable = [
      'user_id',
      'status',
      'product_name',
      'has_custom_back_image',
      'custom_back_image_file_path',
      'custom_back_image_orientation',
      'signature_width',
      'signature_position',
      'signature_file_path',
      'company_logo_width',
      'company_logo_position',
      'company_logo_file_path',
      'front_cropped_file_path',
      'front_original_file_path',
      'front_thumbnail_file_path',
      'back_text',
      'show_back_reciever',
      'back_color',
      'font_family',
      'font_size',
    ];

    public function user(){
      return $this->belongsTo(User::class);
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
