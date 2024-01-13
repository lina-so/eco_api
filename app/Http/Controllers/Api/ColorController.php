<?php

namespace App\Http\Controllers\Api;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;



class ColorController extends BaseController
{
  
    public function index()
    {
        $Color = Color::all();
        return $this->sendResponse($Color, 'Color have been restored successfully!' );
    }

   
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $Color = new Color();
        $Color->color = $request->color;
      
        $Color->save();
     

        return $this->sendResponse($Color, 'Color Added Successfully!' );
    }

 
    public function show(Color $color)
    {
        //
    }

    
    public function edit(Color $color)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        $Color = Color::findOrFail($id);

        $Color->color = $request->color;
      
        $Color->save();
     

        return $this->sendResponse($Color, 'Color updated Successfully!' );
    }

 
    public function destroy( $id)
    {
        $Color = Color::find($id);

        $Color->delete();
        return $this->sendResponse($Color, 'Color deleted Successfully!' );
    }
}
