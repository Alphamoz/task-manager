<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $status = ['draft', 'published', 'validate', 'done'];
        for ($i = 0; $i < 4; $i++) {
            Status::create(['title' => $status[$i]]);
        }
    }
}
