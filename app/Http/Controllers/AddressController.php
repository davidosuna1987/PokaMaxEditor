<?php

namespace App\Http\Controllers;

use Excel;
use App\Address;
use App\AddressList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\AddressMultipleInsertRequest;

class AddressController extends Controller
{
    public function csvImport(Request $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $results = Excel::load($path, function($reader) {})->ignoreEmpty()->get();

        if(!empty($results) && $results->count()):
            $addresses = collect();

            foreach($results as $index => $row):
                // Check for empty rows and pass to the next
                if($row->street === null or $row->city === null or $row->country === null or $row->zip === null or $row->firstname === null or $row->lastname === null) continue;

                $addresses->push(new Address([
                    'address_line_1' => $row->street,
                    'address_line_2' => null,
                    'city' => $row->city,
                    'country' => $row->country,
                    'zip_code' => $row->zip,
                    'company' => $row->company,
                    'title' => $row->title,
                    'name' => $row->firstname,
                    'surnames' => $row->lastname,
                    'birthday' => strtotime($row->birthday) === false ? null : $row->birthday
                ]));
            endforeach;

            return response()->json(['addresses' => $addresses]);
        endif;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function apiUpdate(Request $request, $id)
    {
        //
    }

    public function delete($id)
    {
        //
    }

    public function apiDelete($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        return response()->json([
            'address' => $address,
            'message' => $address->name.' '.$address->surnames.' address was deleted correctly!'
        ]);
    }

    public function apiSetNullAddressList($id)
    {
        $address = Address::findOrFail($id);
        $address->update([
            'address_list_id' => null
        ]);
        $address->save();

        return response()->json([
            'address' => $address,
            'message' => $address->name.' '.$address->surnames.' address was changed address list correctly!'
        ]);
    }

    public function apiAddressListsInsert(AddressMultipleInsertRequest $request, $id)
    {
        $address_list = AddressList::find($id);
        $addresses = $request->get('addresses');

        $addresses_collect = collect();
        foreach($addresses as $address):
            $addresses_collect->push(new Address([
                'company' => $address['company'],
                'title' => $address['title'],
                'name' => $address['name'],
                'surnames' => $address['surnames'],
                'address_line_1' => $address['address_line_1'],
                'address_line_2' => $address['address_line_2'],
                'city' => $address['city'],
                'country' => $address['country'],
                'zip_code' => $address['zip_code'],
                'birthday' => $address['birthday']
            ]));
        endforeach;

        $address_list->addresses()->saveMany($addresses_collect);

        return response()->json([
            'address_list' => $address_list,
            'message' => 'Selected contacts was added to '.$address_list->name.' address list correctly!'
        ]);
    }
}
