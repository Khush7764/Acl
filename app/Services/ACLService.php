<?php

namespace App\Services;
use App\Models\Permissions;
use App\Models\RolePermissionMapping;
use App\Models\Roles;
use App\Models\User;

class ACLService 
{
    function checkUserPermissions($id, $requestUri)
    {
        $subuser = User::where('id', $id)->first();
        $roles = json_decode($subuser->roles, true);

        $rolesPerm = RolePermissionMapping::whereIn('role_id', $roles)->pluck('permission_id')->toArray();
        $prm = Permissions::whereIn('id', $rolesPerm)->whereNotNull('uri')->pluck('uri')->toArray();
        
        if(in_array(ltrim($requestUri, '/'), $prm)){
            return true;
        }
        return false;
    }

    function getUserMenu($id)
    {
        $subuser = User::where('id', $id)->first();
        $roles = json_decode($subuser->roles, true);

        $rolesPerm = RolePermissionMapping::whereIn('role_id', $roles)->pluck('permission_id')->toArray();
        Permissions::setId($rolesPerm);
        $prm = Permissions::with(['userPermissions' => function($q) use($rolesPerm){
            $q->whereIn('id', $rolesPerm);
        }])->whereNull('parent_menu_id')->whereIn('id', $rolesPerm)->get()->toArray();
        
        $sidebar = Permissions::with(['userSidebar' => function($q) use($rolesPerm){
            $q->whereIn('id', $rolesPerm)->where('menu_type', 'sidebar');
        }])->whereNull('parent_menu_id')->whereIn('id', $rolesPerm)->get()->toArray();
        return (['permissions' => $prm, 'sidebar' => $sidebar]);
    }
}
