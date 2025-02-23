<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@ddradovic.rs',
            'password' => Hash::make('admin123'),
        ]);
    }
}
