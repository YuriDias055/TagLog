<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void {
        if (!User::where('email', 'diasyuri055@gmail.com')->first()) {
            User::create([
                'name' => 'Yuri',
                'email' => 'diasyuri055@gmail.com',
                'password' => Hash::make('12345678', ['rounds' => 12])
            ]);
        }
    }
}
