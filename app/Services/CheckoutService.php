<?php

namespace App\Services;

use App\Models\MenuItem;

class CheckoutService {

    private $pricing_rules;
    private $items = [];
    private $total = 0.00;

    public function __construct($pricing_rules) {
        $this->pricing_rules = $pricing_rules->groupBy('menu_item_code');
    }

    public function scan($code) {
        $menu_item = MenuItem::firstWhere('code', $code);
        array_push($this->items, $menu_item);
    }

    public function calculate() {
        $grouped_menu_items = collect($this->items)->groupBy('code');
        foreach ($grouped_menu_items as $grouped_items) {
            $item = $grouped_items->first();
            $quantity = count($grouped_items);
            $code = $item->code;
            $price = $item->price;
            $total = $price * $quantity;

            $rule = $this->pricing_rules[$code]->first();
            if($rule) {
                if ($rule->free_amount) {
                    $total_rule_quantity = $rule->min_amount + $rule->free_amount;
                    $occurences = $quantity / $total_rule_quantity;
                    if ($occurences >= 1) {
                        $total -= $price * $rule->free_amount * $occurences;
                    }
                } else if ($rule->discount) {
                    if ($quantity >= $rule->min_amount) {
                        $total -= $total * ($rule->discount / 100);
                    }
                }
            }

            $this->total += $total;
        }
    }

    public function get_total() {
        return $this->total;
    }
}