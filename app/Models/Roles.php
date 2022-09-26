<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permissions;

class Roles extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function permission()
    {
        return $this->belongsToMany(Permissions::class, 'role_permission_mappings', 'role_id', 
        'permission_id');
    }
}
