<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryUserCreateRequest extends FormRequest
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
            'name' => 'required|min:5|max:100',    //TODO: Review
            'email' => 'email:rfc,dns', //TODO: Валідатор пропускає мейл, а ларавел відкидає, мабуть ларавел перевіряє чи існує домен реально.
            'role' => 'required',
        ];
    }
}