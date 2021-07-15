@extends('app')

@section('content')
<div id='hidden'>{{$nomer}}</div>
<div id='hidden2'>{{$dannye->rol}}</div>
<div id='role'>
@if ($dannye->rol=='maf')
   Вы мафия!
@else 
@if ($dannye->rol=='gr')
   Вы человек! 
@endif
@endif
</div>
<ul id='WhoInGame2'>
   
</ul>

<input type="button" id="deystvie"  name="kill" >

@include('errors.list')

<script type="text/javascript">
    $(document).ready(function(){  
    WhoInGame();
    setTimeout(loadLog,5000);
    if ($('#hidden2').text()=='maf')
    $('#deystvie').val('Убить').prop('disabled',true);})


function WhoInGame(){

var igra = $('#hidden').text();

$.ajax({
              url:'/mafka/gameonline'
            , cache: false
            , data: {'nomer': igra,'_token': $('meta[name="csrf-token"]').attr('content')}
            , type:'POST'
            , success: function(data) {
                var event = JSON.parse(data);
                WhoInGame2.innerHTML='';
                if (event[0]==1)
                    alert('Вы убиты');
                for (var i = 1; i < event.length; i++) 
                {
                    var online = document.createElement('li');
                    var login = event[i];
                    online.innerHTML = login;
                    online.className ='polzonline';
                    online.setAttribute('onclick','nickname(this)');
                    WhoInGame2.appendChild(online);
                }          
            },
            error : function(error){

            }
        });
    }
    
    
    function loadLog(){
    WhoInGame();
    setTimeout(loadLog,5000);
    return false;  
};

function nickname(nick){
    $('#deystvie').prop('disabled',false).attr("deystvie", nick.innerHTML);
    $('#WhoInGame2 li').css('background-color','white');
    $(nick).css('background-color','red');
};

$('#deystvie').click(function(){
   if ($('#hidden2').text()=='maf')
  ubil();
    })
    
function ubil(){
    $('#deystvie').prop('disabled',true);
    var nick = $('#deystvie').attr("deystvie");
    var igra = $('#hidden').text();
    
    $.ajax({
              url:'/mafka/deystvie'
            , cache: false
            , data: {'nick': nick,'nomer': igra,'_token': $('meta[name="csrf-token"]').attr('content')}
            , type:'POST'
            , success: function(data) {
                alert(data);
                setTimeout(loadLog,5000);
            },
            error : function(error){
                console.log;
                alert(error.responseText);
            }
        });
    
    
};
    
</script>



@stop

