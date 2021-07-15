<?php

namespace App;
use App\User;
use App\usersStat;
use App\createPole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class gameStat extends Model
{
   public $timestamps = false;
   protected $guarded = [''];
    
    
    
   //Запись статистики по данной игре
    public function zapis($znachenie,$time) {
        
        $time->startOfDay();   
        $d = Carbon::now();
        $days=$time->diffInDays($d);  
        $id=Auth::User()->id;
        $games=0;
        
        
        $gameStat = gameStat::find($id);
        if ($gameStat==NULL)
        {
            $gameStat = new gameStat;
            $gameStat->id=$id;
            $gameStat->points=0;
            $gameStat->num_hod=0;
            $games=1;
        }         
        $gameStat->num_hod=$gameStat->num_hod+1;
        
        if (($znachenie>0)&&($znachenie<6))
    {
          if ($days==0)
              $gameStat->day1=$gameStat->day1+$znachenie;
              
          if ($days==1)
              $gameStat->day2=$gameStat->day2+$znachenie;
          
          if ($days>1)
              $gameStat->day3=$gameStat->day3+$znachenie;
           $gameStat->points=$gameStat->points+$znachenie;
    }
     else {
          if ($days==0)
              $gameStat->day1=$gameStat->day1+0;
              
          if ($days==1)
              $gameStat->day2=$gameStat->day2+0;
          
          if ($days>1)
              $gameStat->day3=$gameStat->day3+0;
         
    }
    
    //Добавление количества мимо
        if (($znachenie=='m')||($znachenie=='b'))
        {
            $gameStat->mimo=$gameStat->mimo+1;
            $gameStat->daymimo=Carbon::today()->day;
        }
 $gameStat->save();       
 
    $usersStat=new usersStat();
    $usersStat->zapis($znachenie,$games);
}

public function user()
  {
    return $this->belongsTo('App\User','id','id');
  }
}
