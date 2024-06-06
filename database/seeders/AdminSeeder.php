<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Rawan Admin',
            'email' => 'rawan.abdullah@rhinosoft.io',
            'password' => bcrypt('rawan.abdullah@rhinosoft.io'),
            'isAdmin' => 1,
        ]);
    }
}
