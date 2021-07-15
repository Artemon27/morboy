<?php

namespace App\Mafka;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class userPartia extends Model
{
    protected $guarded = [''];
    protected $connection = 'mafka';
     
    public function zapis($nomer){
        $id=Auth::User()->id;
        $userPartia = userPartia::where('id','=',$id)->get();
        if ($userPartia->count()==0)
        {
            $userPartia=new userPartia;
            $userPartia->id=$id;
            $userPartia->save();
            $userPartia = userPartia::where('id','=',$id)->get();
        }
        $userPartia[0]->partia='igra'.$nomer;
        $userPartia[0]->save();
    }
}
