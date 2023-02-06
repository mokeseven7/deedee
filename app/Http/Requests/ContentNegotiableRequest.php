<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ContentNegotiableRequest extends FormRequest {

    /**
     * 
     * The reason for this work around, has to do with the fact these custom request were meant to be stateful. 
     * If  you look in \Illuminate\Foundation\Http\FormRequest@failedValidation, heres what you see
     *  
     * throw (new ValidationException($validator))
     *              ->errorBag($this->errorBag)
     *               ->redirectTo($this->getRedirectUrl());
     * 
     * There is no way to change this behavior with configuration, but i like type hinting custom request that auto validate
     * So I usually write a small class like this so i can have both
     * 
     * @param Validator $validator
     * @return array
     * @throws HttpResponseException|ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        // I will begrudgingly support this content type, but you should really try to be more stateless
        if($this->header('Accept') === 'text/html'){
            throw (new ValidationException($validator))
                  ->errorBag($this->errorBag)
                   ->redirectTo($this->getRedirectUrl());
        }

    
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], 422, ['Content-Type' => 'application/json'])
        );
    }

    /**
     * We will be handling API auth in a different way
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    abstract public function rules();
}