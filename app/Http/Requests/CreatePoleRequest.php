<?php

namespace App\Http\Requests;
use Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreatePoleRequest extends FormRequest
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
            
            'kolb' =>'required|integer',
            'kolk' =>'required|integer',
            'kol1' =>'required|integer',
            'kol2' =>'required|integer',
            'kol3' =>'required|integer',
            'kol4' =>'required|integer',
            'kol5' =>'required|integer',
            'n' =>'required|integer',
            'm' =>'required|integer',
        ];
       
    }
}
