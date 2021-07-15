<div id="gamebox2" >
<div id='koord'></div><div id='koord'>А</div><div id='koord'>Б</div><div id='koord'>В</div><div id='koord'>Г</div><div id='koord'>Д</div>
<div id='koord'>Е</div><div id='koord'>Ж</div><div id='koord'>З</div><div id='koord'>И</div><div id='koord'>К</div>
<div id='koord'>Л</div><div id='koord'>М</div><div id='koord'>Н</div><div id='koord'>О</div><div id='koord'>П</div>

@for ($i = 1, $j='a'.$i, $k=1; $i < $s+1 ; $i++,$j='a'.$i)

@if (($i % 15)==1) 

<div id='koord'>{{$k++}}</div>
@endif


@if ($logPoles[0]->$j != NULL)
<div id='b{{$logPoles[$Nomer]->$j}}'>
    </div>
@else
<div id='bp'>
    </div>
@endif
    

@endfor

</div>