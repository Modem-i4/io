<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryInvoiceCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data.date' => 'required|date',
            'data.number' => 'required|string',
            'data.provider_id' => 'required|integer|exists:inventory_providers,id',
            'items' => 'array',
            'items.*.inventory_number' => 'required|distinct|unique:inventory_items,inventory_number',
            'items.*.type_id' => 'required|exists:inventory_types,id',
            'items.*.owner_id' => 'required|exists:users,id',
            'items.*.department_id' => 'required|exists:inventory_departments,id',
            'items.*.model_id' => 'required|exists:inventory_models,id',
            'items.*.price' => 'required',
            'items.*.count' => 'required|integer',
        ];
    }
}
