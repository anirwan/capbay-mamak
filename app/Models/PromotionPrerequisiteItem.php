<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Promotion;
use App\Models\MenuItem;

class PromotionPrerequisiteItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function menu_item()
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }
}
