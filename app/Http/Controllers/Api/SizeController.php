<?php

namespace App\Http\Controllers\Api;


use App\Models\Size;
use Illuminate\Http\Request;

use App\Http\Controllers\API\BaseController as BaseController;




class SizeController extends BaseController
{
    public function index()
    {
        $size = Size::all();
        return $this->sendResponse($size, 'size have been restored successfully!' );
    }

   
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $size = new Size();
        $size->size = $request->size;
      
        $size->save();
     

        return $this->sendResponse($size, 'size Added Successfully!' );
    }

 
    public function show(Size $Size)
    {
        //
    }

    
    public function edit(Size $Size)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        $size = Size::findOrFail($id);

        $size->size = $request->size;
      
        $size->save();
     

        return $this->sendResponse($size, 'size updated Successfully!' );
    }

 
    public function destroy( $id)
    {
        $size = Size::find($id);

        $size->delete();
        return $this->sendResponse($size, 'size deleted Successfully!' );
    }
}
