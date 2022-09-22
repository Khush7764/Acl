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
}
