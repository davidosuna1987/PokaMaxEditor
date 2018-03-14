<?php

namespace App\Http\Controllers;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postcards = Postcard::with('user', 'user.address', 'senderAddress', 'recieverAddresses', 'senderAddress.address', 'recieverAddresses.address')->get();
        return view('pages.postcards.index', compact('postcards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostcardRequest $request)
    {
        // return response()->json(['request' => $request->all()]);
        if($request->ajax()):

            $temp_postcard = [];

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

            $font_data = $request->get('font_data');

            $postcard = Postcard::create([
              'user_id' => $request->get('company_id'),
              'status' => 'DRAFT',
              'product_name' => $request->get('product_name'),
              'front_cropped_file_path' => 'waiting',
              'front_original_file_path' => 'waiting',
              'back_text' => $request->get('back_text'),
              'font_family' => $font_data['font_family'],
              'font_size' => $font_data['font_size']
            ]);

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

            $temp_file_path = public_path().'/images/postcards/'.$postcard->id.'/';
            File::cleanDirectory($temp_file_path);
            File::makeDirectory($temp_file_path, $mode = 0777, true, true);

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
              'front_cropped_file_path' => $temp_postcard['front_cropped_file_path'],
              'front_original_file_path' => $temp_postcard['front_original_file_path'],
              'front_thumbnail_file_path' => $temp_postcard['front_thumbnail_file_path'],
            ]);

            return response()->json([
                'postcard_id' => $postcard->id,
                'temp_postcard' => $temp_postcard,
                'message' => "Your postcard was saved as 'DRAFT' correctly!"
            ]);

        endif;

    }

    /**
     * Display the specified resource.
     */
    public function show(Postcard $postcard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Postcard $postcard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $postcard_id)
    {
        return response()->json(['message' => "Your postcard was updated correctly!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Postcard  $postcard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Postcard $postcard)
    {
        //
    }

    public function tempFill(CreatePostcardRequest $request)
    {
        // return response()->json(['post' => $request->all()]);
        if($request->ajax()):

            $temp_postcard = [];

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

            $postcard = Postcard::create([
              'user_id' => auth()->user()->id,
              'product_name' => $request->get('product_name'),
              'front_cropped_file_path' => $temp_postcard['front_cropped_file_path'],
              'front_original_file_path' => $temp_postcard['front_original_file_path'],
              'back_text' => $request->get('back_text'),
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
