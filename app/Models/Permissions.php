<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;

    public function roles()
    {
        return $this->belongsToMany('App\Models\Roles', 'role_permission_mappings', 
        'permission_id', 'roles_id');
    }
    public function subMenus()
    {
        return $this->hasMany(self::class, 'parent_menu_id')->with('subMenus');
    }
}
