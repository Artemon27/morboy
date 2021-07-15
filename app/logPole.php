<?php

namespace App;
use App\createPole;
use App\logStat;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;


class logPole extends Model
{
    protected $guarded = [''];
    
    //Запись лога
    public function zapis() {
        $createPole = CreatePole::get();
        $b=$createPole[1]->a11;
        $createPole[0]->id = $b;
        $createPole[1]->id = $b;
        $createPole[2]->id = $b;
       
       
       
        $logPole = logPole::create($createPole[0]->toArray());
        $logPole = logPole::create($createPole[1]->toArray());
        $logPole = logPole::create($createPole[2]->toArray());
         
       $logStat=new logStat;
       $logStat->zapis($b); 
        
        
    }
}
