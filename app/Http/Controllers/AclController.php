<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permissions;
use App\Models\RolePermissionMapping;
use App\Models\Roles;
use App\Models\User;

class AclController extends Controller
{
    function getAllPermissions()
    {  
        $prm = Permissions::with('subMenus')->whereNull('parent_menu_id')->get()->toArray();
        return response()->json($prm);
    }

    function getUserPermissions($id)
    {
        $subuser = User::where('id', $id)->first();
        $roles = json_decode($subuser->roles, true);

        $rolesPerm = Roles::whereIn('id', $roles)->with('permission')->get()->toArray();
        return response()->json($rolesPerm);
    }
}
