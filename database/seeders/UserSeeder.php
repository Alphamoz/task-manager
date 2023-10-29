<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(["name"=>"admin", 'email'=>'admin@admin.com', 'password'=> bcrypt('12345'), 'is_admin'=>1]);
        User::factory(10)->create();
    }
}
