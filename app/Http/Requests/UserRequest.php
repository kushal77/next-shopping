<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            //
        ];
    }

    public function storeRules()
    {
        return [
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required',
            'password' => 'required|confirmed|min:8',
            'type' => 'required',
        ];
    }

    public function updateRules()
    {
        return [
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required',
            'password' => 'confirmed',
            'type' => 'required',
        ];
    }
}
