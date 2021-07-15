@extends('app')

@section('content')

<div id="mypage">
    <div id="profile">
      
        Логин: {{$user->name}}
        <br>
        E-mail: {{$user->email}}
        <br>
        Ранг: {{$user->zvanie}}
        
    </div>


    <div id="myresult">
        <table>  <tr><td colspan=6>Общая статистика</td></tr>
            <tr class="zagolovoktable"><td>Место</td><td>Игры</td><td>Клады</td><td>Бомбы</td><td>Ходы</td><td>Все очки</td></tr>

 <tr><td>{{$nomer}}</td><td>{{$user->usersStat->games}}</td><td>{{$user->usersStat->klad}}</td><td>{{$user->usersStat->bomb}}</td><td>{{$user->usersStat->hod}}</td><td>{{$user->usersStat->allpoints}}</td></tr>
 
         </table>
     @if ($user->gameStat!=NULL)
        <table>  <tr><td colspan=6>Статистика по текущей игре</td></tr>
             <tr class="zagolovoktable"><td>Место</td><td>День 1</td><td>День 2</td><td>День 3</td><td>Ходы</td><td>Очки</td></tr>
   
    <tr><td>{{$nomer2}}</td><td>{{$user->gameStat->day1}}</td><td>{{$user->gameStat->day2}}</td><td>{{$user->gameStat->day3}}</td><td>{{$user->gameStat->num_hod}}</td><td>{{$user->gameStat->points}}</td></tr>
 
         </table>
<table>  <tr><td colspan=8>Статистика попаданий</td></tr>
             <tr class="zagolovoktable"><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>бомба</td><td>клад</td><td>мимо</td></tr>
   
    <tr><td>{{$statistika->pop1}}</td><td>{{$statistika->pop2}}</td><td>{{$statistika->pop3}}</td><td>{{$statistika->pop4}}</td><td>{{$statistika->pop5}}</td><td>{{$statistika->popb}}</td><td>{{$statistika->popk}}</td><td>{{$statistika->popm}}</td></tr>
 
         </table>@endif




<table>  <tr><td colspan=8>Статистика попаданий подряд</td></tr>
             <tr class="zagolovoktable"><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>бомба</td><td>клад</td><td>мимо</td></tr>
   
    <tr><td>{{$statistika->podryad1}}</td><td>{{$statistika->podryad2}}</td><td>{{$statistika->podryad3}}</td><td>{{$statistika->podryad4}}</td><td>{{$statistika->podryad5}}</td><td>{{$statistika->podryadb}}</td><td>{{$statistika->podryadk}}</td><td>{{$statistika->podryadm}}</td></tr>
 
         </table>

    </div>
</div>

@include('errors.list')





@stop

    
    
    

