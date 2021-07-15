<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Gate;

class chat extends Model
{
   protected $guarded = [''];
   
   
   function zapis($msg) {
       $zvanie = Auth::User()->zvanie;
       
  $chat2 = Chat::where('login','=',Auth::User()->name)->get()->last();
 
       if (($chat2)!=NULL)
       {
           
       $time1 = $chat2->created_at;
       $time2 = Carbon::now();
       if ($time1->diffinseconds($time2)<1)
               return false;
       }
       
       $chat = new Chat;
       $chat->login = Auth::User()->name;
       $chat->message = $msg;
       $chat->save();
           
       
       if ($zvanie=='admin')
       {
           $this->clear($msg);
       }
             
       
       return true;
   }
   
   function clear($msg)
   {
       if ($msg=='/cls')           
       DB::table('chats')->update(['del' => 1]);
   }
   
    function del($idmsg)
   {
        
       if (!Gate::denies('admin'))
       {   
       $chat = Chat::where('id','=',$idmsg)->get();
       $chat[0]->del = 1;
       $chat[0]->save();
       }
           
   }
   
     
}



