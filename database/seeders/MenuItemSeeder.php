<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuItem::create([
            'code' => 'B001',
            'type' => 'DRINK',
            'name' => 'Kopi',
            'price' => 2.50
        ]);

        MenuItem::create([
            'code' => 'B002',
            'type' => 'DRINK',
            'name' => 'Teh Tarik',
            'price' => 2.00
        ]);

        MenuItem::create([
            'code' => 'F001',
            'type' => 'FOOD',
            'name' => 'Roti Kosong',
            'price' => 1.50
        ]);
    }
}
