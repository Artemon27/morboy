<?php
namespace App;
use Illuminate\Validation\Validator; //Здесь должно быть именно так, а не просто фасад Validator
use Illuminate\Support\Facades\Auth;
use App\gameHod;
use App\gameStat;
use App\createPole;
use App\User;
use Carbon\Carbon;

class CustomValidator extends Validator {
    
    
    public function ValidateAdminKolPole($attribute, $value, $parameters)
{
        
        return false;

}
    

public function ValidateMimoVDen($attribute, $value, $parameters)
{
    
     //$atribute - это название поля, в нашем случае site
     //$value - значение поля
     //$parameters - это параметры, которые можно передать так urlrl:ru, ($parameters=['ru'])
    $id=Auth::User()->id;  
    $time=Carbon::now();
    $time=$time->day;
    $gameStat = gameStat::where('id','=',$id)->get();
    
    if ($gameStat->count()==0){
    return true;}
    if ($gameStat[0]->daymimo==$time)
        if($gameStat[0]->mimo > 2)
        {
            echo '10';
            return false;
        }
        else
        {
            return true;
        }
    else 
    {
        $gameStat[0]->daymimo=$time;
        $gameStat[0]->mimo = 0;
        $gameStat[0]->save();
    }
    
     return true;
}


    //Ограничение по количеству попыток в день (j-количество попыток)
public function ValidateRazVDen($attribute, $value, $parameters)
{
    
     //$atribute - это название поля, в нашем случае site
     //$value - значение поля
     //$parameters - это параметры, которые можно передать так urlrl:ru, ($parameters=['ru'])
    $id=Auth::User()->id;  
    $time=Carbon::now();
    $time=$time->day;
    $gameHod = gameHod::where('id','=',$id)->get();
    $count = $gameHod->count();
    $j=0;
    for ($i=0;$i<$count;$i++)
    {        
      $d=$gameHod[$i]->created_at;
      $d=$d->day;
      if ($d==$time) $j++;      
    }
    if ($j>11)
    {
     return true;
    }
    else 
     return true;
}


//Ограничение по количеству попыток подряд
public function ValidatePodryad($attribute, $value, $parameters)
{
    $id=Auth::User()->id; 
     //$atribute - это название поля, в нашем случае site
     //$value - значение поля
     //$parameters - это параметры, которые можно передать так urlrl:ru, ($parameters=['ru'])
    ///не больше трёх ходов подряд:
    /// $id=Auth::User()->id;  
    // $j=0;
//     $gameHod = gameHod::orderBy('sort','desk')->take(3)->get();
//         for ($i=0;$i<3;$i++)  
//              if ($gameHod[i]->id==$id)
  ///                   $j++;
//     if (j==3)
//     return false;
//    else 
//     return true;
    
    
       
    $gameHod = gameHod::orderBy('sort','desc')->take(1)->get();
    
  
    if($gameHod->first()!=NULL)
    {
          if ($gameHod[0]->id==$id)
          {
               return true;
          }
    }
                 
          
    return true;
}

//Проверка занята ли данная ячейка
public function ValidateZanyato($attribute, $value, $parameters)
{

    
    $createPole = createPole::findOrFail(2);
        //n - ширина, m - высота
        $n = $createPole['a1'];
        $m = $createPole['a2'];        
        
        $vys = $value % $m;
        if ($vys==0) $vys=$m;
        $shir = ($value-$vys)/$n+1;
        
        $nachalo= array(10,11,12,13,14,15,1,2,3,4,5,6,7,8,9);
        $konez= array("К","Л","М","Н","О","П","А","Б","В","Г","Д","Е","Ж","З","И");

        $bykva = str_replace($nachalo, $konez, $vys);
        
        $pole=$bykva.$shir;
        
        $count = gameHod::where('hod','=',$pole)->count();
        
    if ($count>0)
    {echo '11';
     return false;
    }
    else
     return true;
}



public function ValidateEnd($attribute, $value, $parameters)
{
    
     //$atribute - это название поля, в нашем случае site
     //$value - значение поля
     //$parameters - это параметры, которые можно передать так urlrl:ru, ($parameters=['ru'])
    $gameHod = gameHod::where('end','=','1')->count();
    if ($gameHod!=NULL)
    {
     echo '99';
     return false;
    }
   else 
     return true;
}

//Не больше 3 айпи на пользователя при регистрации
public function ValidateTriIp($attribute, $value, $parameters)
{
    
     //$atribute - это название поля, в нашем случае site
     //$value - значение поля
     //$parameters - это параметры, которые можно передать так urlrl:ru, ($parameters=['ru'])
    $user=User::where('ipreg','=',$value)->get()->count();
    if ($user>2)
    {
     return false;
    }
   else 
     return true;
}



}