<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\PricingRule;

class PricingRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PricingRule::create([
            'name' => 'Buy 1 Free 1',
            'menu_item_code' => 'B001',
            'type' => 'GIVEAWAY',
            'min_amount' => 1,  
            'free_amount' => 1 
        ]);

        PricingRule::create([
            'name' => 'Buy 1 Free 1',
            'menu_item_code' => 'B002',
            'type' => 'GIVEAWAY',
            'min_amount' => 1,  
            'free_amount' => 1 
        ]);

        PricingRule::create([
            'name' => 'Discount',
            'menu_item_code' => 'F001',
            'type' => 'DISCOUNT',
            'min_amount' => 2,
            'discount' => 20
        ]);

    }
}
