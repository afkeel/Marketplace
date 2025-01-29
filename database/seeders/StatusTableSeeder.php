<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'id' => 1,
            'name' => 'new',
        ]);
 
        Status::create([
            'id' => 2,
            'name' => 'pending',
        ]);

        Status::create([
            'id' => 3,
            'name' => 'completed',
        ]);

        Status::create([
            'id' => 4,
            'name' => 'cancelled',
        ]);
    }
}
