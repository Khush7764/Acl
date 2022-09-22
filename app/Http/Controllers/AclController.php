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

    function getAllRoles()
    {  
        $prm = Roles::with('permission')->get()->toArray();
        return response()->json($prm);
    }
}
