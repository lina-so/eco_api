<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use App\Http\Controllers\API\BaseController as BaseController;





class UserController extends BaseController
{
    /****************************************************************************/
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->get();
        return $this->sendResponse($data, 'users have been restored successfully!' );

    }
    /****************************************************************************/


    
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return response()->json($roles, 201);


    }
    /****************************************************************************/

  
    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:confirm-password',
        'roles_name' => 'required'
        ]);

        $input = $request->all();


        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles_name'));

        return response()->json($input, 201);

  
    }
    /****************************************************************************/

    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user, 201);
        
    }
      /****************************************************************************/

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return response()->json($user, 201);
        
    }
      /****************************************************************************/

    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'same:confirm-password',
        'roles' => 'required',
        'roles_name' => 'required'
        ]);
        $input = $request->all();
        if(!empty($input['password'])){
        $input['password'] = Hash::make($input['password']);
        }else{
        $input = array_except($input,array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        return response()->json($user, 201);
        
    }
    /****************************************************************************/

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();
 
        return $this->sendResponse($user, 'user deleted Successfully!' );

    }
}