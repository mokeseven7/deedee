<?php

namespace App\Http\Requests;

class StoreDeeDeeRequest extends ContentNegotiableRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'surname'           => "required|max:255",
            'character_name'    => "required|max:255",
            'age'               => 'required|integer|between:18,99',
            'character_type'    => "required|max:255",
            'character_level'   => "required|max:255",
        ];
    }
}
