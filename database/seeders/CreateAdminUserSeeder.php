<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

use App\Models\User;

use Hash;
class CreateAdminUserSeeder extends Seeder

{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run()
    {
        $user = User::create([
            'name'       => 'Admin',
            'role_id'    =>  1,            
            'email'      => 'admin@gmail.com',            
            'password'   => Hash::make('Admin@123'),
        ]);
    }
}