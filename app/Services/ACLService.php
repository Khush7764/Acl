<?php

namespace App\Services;
use App\Models\Permissions;
use App\Models\RolePermissionMapping;
use App\Models\Roles;
use App\Models\User;

class ACLService 
{
    public function checkUserPermissions($userid)
    {
        $userperms = $this->getRoleBasedPermissions($userid);
        if (!empty($userperms['roles']) && !empty($userperms['permissions'])) {
            return true;
        }
        return false;
    }

    public function getRoleBasedPermissions($userid)
    {
        $roles = [];
        $rolesPerm = [];
        $subuser = User::where('id', $userid)->first();
        if (!empty($subuser)) {
            $roles = json_decode($subuser->roles, true);
        }
        //User assigned role based permissions
        $rolesPerm = RolePermissionMapping::whereIn('role_id', $roles)->pluck('permission_id')->toArray();
        if (!empty($rolesPerm)) {
            $rolesPerm = array_unique($rolesPerm);
        }
        return ['roles' => $roles, 'permissions' => $rolesPerm];
    }

    function getUserMenu($id)
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

        return (['permissions' => $prm, 'sidebar' => $sidebar]);
    }
}
