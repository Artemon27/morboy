<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use App\Providers\AuthServiceProvider;
use App\User;
use App\createPole;
use Illuminate\Database\Eloquent\Model;

class gameHod extends Model
{
    protected $guarded = [''];
    
    //Запись хода
    public function zapis($nomer) {
        
        
        $createPole = createPole::findOrFail(2);
        //n - ширина, m - высота
        $n = $createPole['a1'];
        $m = $createPole['a2'];        
        
        $vys = $nomer % $m;
        if ($vys==0) $vys=$m;
        $shir = ($nomer-$vys)/$n+1;
        
        $nachalo= array(10,11,12,13,14,15,1,2,3,4,5,6,7,8,9);
        $konez= array("К","Л","М","Н","О","П","А","Б","В","Г","Д","Е","Ж","З","И");

        $bykva = str_replace($nachalo, $konez, $vys);
        
        
        $gameHod=new gameHod;
        $id=Auth::User()->id;
        
        $gameHod->id=$id;
        $pole=$bykva.$shir;
        $gameHod->hod=$pole;
       
        
        $gameHod->save();
         
    }
    
    
    public function end($nomer) {
        
        
        $createPole = createPole::findOrFail(2);
        //n - ширина, m - высота
        $n = $createPole['a1'];
        $m = $createPole['a2'];        
        
        $vys = $nomer % $m;
        if ($vys==0) $vys=$m;
        $shir = ($nomer-$vys)/$n+1;
        
        $nachalo= array(10,11,12,13,14,15,1,2,3,4,5,6,7,8,9);
        $konez= array("К","Л","М","Н","О","П","А","Б","В","Г","Д","Е","Ж","З","И");

        $bykva = str_replace($nachalo, $konez, $vys);
        
        
        $gameHod=new gameHod;
        $id=Auth::User()->id;
        
        $gameHod->id=$id;
        $pole=$bykva.$shir;
        $gameHod->hod=$pole;
        $gameHod->end=1;
               
        $gameHod->save();
         
    }
    
    
    
    
    public function user()
  {
    return $this->belongsTo('App\User','id','id');
  }
}
