<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => "Khushal",
                'email' => "khushal.berva@tradofina.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'roles' => json_encode([1, 2, 3, 4, 5])
            ],
            [
                'name' => "Priyanka",
                'email' => "priyanka.deskhmukh@tradofina.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'roles' => json_encode([2, 4])
            ],
            [
                'name' => "Bhargav",
                'email' => "bhargav.chhaya@tradofina.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'roles' => json_encode([3, 5])
            ],
            [
                'name' => "Pankaj",
                'email' => "pankaj.sawai@tradofina.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'roles' => json_encode([4])
            ],
            [
                'name' => "Shubhangi",
                'email' => "shubhangi.deshmukh@tradofina.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'roles' => json_encode([5])
            ],
        ]);

        DB::table('permissions')->insert([
            [
                "menu_name" => "Purple",
                "operation" => null,
                "uri" => null,
                "parent_menu_id" => null,
                "dependent_menu_id" => null,
                "menu_type" => "sidebar"
            ],
            [
                "menu_name" => "Loan Matrix",
                "operation" => "Listing",
                "uri" => "loanmatrix/list",
                "parent_menu_id" => 1,
                "dependent_menu_id" => null,
                "menu_type" => "sidebar"
            ],
            [
                "menu_name" => "Fresh Grid",
                "operation" => "Listing",
                "uri" => "loanmatrix/list",
                "parent_menu_id" => 2,
                "dependent_menu_id" => null,
                "menu_type" => "tab"
            ],
            [
                "menu_name" => "3Month",
                "operation" => "List",
                "uri" => "loanmatrix/freshgrid/3month",
                "parent_menu_id" => 3,
                "dependent_menu_id" => 3,
                "menu_type" => "tab"
            ],
            [
                "menu_name" => "Edit",
                "operation" => "Edit",
                "uri" => "loanmatrix/freshgrid/3month/edit",
                "parent_menu_id" => 4,
                "dependent_menu_id" => 4,
                "menu_type" => "tab"
            ],
            [
                "menu_name" => "62Days",
                "operation" => "List",
                "uri" => "loanmatrix/freshgrid/62Days",
                "parent_menu_id" => 3,
                "dependent_menu_id" => 3,
                "menu_type" => "tab"
            ],
            [
                "menu_name" => "Edit",
                "operation" => "Edit",
                "uri" => "loanmatrix/freshgrid/62Days/edit",
                "parent_menu_id" => 6,
                "dependent_menu_id" => 6,
                "menu_type" => "tab"
            ],
            [
                "menu_name" => "6Month",
                "operation" => "List",
                "uri" => "loanmatrix/freshgrid/6Month",
                "parent_menu_id" => 3,
                "dependent_menu_id" => 3,
                "menu_type" => "tab"
            ],
            [
                "menu_name" => "Edit",
                "operation" => "Edit",
                "uri" => "loanmatrix/freshgrid/6Month/edit",
                "parent_menu_id" => 8,
                "dependent_menu_id" => 8,
                "menu_type" => "tab"
            ],
            [
                "menu_name" => "SendExcelReport",
                "operation" => null,
                "uri" => "loanmatrix/freshgrid/sendexcelreport",
                "parent_menu_id" => 2,
                "dependent_menu_id" => 2,
                "menu_type" => "singular"
            ],
            [
                "menu_name" => "AddNewTemplate",
                "operation" => null,
                "uri" => "loanmatrix/freshgrid/addnewtemplate",
                "parent_menu_id" => 2,
                "dependent_menu_id" => 2,
                "menu_type" => "singular"            
            ],
            [
                "menu_name" => "Transactions",
                "operation" => "List",
                "uri" => "transactions",
                "parent_menu_id" => null,
                "dependent_menu_id" => null,
                "menu_type" => "sidebar"            
            ],
        ]);

        DB::table('roles')->insert([
            ['name' => "Admin"],
            ['name' => "Call Center"],
            ['name' => "Payment Executive"],
            ['name' => "Collection Support"],
            ['name' => "Business Development"]
        ]);

        $role_permission = [
            1 => [1,2,3,4,5,6,7,8,9,10,11,12],
            2 => [1,2,3,4,6,8],
            3 => [1,2,3,4,5,6,7,12],
            4 => [12],
            5 => [1,2,3,10,11,12],
        ]; 

        $inputArray = [];
        
        foreach($role_permission as $roles => $permissions) {
            foreach($permissions as $perm) {
                $inputArray[] = [
                    'role_id' => $roles,
                    'permission_id' => $perm
                ];
            }
        }

        DB::table('role_permission_mappings')->insert($inputArray);
    }
}