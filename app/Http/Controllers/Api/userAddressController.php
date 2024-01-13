<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\UserAddress;


use Illuminate\Support\Facades\Auth;
use DB;


class userAddressController extends BaseController
{

    public function index()
    {
        $user = UserAddress::all();

        // $user=UserAddress::where('user_id',$id)->get();
        // $user=DB::select('select * from user_addresses where user_id = ?',[$id]);


        return $this->sendResponse($user, 'userAddress have been restored successfully!' );

    }
       /**************************************************************************************/

       public function getUserAddress(Request $request)
       {
            $user=UserAddress::where('user_id',$request->id)->get();


           return $this->sendResponse($user, 'userAddress have been restored successfully!' );

       }
   

    /**************************************************************************************/

    public function create()
    {
        //
    }

     /**************************************************************************************/

    public function store(Request $request)
    {
        $userAddress = new UserAddress();
        $userAddress->user_id =$request->user_id;
        $userAddress->address =$request->address;
        $userAddress->city =$request->city;
        $userAddress->state =$request->state;
        $userAddress->country =$request->country;
        $userAddress->postal_code =$request->postal_code;
        $userAddress->phone =$request->phone;
        $userAddress->email =$request->email;
        $userAddress->name =$request->name;


    
        $userAddress->save();
     

        return $this->sendResponse($userAddress, 'userAddress Added Successfully!' );
    }

      /**************************************************************************************/

    public function show($id)
    {
        //
    }
      /**************************************************************************************/

    public function edit($id)
    {
        //
    }

     /**************************************************************************************/

    public function update(Request $request, $id)
    {
        $userAddress = UserAddress::findOrFail($id);

        // $userAddress->user_id = Auth::user()->id;
        $userAddress->user_id =$request->user_id;
        $userAddress->address =$request->address;
        $userAddress->city =$request->city;
        $userAddress->state =$request->state;
        $userAddress->country =$request->country;
        $userAddress->postal_code =$request->postal_code;
        $userAddress->phone =$request->phone;
        $userAddress->email =$request->email;
        $userAddress->name =$request->name;


    
        $userAddress->save();
     

        return $this->sendResponse($userAddress, 'userAddress updated Successfully!' );
    }

      /**************************************************************************************/

    public function destroy($id)
    {
        $userAddress = UserAddress::find($id);

        $userAddress->delete();
        return $this->sendResponse($userAddress, 'userAddress deleted Successfully!' );
    }
}
