<?php

namespace App\Http\Controllers\Api;

use App\Models\Favoraite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\API\BaseController as BaseController;



class FavoraiteController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
         $like= Favoraite::all();
        return $this->sendResponse($like, 'like have been restored successfully!' );

    }

 
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user_id=Auth::id();
        $subproduct_id=$request->subproducts_id;
        $like= new Favoraite();
        $like->user_id=$user_id;
        $like->subproducts_id=$subproduct_id;
        $like->save();

        return $this->sendResponse($like, 'Add To My Favoraite Successfully' );
    }



    public function show()
    {
        $like= DB::table('favoraites')->where('user_id',Auth::id())->get();
        return $this->sendResponse($like, 'your like have been restored successfully!' );


        
    }


    
    public function edit(Favoraite $favoraite)
    {
        //
    }

   
    public function update(Request $request, Favoraite $favoraite)
    {
        //
    }

    public function destroy($subproducts_id)
    {
        // dd($id);
        // $like = Favoraite::find($id);
        $like =Favoraite::where('user_id',Auth::id())->where('subproducts_id',$subproducts_id)->delete();

        // $like->delete();
 
        return $this->sendResponse($like, 'subproduct deleted from favoraite Successfully!' );

    }

}
