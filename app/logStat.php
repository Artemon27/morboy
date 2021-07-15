<?php

namespace App;
use App\gameStat;
use Illuminate\Database\Eloquent\Model;

class logStat extends Model
{
     protected $guarded = [''];
    public $timestamps = false;
    //Запись лога
    public function zapis($nomer) {
        
        $gameStat = gameStat::get();
        
        $count = $gameStat->count();
        for($i=0;$i<$count;$i++)
        {
          $gameStat[$i]->id_game = $nomer; 
          $logStat = logStat::create($gameStat[$i]->toArray());
        }   
               
        
    }
    
    public function user()
  {
    return $this->belongsTo('App\User','id','id');
  }
}
