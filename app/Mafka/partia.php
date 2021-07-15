<?php

namespace App\Mafka;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class partia extends Model
{
     protected $guarded = [''];
     protected $connection = 'mafka';
     
     public function begin($id) {
         
         $partia=partia::find($id);
         $nomer='igra'.$id;
         $razmer=$partia->razmer;
         $maf=1;
         $gr=1;
        
        $vstavka=collect();
        $vstavka->push(array('id'=>'0','rol'=>$partia->razmer));
          
        if ($razmer==2)
        {
            for ($i=1;$i<$partia->razmer+1;$i++)
            {
                $nomerIgroka='igrok'.$i;
                $j=rand(1,$razmer);
                $razmer=$razmer-1;
                if ($j-$maf==0)
                {
                    $new=array('id'=>$partia->$nomerIgroka,'rol'=>'maf','life'=>'1');
                    $maf=$maf-1;
                    $vstavka->push($new);
                   
                }
                else
                {
                    $new=array('id'=>$partia->$nomerIgroka,'rol'=>'gr','life'=>'1');
                    $gr=$gr-1;
                    $vstavka->push($new);
                    
                }
             
            }
        }
       if (Schema::connection('mafka')->hasTable($nomer));
           else{
         Schema::connection('mafka')->create($nomer, function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('rol')->nullable();
            $table->boolean('life')->nullable();
            $table->integer('hod')->nullable();
            $table->timestamps();
        });
              
		for ($i=0;$i<$partia->razmer+1;$i++)
		 DB::connection('mafka')->table($nomer)->insert($vstavka[$i]);
        }
        $nomer=$id;
        return($nomer);
        
        
    
        
     }
}
