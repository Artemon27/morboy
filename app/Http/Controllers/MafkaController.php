<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\User;
use App\Mafka\partia;
use App\Mafka\gameTemplate;
use App\Mafka\userPartia;

class MafkaController extends Controller
{
     public function mafka()
    {
     $partias = partia::get();   
     
         
     return view('mafka.okno', compact('partias'));    
     
     
    }
    
    public function create()
    {
     $partia = new partia;    
     $partia->razmer=2;
     $partia->save();
     $partia = partia::get()->last()->id;
     $ssylka='mafka/game/'.$partia;
     return redirect($ssylka);    
     
     
    }
    
    
    
    public function partia($id)
    {
     
      
     $partia = partia::findOrFail($id)->where('id','=',$id)->get();
     $userPartia = new userPartia;
     $userPartia->zapis($id);  
     $partia=$partia[0];
   
     $partia->razmer=2;
     for ($i=1;$i<$partia->razmer+1;$i++)
     {
     $nomer='igrok'.$i;
     if ($partia->$nomer==null)
     {
         $partia->$nomer=Auth::User()->id;
         break;
     }
     }
     $partia->save();
     $j=0;
     for ($i=1;$i<$partia->razmer+1;$i++)
     {
     $nomer='igrok'.$i;
     if ($partia->$nomer==NULL)
     {
         $j=1;
         break;
     }
     }
     if ($j==0)
     {
         $nomer=$partia->begin($partia->id);
         return redirect('mafkagame')->with('nomer',$nomer);
     }
     else
return view('mafka.partia', compact('partia'));     
     
    }
    
    
    
    
    
    public function game()
    {
     $id=Auth::User()->id;
     $userPartia = userPartia::where('id','=',$id)->get();
     $nomer = $userPartia[0]->partia;
     $game= new gameTemplate;
     $dannye = $game->igra($nomer);
    
     return view('mafka.game', compact('dannye','nomer'));     
     
    }
    
    
    public function gameonline(Request $request)
    {
        
     $nomer= $request->nomer;
     $game= new gameTemplate;
     $dannye = $game->whoOnline($nomer);
        
     $response = response()->json($dannye);
     $response->header('Content-Type', 'application/javascript');
     return $response;     
     
    }
    
    
    public function deystvie(Request $request)
    {
        
     $nick= $request->nick;
     $nomer= $request->nomer;
     $game= new gameTemplate;
     $dannye = $game->deystvie($nick,$nomer);
        
     return $response;     
     
    }
    
    public function gameorno(Request $request)
    {
        $nomer='igra'.$request->nomer;
        if (Schema::connection('mafka')->hasTable($nomer))
        {
            return redirect('mafkagame')->with('nomer',$request->nomer); 
        }
        else return false;
     
    }
    
    
    
}
