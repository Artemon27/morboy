<div id="gamebox2" >

<div id='koord'></div><div id='koord'>А</div><div id='koord'>Б</div><div id='koord'>В</div><div id='koord'>Г</div><div id='koord'>Д</div>
<div id='koord'>Е</div><div id='koord'>Ж</div><div id='koord'>З</div><div id='koord'>И</div><div id='koord'>К</div>
<div id='koord'>Л</div><div id='koord'>М</div><div id='koord'>Н</div><div id='koord'>О</div><div id='koord'>П</div>
@for ($i = 1, $j='a'.$i, $k=1; $i < $s+1 ; $i++,$j='a'.$i)

@if (($i % 15)==1) 

<div id='koord'>{{$k++}}</div>
@endif

@if ($pole->$j != NULL)
<div id='b{{$pole->$j}}'>
    </div>
@else
<div class='submit2' value='{{$i}}'></div>
@endif
    
@endfor

</div>


 
<script type="text/javascript">
     
$('.submit2').click(function(){
    var d = $(this).attr('value');
    var a = d%15;
    if (a==0) a=15;
    var b = (d-a)/15+1;
    a=a-1;
    a=a.toString();
    a=replace(a);
    
    
  swal({
  title: "Вы выбираете "+a+b+"?",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Да, стреляем!!",
  cancelButtonText: "Хочу ещё подумать",
  closeOnConfirm: true,
},
function(){
     $.ajax({
            url:'proverka2'
            , cache: false
            , data: {'id': d,'_token': $('meta[name="csrf-token"]').attr('content')}
            , type:'POST'
            , success: function(data) {
                
                location.reload();
            },
            error : function(error){
                
                pr = error.responseText[0]+error.responseText[1];
                if (pr==10) $('#error2').text("На сегодня попытки закончились");
                else if (pr==11) $('#error2').text("Эта ячейка уже занята!");
                else if (pr==20) $('#error2').text("Можно ходить только через одного!");
                else if (pr==40) $('#error2').text("Всё, капец..");
                else if (pr==99) $('#error2').text("Игра уже закончилась");
                else $('#error2').text("Ошибка");
                
            }
             });
    
        });
    })
    
    
    
function replace(slovo){
var t=slovo;
	while (t===slovo){
            
	t=t.replace("10","Л");
	t=t.replace("11","М");
	t=t.replace("12","Н");
	t=t.replace("13","О");
	t=t.replace("14","П");
	t=t.replace("15","Р");
        t=t.replace("0","А");
        t=t.replace("1","Б");
	t=t.replace("2","В");
	t=t.replace("3","Г");
	t=t.replace("4","Д");
        t=t.replace('5',"Е");
        t=t.replace("6","Ж");
	t=t.replace("7","З");
	t=t.replace("8","И");
	t=t.replace("9","К");
	break;}
    
	return (t);
}    
    
</script> 