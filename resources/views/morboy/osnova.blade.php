@extends('app')

@section('content')

<div id=gamenomer><b>ИГРА №{{$nomer}}</b></div>
<div id="gamewrap">
    <div id="result">
    <label for="res1" id='pre-res' class="btn btn-create-pole">Общие результаты</label>
    <input type="checkbox" id="res1"  name="createpole" >
    <section id="resultgl">
        Организаторы: Шпионка..
        <table>  
            <tr class="zagolovoktable"><td>№</td><td>Ник</td><td>Игры</td><td>Клады</td><td>Бомбы</td><td>Ходы</td><td>Все очки</td></tr>
<?php $i=1?>
 @foreach ($usersStats as $usersStat)

 <tr><td><b>{{$i++}}</b></td><td>{{mb_substr($usersStat->user->name,0,10,'UTF-8')}}</td><td>{{$usersStat->games}}</td><td>{{$usersStat->klad}}</td><td>{{$usersStat->bomb}}</td><td>{{$usersStat->hod}}</td><td>{{$usersStat->allpoints}}</td></tr>
    
@endforeach
        </table>
    </section>
    </div>
    
@if ($dostup == 0)
@include('morboy.poleNo')
@else 
@include('morboy.pole')
@endif


<?php $i=1?>
<div id="stat">
    Банк клада: 100р.
     <table>  
            <tr class="zagolovoktable"><td><b>№</b></td><td>Ник</td><td>День 1</td><td>День 2</td><td>День 3</td><td>Ходы</td><td>Очки</td></tr>

    @foreach ($gameStats as $gameStat)
    
    <b><tr><td><b>{{$i++}}</b></td><td>{{mb_substr($gameStat->user->name,0,10,'UTF-8')}}</td><td>{{$gameStat->day1}}</td><td>{{$gameStat->day2}}</td><td>{{$gameStat->day3}}</td><td>{{$gameStat->num_hod}}</td><td>{{$gameStat->points}}</td></tr></b>

    
    

@endforeach   
     </table>
</div>
</div>



        <h3><div id='error2'>
    @if ((Gate::denies('dostup'))&&(Auth::check()))
    Добро пожаловать! Вы сможете начать игру сразу после одобрения организатором.
    @endif
    @if (isset($message))
    {{$message}}
    @endif
    </div></h3>



    @include('morboy.chat', [ 'chats' => $chats])


@include('errors.list')





@stop

    
    
    

