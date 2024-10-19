<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */ 
    public function run(): void
    {
       
        Permission::create(['name' => 'Admin']);
        Permission::create(['name' => 'User']);

        
        $adminRole = Role::firstOrCreate(['name'=>'Admin']);
       

        
        $admin= User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'roll_no' => '0',
            'department' => 'all',
            'password' => Hash::make('12345678'), 
        ]);

        $userRole = Role::firstOrCreate(['name'=>'User']);
       

        
        $User = User::create([
            'name' => 'User1',
            'email' => 'User1@gmail.com',
            'roll_no' => '1', 
            'department' => 'ece',
            'password' => Hash::make('12345678'), 
        ]);


       
        $User->assignRole($userRole);
        $admin->assignRole($adminRole);
       
    }
}
