<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePricingRuleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('menu_items')->whereNull('deleted_at'),
                'max:255'
            ],
            'menu_item_code' => [
                'required',
                'exists:menu_items,code'
            ],
            'type' => [
                'required',
                'in:GIVEAWAY,DISCOUNT'
            ],
            'min_amount' => [
                'required',
                'integer',
                'gt:0'
            ],
            'free_amount' => [
                'required_without:discount',
                'integer',
                'gt:0'
            ],
            'discount' => [
                'required_without:free_amount',
                'integer',
                'gt:0',
                'lte:100'
            ]
        ];
    }
}
