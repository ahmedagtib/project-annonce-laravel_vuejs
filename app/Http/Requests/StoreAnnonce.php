<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

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
        // Validator::extend('is_annonce_image',function($attribute, $value, $params, $validator) {

        //     foreach ($value as $key => $img) {
        //             # code..
        //         if(!isset($img['id'])) {
        //             $image = base64_decode($img['img']);
        //             $f = finfo_open();
        //             $result = finfo_buffer($f, $image, FILEINFO_MIME_TYPE);
        //             return $result == 'mimes:jpeg,jpg,png';

        //         }
        //     }

        // });
        $rules = [
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
            'prix' => 'required|numeric',
            'images.*.img' => 'base64image|base64mimes:jpeg,jpg,png,PNG'
        ];
        // $nbr = count($this->input('images')) - 1;
        // foreach(range(0, $nbr) as $index) {
        //     $rules['images.' . $index] = 'image|max:4000';
        // }

        return $rules;
    }
}
