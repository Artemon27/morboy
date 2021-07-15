@extends('app')

@section('content')
@include('morboy.log.menu')

<div> </div>
@include('morboy.log.pole',['Nomer'=>'0'])
@include('morboy.log.pole',['Nomer'=>'2'])

    <?php $i=1?>
<div id="stat">
     <table>  
         <tr class="zagolovoktable"><td><b>№</b></td><td>Ник</td><td>День 1</td><td>День 2</td><td>День 3</td><td>Ходы</td><td>Очки</td></tr>

   @foreach ($logStats as $logStat)
    
   <tr><td><b>{{$i++}}</b></td><td>{{mb_substr($logStat->user->name,0,10,'UTF-8')}}</td><td>{{$logStat->day1}}</td><td>{{$logStat->day2}}</td><td>{{$logStat->day3}}</td><td>{{$logStat->num_hod}}</td><td>{{$logStat->points}}</td></tr>    

    
    

@endforeach   
     </table>
</div>
    
    

@stop