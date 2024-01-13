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

use App\Http\Controllers\API\BaseController as BaseController;



class OrderController extends BaseController
{
    public function index()
    {
        $Order= Order::all();
        return $this->sendResponse($Order, 'Order have been restored successfully!' );
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $AddressUser= UserAddress::where('user_id',Auth::id())->first();
        $subproduct_id = $request->subproducts_id;

        $subproduct= Subproducts::where('id',$subproduct_id)->first();

        $price =$subproduct->price;
        $discount = $subproduct->discount_price;


        $order = new Order();
        $order->user_id = Auth::id();
        $order->subproducts_id=$request->subproducts_id;
        $order->status=0;
        $order->shipping_price=$price;
        $order->total_price=$price*$request->quantity;
        $order->address=$AddressUser->address;
        $order->phone=$AddressUser->phone;
        $order->email=$AddressUser->email;
        $order->name=$AddressUser->name;
        $order->surname=$AddressUser->name;
        $order->city=$AddressUser->city;
        $order->country=$AddressUser->country;
        $order->postal_code=$AddressUser->postal_code;

        $order->save();

        $orderdetails=new OrderDetails();

        
        $orderdetails->order_id=$order->id;
        $orderdetails->quantity=$request->quantity;
        $orderdetails->price=$price;
        $orderdetails->discount=$discount;
   

        $orderdetails->save();

        return $this->sendResponse($order, 'order Added Successfully' );
    }

  
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {

        $id =$request->id;
        $AddressUser= UserAddress::where('user_id',Auth::id())->first();
        $subproduct_id = $request->subproducts_id;

        $subproduct= Subproducts::where('id',$subproduct_id)->first();

        $price =$subproduct->price;
        $discount = $subproduct->discount_price;


        $order=Order::findOrFail($id);

        $order->user_id = Auth::id();
        $order->subproducts_id=$request->subproducts_id;
        $order->status=0;
        $order->shipping_price=$price;
        $order->total_price=$price*$request->quantity;
        $order->address=$AddressUser->address;
        $order->phone=$AddressUser->phone;
        $order->email=$AddressUser->email;
        $order->name=$AddressUser->name;
        $order->surname=$AddressUser->name;
        $order->city=$AddressUser->city;
        $order->country=$AddressUser->country;
        $order->postal_code=$AddressUser->postal_code;

        $order->save();
        $order_id= $id;

        $orderdetails=OrderDetails::where('order_id',$order_id)->first();

        
        $orderdetails->order_id=$id;
        $orderdetails->quantity=$request->quantity;
        $orderdetails->price=$price;
        $orderdetails->discount=$discount;
   

        $orderdetails->save();

        return $this->sendResponse($orderdetails, 'order updated Successfully' );
    }

    public function get_orders_for_user(Request $request)
    {
        $id = $request->user_id;
        $userOrders= DB::table('orders as order')
        ->join('order_details', 'order_details.order_id', '=', 'order.id')
        ->join('users as user', 'order.user_id', '=', 'user.id')
        ->where('order.user_id',$id)
        ->select('order.*', 'user.*','order_details.*')
        ->get();
        return $this->sendResponse($userOrders, 'details retireved Successfully!' );
    }


    public function destroy($id)
    {
        $order = Order::find($id);

        $order->delete();
        return $this->sendResponse($order, 'order deleted Successfully!' );
    }
}
