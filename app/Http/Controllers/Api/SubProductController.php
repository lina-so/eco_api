<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subproducts;



class SubProductController extends BaseController
{

    public function index()
    {
        $Subproducts = Subproducts::all();
        return $this->sendResponse($Subproducts, 'Subproducts have been restored successfully!' );
    }


/*******************************************************************************************/

public function get_product_with_subproducts()
{
    $subproducts = Product::with(['Subproducts'])->get();

    // dd($subproducts);
    return $this->sendResponse($subproducts, 'subproducts have been restored successfully!' );

}


/*******************************************************************************************/

public function get_subproducts_with_info()
{
    $subproducts = Subproducts::with(['colors'])->with(['sizes'])->get();

    // dd($subproducts);
    return $this->sendResponse($subproducts, 'subproducts have been restored successfully!' );

}
/************************************************************************************************************************/

    public function create()
    {
        //
    }

/************************************************************************************************************************/

    public function store(Request $request)
    {
        $Product = new Subproducts();
        $Product->category_id = $request->category_id;
        $Product->product_id = $request->product_id;
        $Product->description = $request->description;
        $Product->name = $request->name;
        $Product->price = $request->price;
        $Product->discount_price = $request->discount_price;
        $Product->quantity = $request->quantity;


          // insert img
          if($request->hasfile('image'))
          {
              $files =$request->file("image");
              foreach($files as $file)
              {
                  $name = $file->getClientOriginalName();
                  $Product->image=$name;
                  $file->move('images/'.$request->name,$name);

                //   $request->image->move(public_path('Attachments/' .  $request->name), $name);

              }
          }



        $Product->save();

        $Product->colors()->attach($request->color_id);
        $Product->sizes()->attach($request->size_id);


        return $this->sendResponse($Product, 'Product Added Successfully!' );
    }

/************************************************************************************************************************/
    public function show($id)
    {
        //
    }
/************************************************************************************************************************/

    public function edit($id)
    {
        //
    }
/************************************************************************************************************************/


    public function update(Request $request, $id)
    {

        $Product = Subproducts::findOrFail($id);
        $Product->category_id = $request->category_id;
        $Product->product_id = $request->product_id;
        $Product->description = $request->description;
        $Product->name = $request->name;
        $Product->price = $request->price;
        $Product->discount_price = $request->discount_price;
        $Product->quantity = $request->quantity;


          // insert img
          if($request->hasfile('image'))
          {
              $files =$request->file("image");
              foreach($files as $file)
              {
                  $name = $file->getClientOriginalName();
                  $Product->image=$name;
                  $file->move('images/'.$request->name,$name);

                //   $request->image->move(public_path('Attachments/' .  $request->name), $name);

              }
          }



        $Product->update();


        return $this->sendResponse($Product, 'Product updated Successfully!' );
    }

/************************************************************************************************************************/

    public function destroy($id)
    {
        $Subproducts = Subproducts::find($id);

        $Subproducts->delete();
        return $this->sendResponse($Subproducts, 'Subproducts deleted Successfully!' );
    }
}
