<?php

namespace App\Http\Controllers;

use App\AddressList;
use Illuminate\Http\Request;

use App\Http\Requests\CreateUpdateAddressListRequest;

class AddressListController extends Controller
{
    public function apiCreate(CreateUpdateAddressListRequest $request)
    {
        $address_list = AddressList::create([
            'company_id' => $request->get('company_id'),
            'name' => $request->get('name')
        ]);

        return response()->json([
            'address_list' => $address_list,
            'message' => $address_list->name.' list was created correctly!'
        ]);
    }

    public function apiUpdate(CreateUpdateAddressListRequest $request, $id)
    {
        $address_list = AddressList::findOrFail($id);
        $address_list->update([
            'name' => $request->get('name')
        ]);
        $address_list->save();

        return response()->json([
            'address_list' => $address_list,
            'message' => $address_list->name.' list was updated correctly!'
        ]);
    }

    public function apiDelete($id)
    {
        $address_list = AddressList::findOrFail($id);
        $address_list->delete();

        return response()->json([
            'address_list' => $address_list,
            'message' => $address_list->name.' list was deleted correctly!'
        ]);
    }
}
