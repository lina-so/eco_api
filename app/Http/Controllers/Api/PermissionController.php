<?php


namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\API\BaseController as BaseController;





class PermissionController extends BaseController
{
   
    public function index()
    {
        $Permission = Permission::all();
     
        return $this->sendResponse($Permission, 'Permission have been restored successfully!' );
        
    }

  
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->guard_name = $request->guard_name;


        
        $permission->save();
     

    return $this->sendResponse($permission, 'permission Added Successfully!' );
    }


 
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $permission->name = $request->name;

        
        $permission->update();
     

    return $this->sendResponse($permission, 'permission updated Successfully!' );
    }

    public function destroy($id)
    {
        $Permission = Permission::find($id);

        $Permission->delete();
        return $this->sendResponse($Permission, 'Permission deleted Successfully!' );
    }
}
