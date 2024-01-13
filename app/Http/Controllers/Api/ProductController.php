<?php
namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\API\BaseController as BaseController;





class ProductController extends BaseController
{
/*******************************************************************************************/
 
    public function index()
    {
        $products = Product::all();
     
        return $this->sendResponse($products, 'products have been restored successfully!' );
        
    }

/*******************************************************************************************/

    public function get_category_with_products()
    {
        $products = Category::with(['product'])->get();

        // dd($products);
        return $this->sendResponse($products, 'products have been restored successfully!' );
        
    }

/*******************************************************************************************/



    public function create()
    {
        //
    }
/*******************************************************************************************/

    public function store(Request $request)
    {
        $Product = new Product();
        $Product->name = $request->name;
        $Product->category_id = $request->category_id;

        
        $Product->save();
     

    return $this->sendResponse($Product, 'Product Added Successfully!' );
    }
/*******************************************************************************************/

    public function show($id)
    {
        //
    }
/*******************************************************************************************/

    public function edit($id)
    {
        //
    }
/*******************************************************************************************/

    public function update(Request $request, $id)
    {
        $Product = Product::findOrFail($id);

        $Product->name = $request->name;
        $Product->category_id = $request->category_id;
        $Product->update();
     
         return $this->sendResponse($Product, 'Product Updated Successfully!' );
    }

/*******************************************************************************************/
    public function destroy($id)
    {
        $Product = Product::find($id);

        $Product->delete();
        return $this->sendResponse($Product, 'Product deleted Successfully!' );
    }
}
