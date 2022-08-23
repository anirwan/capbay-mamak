<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use App\Http\Resources\PromotionResource;
use App\Models\Promotion;
use App\Models\MenuItem;
use App\Models\PromotionPrerequisiteItem;
use App\Models\PromotionRewardItem;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PromotionResource::collection(Promotion::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePromotionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromotionRequest $request)
    {
        $prereq_items = $request->prerequisite_items;
        $rew_item = $request->reward_items;

        foreach ($prereq_items as $item) {
            $id = $item['menu_item_id'];
            $menu_item = MenuItem::find($id);
            if(!$menu_item) {
                return response(['error' => true, 'error-msg' => "Prerequisite menu item ($id) not found"], 404);
            }
        }

        foreach ($rew_item as $item) {
            $id = $item['menu_item_id'];
            $menu_item = MenuItem::find($id);
            if(!$menu_item) {
                return response(['error' => true, 'error-msg' => "Reward menu item ($id) not found"], 404);
            }
        }

        $promotion = Promotion::create([
            'name' => $request->name
        ]);

        $promotion->prerequisite_items = collect($prereq_items)->map(function($item) use ($promotion) {
            return PromotionPrerequisiteItem::create([
                'promotion_id' => $promotion->id,
                'menu_item_id' => $item['menu_item_id'],
                'quantity' => $item['quantity']
            ]);
        });

        $promotion->reward_items = collect($rew_item)->map(function($item) use ($promotion) {
            return PromotionRewardItem::create([
                'promotion_id' => $promotion->id,
                'menu_item_id' => $item['menu_item_id'],
                'discount' => $item['discount']
            ]);
        });

        return $promotion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Promotion::find($id);
        $item->delete();
        return $item;
    }
}
