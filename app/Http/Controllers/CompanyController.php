<?php

namespace App\Http\Controllers;

use App\User;
use App\Company;
use App\Address;
use App\Postcard;
use App\AddressList;
use Illuminate\Http\Request;

use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\CreateUpdateCompanyFromEditorRequest;

class CompanyController extends Controller
{
    public function index()
    {
      $companies = User::where('role_id', 4)->with('address', 'postcards')->get();
      return view('pages.companies.index', compact('companies'));
    }

    public function apiIndex()
    {
      return User::where('role_id', 4)->with('address', 'postcards')->get();
    }

    public function apiIndexFromEditor()
    {
      // return Company::with('address', 'postcards', 'addressLists.addresses')->get();

      $companies = User::where('role_id', 4)->with('address', 'postcards', 'addressLists.addresses')->get();
      $customCompaniesArray = [];

      foreach ($companies as $company):
        $customCompaniesArray[$company->id] = $company;
        $postcards = $company->postcards();

        if($postcards->count()):
          $postcards = $postcards->get();
          $customPostcardsArray = [];

          foreach ($postcards as $postcard):
            $customPostcardsArray[$postcard->id] = $postcard;
          endforeach;

          $customCompaniesArray[$company->id]['postcards'] = $customPostcardsArray;
        endif;
      endforeach;

      return $customCompaniesArray;
    }

    public function show($id)
    {
      $company_id = $id;
      return view('pages.companies.show', compact('company_id'));
    }

    public function apiShow($id)
    {
      return User::where('role_id', 4)->with('address', 'postcards.senderAddress.address', 'postcards.recieverAddresses.address', 'addressLists.addresses')->findOrFail($id);

      // $company = Company::findOrFail($id);
      // $customCompanyArray = $company->load('address', 'addressLists.addresses')->toArray();

      //   $postcards = $company->postcards();

      //   if($postcards->count()):
      //     $postcards = $postcards->get();
      //     $customPostcardsArray = [];

      //     foreach ($postcards as $postcard):
      //       $customPostcardsArray[$postcard->id] = $postcard;

      //       $postcard_sender_address = $postcard->senderAddress()->with('address')->get();
      //       $customPostcardsArray[$postcard->id]['sender_address'] = $postcard_sender_address[0]['address'];

      //       $postcard_reciever_addresses = $postcard->recieverAddresses()->get();
      //       $customPostcardRecieverAddressesArray = [];

      //       foreach($postcard_reciever_addresses as $postcard_reciever_address):
      //         $customPostcardsArray[$postcard->id]['reciever_addresses'] = $postcard_reciever_address->address()->get();
      //       endforeach;
      //     endforeach;

      //     $customCompanyArray['postcards'] = $customPostcardsArray;
      //   endif;

      // return $customCompanyArray;
    }

    public function apiCreate(CreateCompanyRequest $request)
    {
        // return response()->json(['request' => $sender_data['address_line_1']]);

        $address = Address::create([
          'address_line_1' => $request->get('address_line_1'),
          'address_line_2' => $request->get('address_line_2'),
          'city' => $request->get('city'),
          'country' => $request->get('country'),
          'zip_code' => $request->get('zip_code'),
          'company' => $request->get('company'),
          'title' => $request->get('title'),
          'name' => $request->get('name'),
          'surnames' => $request->get('surnames'),
          'birthday' => $request->get('birthday')
        ]);

        $company = User::create([
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'api_token' => bcrypt($request->get('email')),
            'role_id' => 4,
            'address_id' => $address->id,
            'active' => false,
        ]);

        return response()->json([
          'company' => $company,
          'message' => $company->address->company.' company was created correctly!'
        ]);
    }

    public function apiCreateFromEditor(CreateUpdateCompanyFromEditorRequest $request)
    {

        $sender_data = $request->get('sender_data');
        // return response()->json(['request' => $sender_data]);

        $address = Address::create([
          'address_line_1' => $sender_data['address_line_1'],
          'address_line_2' => $sender_data['address_line_2'],
          'city' => $sender_data['city'],
          'country' => $sender_data['country'],
          'zip_code' => $sender_data['zip_code'],
          'company' => $sender_data['company'],
          'title' => $sender_data['title'],
          'name' => $sender_data['name'],
          'surnames' => $sender_data['surnames'],
          'birthday' => $sender_data['birthday']
        ]);

        $company = User::create([
            'email' => $sender_data['email'],
            'password' => bcrypt($sender_data['password']),
            'api_token' => bcrypt($sender_data['email']),
            'role_id' => 4,
            'address_id' => $address->id,
            'active' => false,
        ]);

        return response()->json([
          'company' => $company,
          'message' => $company->address->company.' company was created correctly!'
        ]);
    }

    public function apiUpdate(Request $request, $id)
    {
        $company = User::where('role_id', 4)->findOrFail($id);
        $address = $company->address()->first();

        $address->update([
          'address_line_1' => $request->get('address_line_1'),
          'address_line_2' => $request->get('address_line_2'),
          'city' => $request->get('city'),
          'country' => $request->get('country'),
          'zip_code' => $request->get('zip_code'),
          'company' => $request->get('company'),
          'title' => $request->get('title'),
          'name' => $request->get('name'),
          'surnames' => $request->get('surnames'),
          'birthday' => $request->get('birthday')
        ]);

        $address->save();

        return response()->json([
          'company' => $company,
          'message' => $company->address->company.' company was updated correctly!'
        ]);
    }

    public function apiUpdateFromEditor(CreateUpdateCompanyFromEditorRequest $request, $id)
    {

        $company = User::where('role_id', 4)->findOrFail($id);
        $address = $company->address()->first();

        $sender_data = $request->get('sender_data');

        $address->update([
          'address_line_1' => $sender_data['address_line_1'],
          'address_line_2' => $sender_data['address_line_2'],
          'city' => $sender_data['city'],
          'country' => $sender_data['country'],
          'zip_code' => $sender_data['zip_code'],
          'company' => $sender_data['company'],
          'title' => $sender_data['title'],
          'name' => $sender_data['name'],
          'surnames' => $sender_data['surnames'],
          'birthday' => $sender_data['birthday']
        ]);

        $address->save();

        return response()->json([
          'company' => $company,
          'message' => $company->address->company.' company was updated correctly!'
        ]);
    }

    public function apiDelete($id)
    {
        $company = User::where('role_id', 4)->with('address')->findOrFail($id);
        $company->delete();
        return response()->json([
          'company' => $company,
          'message' => $company->address->company.' company was deleted correctly!'
        ]);
    }

    public function postcards($id)
    {
      $company = User::where('role_id', 4)->with('address', 'postcards', 'postcards.senderAddress.address', 'postcards.recieverAddresses.address')->findOrFail($id);
      return view('pages.companies.postcards', compact('company'));
    }
}
