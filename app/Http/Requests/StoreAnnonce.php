<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAnnonce extends FormRequest
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
            'user_id' => 'numeric',
            'ville_id' => 'numeric',
            'categorie_id' => 'numeric',
            'title' => 'required|string',
            'description' => 'string|nullable',
            'detaille' => 'string|nullable',
            'type' => [
                'required',
                Rule::in(['free', 'pay']),
            ],
            'stuts' => [
                'required',
                Rule::in(['published','pandding','blocked'])
            ],
            'prix' => 'required|numeric'
        ];
    }
}
