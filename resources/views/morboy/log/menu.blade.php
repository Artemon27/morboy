<ul id="spisok_log">
@for ($i = 1; $i < $nomer ; $i++)
<li>   
    <a href="/log/{{$i}}"
@if ($i==$idgame)
class='active'
@endif
>Игра №{{$i}}</a>
</li>

@endfor
</ul>