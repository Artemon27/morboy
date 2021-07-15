<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class statistika extends Model
{
   protected $guarded = [''];
   
   
   
   public function zapis($last,$num_last) {
        
    $id=Auth::User()->id;
    $statistika = statistika::find($id);   
    if ($statistika==NULL)
    {
        $statistika = new statistika;
        $statistika->id = $id;
        $statistika->podryad1 = 0;
        $statistika->podryad2 = 0;
        $statistika->podryad3 = 0;
        $statistika->podryad4 = 0;
        $statistika->podryad5 = 0;
        $statistika->podryadb = 0;
        $statistika->podryadk = 0;
        $statistika->podryadm = 0;
        $statistika->pop1 = 0;
        $statistika->pop2 = 0;
        $statistika->pop3 = 0;
        $statistika->pop4 = 0;
        $statistika->pop5 = 0;
        $statistika->popb = 0;
        $statistika->popk = 0;
        $statistika->popm = 0;
    }
    $b = 'podryad'.$last;
    if ($statistika->$b < $num_last)
        $statistika->$b = $num_last;
    $c = 'pop'.$last;
    $statistika->$c++;
    $statistika->save();
               
   }
}
