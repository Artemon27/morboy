<?php

namespace App;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class dopInfo extends Model
{
    protected $guarded = [''];
    
    
     public function vhod()
  {
    
    $d = Carbon::now();     
    $dopinfo = dopInfo::Where('online','=','1')->get();
    $j = $dopinfo->count();
    for ($i=0;$i<$j;$i++)
    
    {  
             
       $time = $d->diffInMinutes($dopinfo[$i]->updated_at);
       if ($time>1)
        $dopinfo[$i]->online=0;
        $dopinfo[$i]->save();
    }
    if (Auth::check())
        {
  
    $id = Auth::User()->id;
    $dopinfo = dopInfo::Where('id','=',$id)->get();
    $dopinfo[0]->online = 1;
    $dopinfo[0]->updated_at = Carbon::now();
    $dopinfo[0]->save();
        }
  }
    
    
    public function user()
  {
    return $this->belongsTo('App\User','id','id');
  }
}

