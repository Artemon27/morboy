<?php

namespace App;
use App\User;
use App\chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class chatSysMsg extends Model
{
     protected $guarded = [''];
     
     public function zapis($znachenie,$podryad) {
      
    $name= Auth::User()->name;
    
    $chat = new chat;
    
    $msg = chatSysMsg::Where('sobytie','=',$znachenie)->get();
    
    if ($msg->isEmpty())
    {
         return false;
    }
    else
    {            
        $chat->message = str_replace("%NICK%", $name, $msg->random()->message);
        $chat->save();    
    }
}

public function dobavlenie($sobytie,$msg) {
    
    $chatSysMsg = new chatSysMsg;
    $chatSysMsg->sobytie=$sobytie;
    $chatSysMsg->message=$msg;
    $chatSysMsg->save();    
        
}
}
