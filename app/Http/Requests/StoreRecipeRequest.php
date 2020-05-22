<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'instructions' => 'required',
            'abv' => 'required|numeric',
            'ibu' => 'required|numeric',
            'og' => 'required|numeric',
            'fg' => 'required|numeric',
            'srm' => 'required|numeric',

            'hops.*.hop_id' => 'required',
            'hops.*.unit_id' => 'required',
            'hops.*.hop_type_id' => 'required',
            'hops.*.hop_method_id' => 'required',
            'hops.*.amount' => 'required',
            'hops.*.minute' => 'required',
        ];
    }
}
