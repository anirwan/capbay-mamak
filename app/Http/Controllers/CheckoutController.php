<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Checkout;
use App\Models\PricingRule;
use App\Services\CheckoutService;

class CheckoutController extends Controller
{
    public function checkout(CheckoutRequest $request)
    {
        $pricing_rules = PricingRule::all();
        $checkout = new CheckoutService($pricing_rules);
        
        foreach ($request->items as $item) {
            $checkout->scan($item);
        }

        $checkout->calculate();
        $total = $checkout->get_total();
        return number_format( (float) $total, 2, '.', '');
    }

    public function test_checkout() {
        $pricing_rules = PricingRule::all();
        $result = "Test Data\n";
        
        // Test 1
        $result .= "List: B001,F001,B002,B001,F001\n";
        $checkout = new CheckoutService($pricing_rules);
        $items = ['B001', 'F001', 'B002', 'B001', 'F001'];
        foreach ($items as $item) {
            $checkout->scan($item);
        }
        $checkout->calculate();
        $total = $checkout->get_total();
        $result .= "Total price expected: RM$total\n\n";


        // Test 2
        $result .= "List: B002,B002,F001\n";
        $checkout = new CheckoutService($pricing_rules);
        $items = ['B002', 'B002', 'F001'];
        foreach ($items as $item) {
            $checkout->scan($item);
        }
        $checkout->calculate();
        $total = $checkout->get_total();
        $result .= "Total price expected: RM$total\n\n";

        // Test 3
        $result .= "List: B001,B001,B002\n";
        $checkout = new CheckoutService($pricing_rules);
        $items = ['B001', 'B001', 'B002'];
        foreach ($items as $item) {
            $checkout->scan($item);
        }
        $checkout->calculate();
        $total = $checkout->get_total();
        $result .= "Total price expected: RM$total\n\n";

        return $result;
    }
}
