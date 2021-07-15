<?php

namespace App\Mafka;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class gameTemplate extends Model
{
     protected $guarded = [''];
     protected $connection = 'mafka';
     
     public function igra($nomer) {
         
       
       $table = DB::connection('mafka')->table($nomer)->get();
       $id=Auth::User()->id;
       $kol=$table[0]->rol;      
       $j=0;
       for ($i=1;$i<$kol+1;$i++)
       {
           if ($table[$i]->id==$id)
           {
               $j=1;
               break;         
           }
       }
       if ($j==0)
           return false;
       return $table[$i];      
        
    
        
     }
     
     
     public function whoOnline($nomer) {
         
         
       $table = DB::connection('mafka')->table($nomer)->get();
       $id=Auth::User()->id;
       $kol=$table[0]->rol;      
       $j=0;
       for ($i=1;$i<$kol+1;$i++)
       {
           if ($table[$i]->id==$id)
           {
               if ($table[$i]->life==0)
                   $smert=1;
               else 
                   $smert=0;
               $j=1;
               break;         
           }
       }
       if ($j==0)
           return false;
       $names=collect();
       $names->push($smert);
       
       for ($i=1;$i<$kol+1;$i++)
       {
           if ($table[$i]->life==1)
           {$user = User::where('id','=',$table[$i]->id)->get();
           $user = $user[0]->name;
           $names->push($user);
           }
       }
       
       
       return $names;      
        
    
        
     }
     
     
     
     
      public function deystvie($nick,$nomer) {
         
         
       $table = DB::connection('mafka')->table($nomer)->get();
       $id=Auth::User()->id;
       $kol=$table[0]->rol;      
       $j=0;
       
       for ($i=1;$i<$kol+1;$i++)
       {
           if ($table[$i]->id==$id)
           {
               $j=1;
               $role = $table[$i]->rol;
               
               break;         
           }
       }
       if ($j==0)
           return false;
       
       if ($role=='maf')
           $this->ubil($nick,$nomer);
       else
           return false;
       return true;
       
    
        
     }
     
     
      public function ubil($nick,$nomer) {
    
               
    $user = User::where('name','=',$nick)->get();
    $user = $user[0]->id;   
    
    $table = DB::connection('mafka')->table($nomer)->where('id', $user)->update(array('life' => 0));
    
     }
     
     
}

