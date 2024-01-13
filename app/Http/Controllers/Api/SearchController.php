<?php


namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;


use App\Models\OrderDetails;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subproducts;
use App\Models\Order;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Session;



use App\Http\Controllers\API\BaseController as BaseController;

class SearchController extends BaseController
{
  
    public function result(Request $request)
    {

        $subproducts = Subproducts::query();
         
        $name = $request->name;
        $price = $request->price;


        $subproducts = Subproducts::with(['colors'])->with(['sizes'])->when($request->name, function ($query, $name) {
            return $query->where('name', 'like', "%{$name}%");
        })->when($request->price, function ($query, $price) {
            return $query->where('price',$price);
        })
        ->get();

    

        return $this->sendResponse($subproducts, 'search retireved Successfully!' );

         
    }
}
