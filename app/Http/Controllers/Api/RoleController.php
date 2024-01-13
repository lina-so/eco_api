<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use App\Http\Controllers\API\BaseController as BaseController;





class RoleController extends BaseController
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */


    // function __construct()
    // {

    //     $this->middleware('Permission:عرض صلاحية', ['only' => ['index']]);
    //     $this->middleware('Permission:اضافة صلاحية', ['only' => ['create','store']]);
    //     $this->middleware('Permission:تعديل صلاحية', ['only' => ['edit','update']]);
    //     $this->middleware('Permission:حذف صلاحية', ['only' => ['destroy']]);

    // }




    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->get();
        return $this->sendResponse($roles, 'roles have been restored successfully!' );

    }

    public function create()
    {
        $permission = Permission::get();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required|unique:roles,name',
        'permission' => 'required',
        'guard_name'=>'required',
        ]);
        // $role = Role::create(['name' => $request->input('name')]);
        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = $request->guard_name;

      
        $role->save();
     
        $role->syncPermissions($request->input('permission'));

        return response()->json($role, 201);


       
    }
  
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$id)
        ->get();
        return response()->json($role, 201);


    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();
        return view('roles.edit',compact('role','permission','rolePermissions'));
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'name' => 'required',
        'permission' => 'required',
        ]);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return response()->json($role, 201);

    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $role = Role::find($id);

        $role->delete();
 
        return response()->json($role, 201);

    }
}