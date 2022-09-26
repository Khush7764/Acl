<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permissions;
use App\Models\RolePermissionMapping;
use App\Models\Roles;
use App\Models\User;
use Exception;

class AclController extends Controller
{
    function getAllPermissions()
    {  
        $prm = Permissions::with('allPermissions')->whereNull('parent_menu_id')->get()->toArray();
        return response()->json($prm);
    }

    function getUserPermissions($id)
    {
        $subuser = User::where('id', $id)->first();
        $roles = json_decode($subuser->roles, true);

        $rolesPerm = RolePermissionMapping::whereIn('role_id', $roles)->pluck('permission_id')->toArray();
        Permissions::setId($rolesPerm);
        $prm = Permissions::with(['userPermissions' => function($q) use($rolesPerm){
            $q->whereIn('id', $rolesPerm);
        }])->whereNull('parent_menu_id')->get()->toArray();
        
        $sidebar = Permissions::with(['userSidebar' => function($q) use($rolesPerm){
            $q->whereIn('id', $rolesPerm)->where('menu_type', 'sidebar');
        }])->whereNull('parent_menu_id')->get()->toArray();

        return response()->json(['permissions' => $prm, 'sidebar' => $sidebar]);
    }

    function getAllRoles($msg = null)
    {  
        // $roles = Roles::with('permission')->get()->toArray();
        $roles = Roles::all();
        // dd($roles);
        return view('role.list', ['roles' => $roles])->with($msg);
    }

    function viewUserRole($id=null)
    {  
        $prm = Permissions::with('allPermissions')->whereNull('parent_menu_id')->get();
        $passParam = ['permissions' => $prm];
        if(!empty($id)) {
            $userPerm = RolePermissionMapping::where('role_id', $id)->pluck('permission_id')->toArray();
            $passParam = ['permissions' => $prm, 'role_id' => $id, 'userPer' => $userPerm];
        }
        return view('role.edit', $passParam);
    }

    function createOrUpdateRole(Request $request)
    {
        if(!$request->permission_id) {
            return $this->getAllRoles(["class" => "danger", "msg" => "Permission required!!"]);
        }
        if($request->has('role_id')) {

            $roleId = $request->role_id;
            $permissionIdArray = $request->permission_id;
            $old_permissions = json_decode($request->old_permissions, true);
            $insertArray = array_diff($permissionIdArray,$old_permissions);
            $deleteArray = array_diff($old_permissions, $permissionIdArray);
            // dd($permissionIdArray,$old_permissions,$insertArray, $deleteArray);
            \DB::beginTransaction();
            try{
                foreach ($insertArray as  $value) {
                    $inputArray = [
                        'role_id' => $roleId,
                        'permission_id' => $value
                    ];
                    RolePermissionMapping::create($inputArray);
                }
                foreach ($deleteArray as $value) {
                    $deleteArray = [
                        'role_id' => $roleId,
                        'permission_id' => $value
                    ];
                    RolePermissionMapping::where($deleteArray)->delete();
                }
                $msg = "Record Update Successfully!";
                \DB::commit();
            }catch(Exception $e){
                \DB::rollBack();
                throw new Exception($e->getMessage());
            }        
        }else {
            $roleId = Roles::create(['name' => $request->role_name]);
            $permissionIdArray = $request->permission_id;
            \DB::beginTransaction();
            try{
                foreach ($permissionIdArray as $value) {
                    $inputArray = [
                        'role_id' => $roleId->id,
                        'permission_id' => $value
                    ];
                    RolePermissionMapping::create($inputArray);
                }
                $msg = "Record Added Successfully!";
                \DB::commit();
            }catch(Exception $e){
                \DB::rollBack();
                throw new Exception($e->getMessage());
            }        
        }
        return $this->getAllRoles(["class" => "success", "msg" => $msg]);
    }
}
    