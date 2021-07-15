<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\createPole;
use App\User;
use App\usersStat;
use App\gameHod;
use App\gameStat;
use App\logStat;
use App\logPole;
use App\dopInfo;
use App\chat;
use App\statistika;
use App\chatSysMsg;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreatePoleRequest;
use App\Http\Requests\VystrelRequest;
use App\Http\Requests\SendMessageRequest;
use App\Http\Requests\SlovaVystrelRequset;
use App\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gate;
use Validator;

class MorBoyController extends Controller
{
    //Админка:
    public function admin() {
        
        if (Gate::denies('admin')) {
            return redirect('login');
        }
          $users=User::get();
        return view('morboy.admin.polzovat', compact('users'));
        
    }
    
    public function adminPole() {
        
        if (Gate::denies('admin')) {
            return redirect('login');
        }
        return view('morboy.admin.pole');
        
    }public function adminFrazy() {
        
        if (Gate::denies('admin')) {
            return redirect('login');
        }
        return view('morboy.admin.frazy');
        
    }
    
    
    
    
    
    
    //Запрос на создание поля:
    public function createStore(CreatePoleRequest $request) {
        
        $vr=$request->request; 
        $b=$vr->get('kolb')+$vr->get('kolk')+$vr->get('kol1')+$vr->get('kol2')+$vr->get('kol3')+$vr->get('kol4')+$vr->get('kol5');
       if (($vr->get('n')*$vr->get('m'))<$b)
       {
           $validator = new Validator;
           return redirect()->back()->withErrors('Слишком маленькое поле');
       }  
        
        
        $createPole=new createPole();
        
        $createPole->createNew($request->all());
        return redirect('morboy')->with('message', 'Поле успешно создано!');
    }
    
    //Добавление звания пользователю createAdmin
    
    public function createAdmin(Request $request) {
        
        $user=User::findOrFail($request['id']);
        $user->update($request->all());
        return redirect('admin');
        
    }
    
    //Доступ к участию в игре
    public function createDostup(Request $request) {
        
        $usersStat = usersStat::findOrFail($request['id']);
         if ($request['dostup']!=NULL)
        {
            $usersStat->dostup = 1;
            $usersStat->save();   
        }
        else
        {
         $usersStat->dostup = 0;   
         $usersStat->save();   
        }
       
        $user=User::findOrFail($request['id']);
        $user->update($request->all());
        return redirect('admin');
        
    }
    
    
    //Добавление слов для выстрела
    public function createSlovaDlyaVystrela(SlovaVystrelRequset $request) {
        
        $chatSysMsg = new chatSysMsg;
        $chatSysMsg->dobavlenie($request['sobytie'],$request['msg']);
        return redirect('admin');
        
    }
    
    
    
    
    
    
    
    //Логи игр:
     public function log($idgame = 1) {
        
     if (!logPole::find($idgame)){        
        $logPoles = logPole::firstOrFail(); 
        return redirect('log/'.$logPoles['id']);         
     }    
     
     
     $logPoles = logPole::where('id','=',$idgame)->get();
     $logStats = logStat::where('id_game','=',$idgame)->get();
     $nomer = logPole::orderBy('id','desc')->take(1)->get();
     $nomer = $nomer[0]->id+1;
     $s=$logPoles[1]->a1*$logPoles[1]->a2;
    return view('morboy.log', compact('logPoles','logStats', 's', 'nomer','idgame'));
    
    
   
     }
    
    
        
    
    //Основное поле
    
     public function osnova(Request $request) {
            
          if (Gate::denies('dostup')) {
            $dostup=0;
        }
        else   {
            $dostup=1;
     
        }
       
        $dopInfo = new dopInfo();
        $dopInfo->vhod();
        $message = Session::pull('message');
        
        $gameHod = gameHod::where('end','=','1')->count();
         if ($gameHod!=NULL)
        $dostup=0;
                
        $usersStats=usersStat::Where('allpoints','>','0')->latest('allpoints')->get();
        $gameStats=gameStat::latest('points')->get();
        $now = Carbon::now();  
        
        //Передача чата
        $chats = chat::Where('del','=','0')->orderBy('id','desc')->take(30)->get()->sort();
        if($request->ajax()) {
         return view('morboy.osnova',compact('$chats'))->renderSections()['morboy.chat'];
    }
      //Передача поля  
       
       
        $fon=1;
        
       $pole = createPole::find('3');
       if ($pole==NULL)
           return redirect('login'); 
       $dan = createPole::findOrFail('2');
       $s=$dan['a1']*$dan['a2'];
       $nomer=$dan['a11'];
        
       return view('morboy.osnova', compact('pole','fon','s','nomer','dostup','usersStats','gameStats','now','chats','message'));
       
    }
    
    //Рисунок поля и запросы.
//    public function proverka(VystrelRequest $request) {
//        
//        $pp = $request->request->keys()[1];
//        
//        
//        $s = $request->request->get($pp);
//               if (($s<1)||($s>225))
//       {
//           return redirect()->back()->withErrors('Вы сломали поле');
//       }  
//  
//        $createPole=new createPole();
//        $createPole->zapis($request[$pp]);
//        
//        return redirect('morboy');
//    }
    
    
    public function proverka2(VystrelRequest $request) {
       $s = $request->id;
       
       if (($s<1)||($s>225))
       {
           echo '40';
           return redirect()->back()->withErrors('Вы сломали поле');
       }  
       
        $createPole=new createPole();
        $createPole->zapis($request->id);
    }
    
    
    
    public function sendmsg(SendMessageRequest $request) {
       $chat = new chat();
       $t = $chat->zapis($request->usermsg2);
       if ($t==false)
           return false;
    }
    
    public function newmsg(Request $request) {
   
        //Проверка на онлайн
        if (Auth::check())
        {
            $dopInfo = new dopInfo();
            $dopInfo->vhod();
        }
     //Проверка на новые сообщения   
        $chats = chat::where('id','=',$request->id)->Where('del','=','0')->get();
        if ($chats->count()==0)
        {
            if ($request->id == 'pusto')
               $chats = chat::Where('del','=','0')->orderBy('id','desc')->take(30)->get()->sort()->values();
            else 
            {
            $chats = chat::Where('del','=','0')->orderBy('id','desc')->take(30)->get()->sort()->values();
            $chats[0]->clear = 1;
      
            }
 
        }
          else
          {
              if ($chats[0]->message != $request->s)
       {
            return false;
       }  
            
        
           
       $chats = chat::where('id','>',$request->id)->Where('del','=','0')->get();
          }
        
       if ($chats->count()!=0)
       { 
       
        if (!Gate::denies('admin'))
         $chats[0]->del='<p id="delmsg" onclick="delmsg(this)">х</p>';   
      
       $chats[0]->count=$chats->count();
       $response = response()->json($chats);
       $response->header('Content-Type', 'application/javascript');
     
       return $response;
       }
       else
       {
           return false;
       }
    }
    
    public function delmsg(Request $request) {
        
       $chat = new chat();
       $chat->del($request->id);
    }
    
    
    
    
     public function chatonline(Request $request) {
         
         $dopInfo = dopInfo::Where('online','=','1')->get();
         
         for ($i=0;$i<$dopInfo->count();$i++)
         {
             $login = $dopInfo[$i]->user->name;
             $dopInfo[$i]->login = $login;
         }
         
         $response = response()->json($dopInfo);
         $response->header('Content-Type', 'application/javascript');
         return $response;
     }
     
     
     
     
     //Личная страничка:
     
        public function mypage() {
            if (!Auth::check())
         return redirect('login');
     $id = Auth::User()->id;
     $user = User::where('id','=',$id)->get();
     $user=$user[0];
     $userStat = usersStat::get()->sortByDesc('allpoints')->values();
     
    
     for ($i=0;$i<$userStat->count();$i++)
     {
     if ($userStat[$i]->id==$id)
         break;
     $i++;
     }
     $nomer = $i+1;
     
     $gameStat = gameStat::get()->sortByDesc('points')->values();
     
     for ($i=0;$i<$gameStat->count();$i++)
     {
     if ($gameStat[$i]->id==$id)
         break;
     $i++;
     }
     $nomer2 = $i+1;
     
     
     $statistika = statistika::find($id);
     if ($statistika==NULL)
     {
        $statistika = new statistika;
        $statistika->id = $id;
        $statistika->podryad1 = 0;
        $statistika->podryad2 = 0;
        $statistika->podryad3 = 0;
        $statistika->podryad4 = 0;
        $statistika->podryad5 = 0;
        $statistika->podryadb = 0;
        $statistika->podryadk = 0;
        $statistika->podryadm = 0;
        $statistika->pop1 = 0;
        $statistika->pop2 = 0;
        $statistika->pop3 = 0;
        $statistika->pop4 = 0;
        $statistika->pop5 = 0;
        $statistika->popb = 0;
        $statistika->popk = 0;
        $statistika->popm = 0;
        $statistika->save();
     }
      
     
    return view('morboy.mypage', compact('user','nomer','nomer2','statistika'));
   
     } 
     
     
     
     
     
     
     
}

