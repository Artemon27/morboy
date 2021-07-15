<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\gameStat;
use App\logPole;
use Illuminate\Support\Facades\DB;

class createPole extends Model
{
        protected $guarded = [''];
        
        
        
        // Создание поля: передача количества каждой из ячеек, ширины и высоты.
       public function createNew($createPole) {
        
          $kol1 = $createPole['kol1'];
          $kol2 = $createPole['kol2'];
          $kol3 = $createPole['kol3'];
          $kol4 = $createPole['kol4'];
          $kol5 = $createPole['kol5'];
          $kolb = $createPole['kolb'];
          $kolk = $createPole['kolk'];
          $n = $createPole['n'];
          $m = $createPole['m'];
          $var = $createPole['var'];
          $k=1;
          //Находим первую строчук или создаём, если её нет
          $vremenno = createPole::find(1);        
                  if ($vremenno==NULL)
                  { 
                      $k=0;
                      $vremenno = new createPole();
                  }
         if($k)
         {
             $logPole=new logPole;
             $logPole->zapis();
         }
          $mimo=$n*$m-($kol1+$kol2+$kol3+$kol4+$kol5+$kolb+$kolk);
      //создаём массив с данными поля    
        $nomer=1;
        $pole = array( "klad" => $kolk,
               "bomb" => $kolb,
               "c5" => $kol5,
			   "c4" => $kol4,
               "c3" => $kol3,
			   "c2" => $kol2,
               "c1" => $kol1,
			   "m" => $mimo); 

$kol=$pole['klad']+$pole['bomb']+$pole['c5']+$pole['c4']+$pole['c3']+$pole['c2']+$pole['c1']+$pole['m'];

for ($i=0;$i<$n*$m;$i++)
{
	
		$rand = rand(0,$kol-1);
		
		if ($rand<$pole['klad'])
		{
			$itog='k';
			$pole['klad']=$pole['klad']-1;
		}
		else
			{
				$rand=$rand-$pole['klad'];
			if ($rand<$pole['bomb']){
				$itog='b';
				$pole['bomb']=$pole['bomb']-1;}
			
			else
			{
				$rand=$rand-$pole['bomb'];
			if ($rand<$pole['c5']){
				$itog='5';
				$pole['c5']=$pole['c5']-1;
				}
			else
			{
				$rand=$rand-$pole['c5'];
				if ($rand<$pole['c4']){
					$itog='4';
				$pole['c4']=$pole['c4']-1;}
			
			else
			{
				$rand=$rand-$pole['c4'];
				if ($rand<$pole['c3']){
					$itog='3';
				$pole['c3']=$pole['c3']-1;}
			
				else
			{
				$rand=$rand-$pole['c3'];
				if ($rand<$pole['c2']){
					$itog='2';
				$pole['c2']=$pole['c2']-1;}
			
				else
			{
				$rand=$rand-$pole['c2'];
				if ($rand<$pole['c1']){
					$itog='1';
				$pole['c1']=$pole['c1']-1;}
			
				else
			{
				$rand=$rand-$pole['c1'];
				if ($rand<$pole['m']){
					$itog='m';
				$pole['m']=$pole['m']-1;}
                        }}}}}}}
                       
                 $b='a'.$nomer;
                $vremenno->$b=$itog;
		$kol=$kol-1;	
	$nomer++;
}
//Запись в базу данных.
 $vremenno->save();
 
 //Создаём запись о данных поля
  $vremenno = createPole::find(2);        
                  if ($vremenno==NULL)
                  {
                          $vremenno = new createPole();
                          $vremenno->a11=0;
                  }
                  $vremenno->a1=$n;
                  $vremenno->a2=$m;
                  $vremenno->a3=$kol1;
                  $vremenno->a4=$kol2;
                  $vremenno->a5=$kol3;
                  $vremenno->a6=$kol4;
                  $vremenno->a7=$kol5;
                  $vremenno->a8=$kolb;
                  $vremenno->a9=$kolk;
                  $vremenno->a10=$var;
                  $vremenno->a11++;
  $vremenno->save();
                  
   $vremenno = createPole::find(3);        
                  if ($vremenno==NULL)
                          $vremenno = new createPole();
   else
        {
        $nomer=1;
        for ($i=0;$i<$n*$m;$i++)
        {
            $b='a'.$nomer;
            $vremenno->$b=NULL;
            $nomer++;
        }
   }
   $vremenno->save();
   $this->clear();
       
   }
        
        ///Очистка данных игры
   
        public function clear()
        {
            
            DB::table('game_hods')->truncate();
            DB::table('game_stats')->truncate();
            
            
        }
       
   
   
   
   
   
   
   
   
   
   
   
   
   
// Запись попадания в ячейку
public function zapis($nomer) {
      
    $b='a'.$nomer;
    $znachenie = createPole::find(1)->$b;
    if ($znachenie=='b')
    {
        $bomb = createPole::find(2)->a8;
        if ($bomb==1)
        {
             $gameHod=new gameHod();
             $gameHod->end($nomer);
        }
        else
        {
            $vremenno = createPole::find(2);
            $vremenno['a8']=$bomb-1;
            $vremenno->save();
        }
        
    }
    else if ($znachenie=='k')
    {
        $klad = createPole::find(2)->a9;
        if ($klad==1)
        {
             $gameHod=new gameHod();
             $gameHod->end($nomer);
        }
        else
        {
            $vremenno = createPole::find(2);
            $vremenno['a9']=$klad-1;
            $vremenno->save();
        }
    }
    else
    {
         
        $gameHod=new gameHod();
        $gameHod->zapis($nomer);        
    }
                    
    $vremenno = createPole::find(3);
    $vremenno[$b]=$znachenie;
    $vremenno->save();
    
    
    
    $gameStat=new gameStat();
    $time = createPole::find(1)->updated_at;
    $gameStat->zapis($znachenie,$time);
    
}

}