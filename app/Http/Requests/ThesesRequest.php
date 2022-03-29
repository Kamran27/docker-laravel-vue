<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ThesesRequest extends FormRequest
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
            'title' => 'required|unique:theses|max:255',
            'publisher' => 'required|max:255',
            'proglang' => 'required|max:255',
            'description' => 'required|max:255'
        ];
    }
}
