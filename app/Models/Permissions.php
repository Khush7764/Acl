<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;
    static $id = [];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Roles', 'role_permission_mappings', 
        'permission_id', 'roles_id');
    }

    public function allPermissions()
    {
        return $this->hasMany(self::class, 'parent_menu_id')->with('subMenus');
    }

    public function userPermissions()
    {
        return $this->hasMany(self::class, 'parent_menu_id')->with(['userPermissions' => function($q){
            $q->whereIn('id', self::$id);
        }]);
    }

    public function userSidebar()
    {
        return $this->hasMany(self::class, 'parent_menu_id')->with(['userSidebar' => function($q){
            $q->whereIn('id', self::$id)->where('menu_type', 'sidebar');
        }]);
    }

    public static function setId(array $permissions)
    {
        self::$id = $permissions;
    }

}
