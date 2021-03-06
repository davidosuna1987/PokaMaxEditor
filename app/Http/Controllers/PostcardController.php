<?php

namespace App\Http\Controllers;

use PDF;
use Image;
use App\Address;
use App\Postcard;
use App\PostcardAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use App\Http\Requests\CreatePostcardRequest;

class PostcardController extends Controller
{
    public function index()
    {
        $postcards = Postcard::with('user', 'user.address', 'senderAddress', 'recieverAddresses', 'senderAddress.address', 'recieverAddresses.address')->get();
        return view('pages.postcards.index', compact('postcards'));
    }

    public function create()
    {
        //
    }

    public function store(CreatePostcardRequest $request)
    {
        // return response()->json(['request' => $request->all()]);

        if($request->ajax()):

            $sender_data = $request->get('sender_data');

            $sender_address = Address::create([
              'company' => $sender_data['company'],
              'title' => $sender_data['title'],
              'name' => $sender_data['name'],
              'surnames' => $sender_data['surnames'],
              'address_line_1' => $sender_data['address_line_1'],
              'address_line_2' => $sender_data['address_line_2'],
              'city' => $sender_data['city'],
              'country' => $sender_data['country'],
              'zip_code' => $sender_data['zip_code'],
              'birthday' => $sender_data['birthday']
            ]);

            $reciever_data = $request->get('reciever_data');

            $reciever_data_addresses = [];
            foreach($reciever_data as $rd):
                $reciever_data_addresses[] = Address::create([
                  'company' => $rd['company'],
                  'title' => $rd['title'],
                  'name' => $rd['name'],
                  'surnames' => $rd['surnames'],
                  'address_line_1' => $rd['address_line_1'],
                  'address_line_2' => $rd['address_line_2'],
                  'city' => $rd['city'],
                  'country' => $rd['country'],
                  'zip_code' => $rd['zip_code'],
                  'birthday' => $rd['birthday']
                ]);
            endforeach;

            $custom_back_image_isset = $request->custom_back_image['isset'];
            if(!$custom_back_image_isset):
              $font_data = $request->get('font_data');
              $font_color = is_array($font_data['color']) ? $font_data['color']['hex'] : $font_data['color'];
            endif;
            $has_signature = $request->get('signature')['image'] and !empty($request->get('signature')['image']);
            $has_company_logo = $request->get('company_logo')['image'] and !empty($request->get('company_logo')['image']);

            $postcard = new Postcard();
            $postcard->user_id = $request->get('company_id');
            $postcard->status = 'DRAFT';
            $postcard->product_name = $request->get('product_name');
            $postcard->has_custom_back_image = $custom_back_image_isset;
            $postcard->show_back_reciever = $custom_back_image_isset ? false : $request->get('show_back_reciever');
            if(!$custom_back_image_isset):
              $postcard->signature_width = $has_signature ? $request->get('signature')['width'] : null;
              $postcard->signature_position = $has_signature ? $request->get('signature')['position'] : null;
              $postcard->company_logo_width = $has_company_logo ? $request->get('company_logo')['width'] : null;
              $postcard->company_logo_position = $has_company_logo ? $request->get('company_logo')['position'] : null;
              $postcard->back_text = $request->get('back_text');
              $postcard->back_color = $font_color;
              $postcard->font_family = $font_data['font_family'];
              $postcard->font_size = $font_data['font_size'];
            endif;
            $postcard->save();

            $postcard_sender_address = PostcardAddress::create([
              'postcard_id' => $postcard->id,
              'address_id' => $sender_address->id,
              'type' => 'sender'
            ]);

            foreach($reciever_data_addresses as $rda):
                $postcard_reciever_address = PostcardAddress::create([
                  'postcard_id' => $postcard->id,
                  'address_id' => $rda->id,
                  'type' => 'reciever'
                ]);
            endforeach;

            $cbio = null;
            $temp_postcard = [];
            $temp_postcard['signature_file_path'] = null;
            $temp_postcard['company_logo_file_path'] = null;
            $temp_postcard['custom_back_image_file_path'] = null;

            $temp_file_path = public_path().'/images/postcards/'.$postcard->id.'/';
            File::cleanDirectory($temp_file_path);
            File::makeDirectory($temp_file_path, $mode = 0777, true, true);

            if($custom_back_image_isset):
              $custom_back_image = $request->get('custom_back_image');

              $custom_back_image_file = $custom_back_image['image'];
              $custom_back_image_file_name = 'b-'.str_random(25).'.jpg';

              $cbi = Image::make($custom_back_image_file)->resize(1000, null, function($c){
                  $c->aspectRatio();
                })->save($temp_file_path.$custom_back_image_file_name);

              $cbiw = $cbi->width();
              $cbih = $cbi->height();
              $cbio = $cbiw >= $cbih ? 'horizontal' : 'vertical';

              $temp_postcard['custom_back_image_file_path'] = asset('images/postcards/'.$postcard->id.'/'.$custom_back_image_file_name);
            else:
              $signature = $request->get('signature');

              if($has_signature):
                  $signature_file = $signature['image'];
                  $signature_file_name = 's-'.str_random(25).'.png';
                  $signature_width = $request->get('signature')['width'] + 100;

                  // Image::make($signature_file)->save($temp_file_path.$signature_file_name);

                  Image::make($signature_file)->resize($signature_width, null, function($c){
                    $c->aspectRatio();
                  })->save($temp_file_path.$signature_file_name);

                  $temp_postcard['signature_file_path'] = asset('images/postcards/'.$postcard->id.'/'.$signature_file_name);
              endif;

              $company_logo = $request->get('company_logo');

              if($has_company_logo):
                  $company_logo_file = $company_logo['image'];
                  $company_logo_file_name = 'l-'.str_random(25).'.png';
                  $company_logo_width = $request->get('company_logo')['width'] + 100;

                  // Image::make($company_logo_file)->save($temp_file_path.$company_logo_file_name);

                  Image::make($company_logo_file)->resize($company_logo_width, null, function($c){
                    $c->aspectRatio();
                  })->save($temp_file_path.$company_logo_file_name);

                  $temp_postcard['company_logo_file_path'] = asset('images/postcards/'.$postcard->id.'/'.$company_logo_file_name);
              endif;
            endif;

            if($request->get('original_file')):
                $original_file = $request->get('original_file');
                $original_file_name = 'o-'.str_random(25).'.jpg';

                Image::make($original_file)->save($temp_file_path.$original_file_name);

                $temp_postcard['front_original_file_path'] = asset('images/postcards/'.$postcard->id.'/'.$original_file_name);
            endif;

            if($request->get('cropped_file')):
                $cropped_file = $request->get('cropped_file');
                $cropped_file_name = 'c-'.str_random(25).'.jpg';
                $thumbnail_file_name = 't-'.str_random(25).'.jpg';

                Image::make($cropped_file)->resize(1000, null, function($c){
                  $c->aspectRatio();
                })->save($temp_file_path.$cropped_file_name);

                Image::make($cropped_file)->resize(120, null, function($c){
                  $c->aspectRatio();
                })->save($temp_file_path.$thumbnail_file_name);

                $temp_postcard['front_cropped_file_path'] = asset('images/postcards/'.$postcard->id.'/'.$cropped_file_name);

                $temp_postcard['front_thumbnail_file_path'] = asset('images/postcards/'.$postcard->id.'/'.$thumbnail_file_name);
            endif;

            $postcard->update([
              'custom_back_image_file_path' => $temp_postcard['custom_back_image_file_path'],
              'custom_back_image_orientation' => $cbio,
              'signature_file_path' => $temp_postcard['signature_file_path'],
              'company_logo_file_path' => $temp_postcard['company_logo_file_path'],
              'front_cropped_file_path' => $temp_postcard['front_cropped_file_path'],
              'front_original_file_path' => $temp_postcard['front_original_file_path'],
              'front_thumbnail_file_path' => $temp_postcard['front_thumbnail_file_path'],
            ]);

            $pdf_file_path = public_path().'/pdf/postcards/'.$postcard->id.'/';
            File::cleanDirectory($pdf_file_path);
            File::makeDirectory($pdf_file_path, $mode = 0777, true, true);
            $pdf = PDF::loadView( 'layouts.postcard', compact('postcard', 'reciever_data_addresses'))
                      // ->setPaper('a1', 'landscape')
                      ->save($pdf_file_path.'postcard.pdf');

            return response()->json([
                'postcard_id' => $postcard->id,
                'temp_postcard' => $temp_postcard,
                'message' => "Your postcard was saved as 'DRAFT' correctly!"
            ]);

        endif;
    }

    public function show(Postcard $postcard)
    {
        //
    }

    public function edit(Postcard $postcard)
    {
        //
    }

    public function update(Request $request, $postcard_id)
    {
        return response()->json(['message' => "This is an update action!"]);
    }

    public function destroy(Postcard $postcard)
    {
        //
    }

    public function tempFill(CreatePostcardRequest $request)
    {
        // return response()->json(['post' => $request->all()]);
        if($request->ajax()):

            $temp_postcard = [];
            $temp_postcard['company_logo_file_path'] = null;

            if($request->get('original_file')):
              // return response()->json(['original_file' => $request->get('original_file')]);
                $original_file = $request->get('original_file');
                $temp_file_path = public_path().'/images/temp-postcards/'.auth()->user()->id.'/';
                if(File::exists($temp_file_path.'postcard-front-original.jpg')):
                    unlink($temp_file_path.'postcard-front-original.jpg');
                endif;
                File::makeDirectory($temp_file_path, $mode = 0777, true, true);

                Image::make($original_file)
                            ->save($temp_file_path.'postcard-front-original.jpg');

                $temp_postcard['front_original_file_path'] = asset('images/temp-postcards/'.auth()->user()->id.'/postcard-front-original.jpg');
            endif;

            if($request->get('cropped_file')):
              // return response()->json(['cropped_file' => $request->get('cropped_file')]);
                $cropped_file = $request->get('cropped_file');
                $temp_file_path = public_path().'/images/temp-postcards/'.auth()->user()->id.'/';
                if(File::exists($temp_file_path.'postcard-front-cropped.jpg')):
                    unlink($temp_file_path.'postcard-front-cropped.jpg');
                endif;
                File::makeDirectory($temp_file_path, $mode = 0777, true, true);

                Image::make($cropped_file)
                            ->resize(1000, null, function($c){
                              $c->aspectRatio();
                            })
                            ->save($temp_file_path.'postcard-front-cropped.jpg');

                $temp_postcard['front_cropped_file_path'] = asset('images/temp-postcards/'.auth()->user()->id.'/postcard-front-cropped.jpg');
            endif;

            $sender_data = $request->get('sender_data');

            $sender_address = Address::create([
              'name' => $sender_data['name'],
              'address_line_1' => $sender_data['address_line_1'],
              'address_line_2' => $sender_data['address_line_2'],
              'city' => $sender_data['city'],
              'country' => $sender_data['country'],
              'zip_code' => $sender_data['zip_code']
            ]);

            $reciever_data = $request->get('reciever_data');

            $reciever_address = Address::create([
              'company' => $reciever_data['company'],
              'title' => $reciever_data['title'],
              'name' => $reciever_data['name'],
              'surnames' => $reciever_data['surnames'],
              'address_line_1' => $reciever_data['address_line_1'],
              'address_line_2' => $reciever_data['address_line_2'],
              'city' => $reciever_data['city'],
              'country' => $reciever_data['country'],
              'zip_code' => $reciever_data['zip_code'],
              'birthday' => $reciever_data['birthday']
            ]);

            $font_data = $request->get('font_data');
            $font_color = is_array($font_data['color']) ? $font_data['color']['hex'] : $font_data['color'];

            $postcard = Postcard::create([
              'user_id' => auth()->user()->id,
              'product_name' => $request->get('product_name'),
              'front_cropped_file_path' => $temp_postcard['front_cropped_file_path'],
              'front_original_file_path' => $temp_postcard['front_original_file_path'],
              'back_text' => $request->get('back_text'),
              'show_back_reciever' => $request->get('show_back_reciever'),
              'back_color' => $font_color,
              'font_family' => $font_data['font_family'],
              'font_size' => $font_data['font_size'],
              'sender_address_id' => $sender_address->id,
              'reciever_address_id' => $reciever_address->id
            ]);

            return response()->json([
                'temp_postcard' => $temp_postcard,
                'message' => "Your postcard was saved as 'DRAFT' correctly!"
            ]);

        endif;
    }

    public function userPostcards()
    {
        $postcards = auth()->user()->postcards()->with('sender_address', 'reciever_address')->get();
        return view('profile.postcards', compact('postcards'));
    }
}
