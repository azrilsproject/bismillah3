<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            [
                'nama_user' => 'Admin Logistik',
                'username' => 'administrator',
                'password' => Hash::make('123'),
                'role' => 'Admin Logistik',
                'created_at'=> now(),
                'updated_at'=> now()
            ], 
            [
                'nama_user' => 'Staff Logistik',
                'username' => 'staff',
                'password' => Hash::make('123'),
                'role' => 'Staff Logistik',
                'created_at'=> now(),
                'updated_at'=> now()
            ], 
            [
                'nama_user' => 'Manajer Logistik',
                'username' => 'manajaer',
                'password' => Hash::make('123'),
                'role' => 'Manajer Logistik',
                'created_at'=> now(),
                'updated_at'=> now()
            ]
        ]);
    }
}
