<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePricingRuleRequest;
use App\Http\Requests\UpdatePricingRuleRequest;
use App\Http\Resources\PricingRuleResource;
use App\Models\PricingRule;

class PricingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PricingRuleResource::collection(PricingRule::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePricingRuleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePricingRuleRequest $request)
    {
        $free_amount = null;
        $discount = null;

        switch ($request->type) {
            case ('GIVEAWAY'):
                if(!$request->free_amount) {
                    return response(['error' => true, 'error-msg' => "GIVEAWAY pricing rule must always have free_amount"], 400);
                }
                $free_amount = $request->free_amount;
                break;
            case ('DISCOUNT'):
                if(!$request->discount) {
                    return response(['error' => true, 'error-msg' => "DISCOUNT pricing rule must always have discount"], 400);
                }
                $discount = $request->discount;
                break;
        };

        $pricing_rule = PricingRule::create([
            'name' => $request->name,
            'menu_item_code' => $request->menu_item_code,
            'type' => $request->type,
            'min_amount' => $request->min_amount,
            'free_amount' => $free_amount,
            'discount' => $discount
        ]);

        return $pricing_rule;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PricingRule  $pricingRule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = PricingRule::find($id);
        $item->delete();
        return $item;
    }
}
