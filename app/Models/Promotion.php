<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PromotionPrerequisiteItem;
use App\Models\PromotionRewardItem;

class Promotion extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function prerequisite_items()
    {
        return $this->hasMany(PromotionPrerequisiteItem::class);
    }

    public function reward_items()
    {
        return $this->hasMany(PromotionRewardItem::class);
    }
}