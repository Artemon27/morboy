<?php

namespace App\Http\Requests;
use App\createPole;
use Illuminate\Foundation\Http\FormRequest;

class VystrelRequest extends FormRequest
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
        
     
       if ($vremenno = createPole::find(2)->a10==1)
       {
         return [
                     
          'id' => 'mimoVDen|podryad|zanyato',
                         
        ];
       }
       else 
       {
        return [
                     
          'id' => 'razVDen|podryad|zanyato|end',
                         
        ];
       }
    }
}
