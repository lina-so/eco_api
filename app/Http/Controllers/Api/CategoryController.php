<?php
namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\Category;

use App\Http\Controllers\API\BaseController as BaseController;


class CategoryController extends BaseController
{
    
    public function index()
    {
        $category=Category::all();
        return $this->sendResponse($category, 'category have been restored successfully!' );

    }

  /**************************************************************************************/
    public function create()
    {
        //
    }

  /**************************************************************************************/

    public function store(Request $request)
    {
            $Category = new Category();
            $Category->name = $request->name;
        
    
                // insert img
                if ($request->hasFile('photo')) {

                    $image = $request->file('photo');
                    $file_name = $image->getClientOriginalName();
        
                    $Category->photo = $file_name;
        
                    // move pic
                    $imageName = $request->photo->getClientOriginalName();
                    $request->photo->move(public_path('Attachments/' . $file_name), $file_name);
                }
            $Category->save();
         

            // return response()->json($Category);
        return $this->sendResponse($Category, 'Category Added Successfully!' );

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
        $Category = Category::findOrFail($id);
        $Category->name = $request->name;
    

            // insert img
            if ($request->hasFile('photo')) {

                $image = $request->file('photo');
                $file_name = $image->getClientOriginalName();
    
                $Category->photo = $file_name;
    
                // move pic
                $imageName = $request->photo->getClientOriginalName();
                $request->photo->move(public_path('Attachments/' . $file_name), $file_name);
            }
        $Category->save();
     

    return $this->sendResponse($Category, 'Category Updated Successfully!' );
    }

  /**************************************************************************************/

    public function destroy($id)
    {
        $Category = Category::find($id);

        $Category->delete();
        return $this->sendResponse($Category, 'Category deleted Successfully!' );
    }
}
