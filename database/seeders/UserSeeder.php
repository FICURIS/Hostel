<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $guestRole = Role::where('name', 'guest')->first();

        User::create([
                'login' => 'admin',
                'name'     => 'Администратор',
                'email'    => 'admin@example.com',
                'phone'    => '8(900)000-00-00',
                'password' => 'password123',
                'role_id'  => $adminRole->id,
        ]);
    }
}
