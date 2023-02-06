<?php

namespace App\Http\Requests;

class DeleteDeeDeeRequest extends ContentNegotiableRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id'    => "required|exists:dee_dees",
        ];
    }
}
