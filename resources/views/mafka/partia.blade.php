@extends('app')

@section('content')
<div id='hidden'>{{$partia->id}}</div>
<div class="gamers">Игроки:</div>
@for ($i=1;$i<$partia->razmer+1;$i++)
<?php $nomer='igrok'.$i   ?>
<div id="player{{$i}}">{{$partia->$nomer}}</div>

@endfor

@include('errors.list')






<script type="text/javascript">
    
$(document).ready(function(){  
    loadLog();
    })


function ItsGame(){

var igra = $('#hidden').text();

$.ajax({
              url:'/mafka/gameorno'
            , cache: false
            , data: {'nomer': igra,'_token': $('meta[name="csrf-token"]').attr('content')}
            , type:'POST'
            , success: function(data) {
                alert('успешно')
            },
            error : function(error){
                
            }
        });
    };
    
    
    function loadLog(){
    ItsGame();
    setTimeout(loadLog,5000);
    return false;  
};
    
</script>

    
    
@stop
