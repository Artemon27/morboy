<?php

namespace App;


use App\User;
use App\chatSysMsg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\statistika;
class usersStat extends Model
{
   public $timestamps = false;
   protected $guarded = [''];
   
    public function zapis($znachenie,$games) {
        
    $id=Auth::User()->id;
    $usersStat = usersStat::find($id);        
    
    $usersStat->hod++;
    $usersStat->games=$usersStat->games+$games;
    
    if (($znachenie>0)&&($znachenie<6))
        $usersStat->allpoints=$usersStat->allpoints+$znachenie;
    
    else 
        if ($znachenie=='k')
           $usersStat->klad++;
        else
           if ($znachenie=='b')
           $usersStat->bomb++;
           
    if ($znachenie==$usersStat->last)
        $usersStat->num_last++;
    else
    {
        $usersStat->last=$znachenie;
        $usersStat->num_last=1;
    }
    $statistika = new Statistika;
    $statistika -> zapis($usersStat->last,$usersStat->num_last);
    $usersStat->save();
    $chat=new chatSysMsg;
    $chat->zapis($usersStat->last,$usersStat->num_last);
}

public function user()
  {
    return $this->belongsTo('App\User','id','id');
  }
}




