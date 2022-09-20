<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permissions;

class AclController extends Controller
{
    function getAllPermissions()
    {  
        $prm = Permissions::with('subMenus')->whereNull('parent_menu_id')->get()->toArray();
        return response()->json($prm);
    }
}
