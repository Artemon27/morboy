<div id="fullchat" class="clearfix">
<div id="polechat"><div id="chatslovo">Пиратский чат:</div>
<div id="game2chat">
    
 @foreach ($chats as $chat)
 @if ($chat->login==NULL)
 
 <div class='msgln' id="{{$chat->id}}"><i>{{$chat->created_at->toTimeString()}}: 

 <span>{{$chat->message}}</span>
     
@if (!Gate::denies('admin'))
<p id="delmsg" class="delmsg2">х</p>
@endif
     </i>
 </div> 
 @else 
 
 <div class='msgln' id="{{$chat->id}}">{{$chat->created_at->toTimeString()}} 

<b onclick='nickname("{{$chat->login}}")'> {{$chat->login}}</b>:

 <span>{{$chat->message}}</span>
     
@if (!Gate::denies('admin'))
<p id="delmsg" class="delmsg2">х</p>
@endif
 </div>
    
@endif
@endforeach   
    
</div>
</div>
    <div id="online2"><div id=onlineslovo>Онлайн:</div><ul id="onlinepolz"></ul></div>
</div>
<div class="clearfix">
        
    
@if (Auth::check())
<div class='form-group'>
    {!! Form::text('usermsg2','',['id'=>'usermsg2','size' => '63','maxlength'=>'256']) !!}
    {!! Form::submit('Отправить',['id'=>'submitmsg2']) !!}
</div>
@endif

   
</div>


<script type="text/javascript">
    $(document).ready(function(){  
var NscrollHeight = $('#game2chat').prop("scrollHeight") - 20;
$('#game2chat').animate({ scrollTop: NscrollHeight }, 'normal').one;
    WhoOnline();
    setTimeout(loadLog,5000);})
    
    
    
    $('#submitmsg2').click(function(){
  OtpravkaChat();
    })
    
    $('#usermsg2').keypress(function(event) {
    if (event.which == 13) {
        OtpravkaChat();
    }
});
    

function OtpravkaChat(){
    
var clientmsg = $('#usermsg2').val();
$('#usermsg2').val('');

     $.ajax({
            url:'sendmsg'
            , cache: false
            , data: {'usermsg2': clientmsg,'_token': $('meta[name="csrf-token"]').attr('content')}
            , type:'POST'
            , success: function() {
               
             setTimeout(loadLog,100); 
            },
            error : function(error){
                pr = error.responseText[0]+error.responseText[1];
                if (pr==50) $('#error2').text("Нельзя отправлять пустые сообщения");
                else if (pr==51) $('#error2').text("Слишком длинное сообщение");
            }
        })
    return false;
};









function nickname(elem){
	var s=document.getElementById('usermsg2').value;
	var t=elem;
	document.getElementById('usermsg2').value=s+t+", ";
        document.getElementById('usermsg2').focus();
}

function loadLog(){
    
var oldscrollHeight = $('#game2chat').prop("scrollHeight") - 20; //Scroll height before the request
 
 var s = $('#game2chat div:last-child span').text();
 var id = $('#game2chat div:last-child').attr('id');
 if (typeof id==='undefined')
     id = 'pusto';
 if (typeof s==='undefined')
     s = 'pusto';
$.ajax({
            url:'newmsg'
            , cache: false
            , data: {'s': s,'id': id,'_token': $('meta[name="csrf-token"]').attr('content')}
            , type:'POST'
            , success: function(data) {
                var event = JSON.parse(data, function(key, value) {
  if (key == 'created_at') return new Date(value);
  return value;});
  if (event[0].clear==1)
  {
       game2chat.innerHTML='';
  }
                for (var i = 0; i < event[0].count; i++) 
                { 
                var get = document.getElementById(event[i].id);
                if (get != null)
                {
                    break;                    
                }
                var newMsg = document.createElement('div');
                
 
                
                var formatter = new Intl.DateTimeFormat("fr", {
  hour: "numeric",
  minute: "numeric",
  second: "numeric"
});
            
                var time = formatter.format(event[i].created_at);
                var login = event[i].login;
                var message = event[i].message;
                var del = event[0].del;
                if (del===undefined)
                    del = '';
                
                if (login=='NULL')
            {
                newMsg.innerHTML = '<i>'+time+': <span>'+message+'</span>'+del+'</i>';
            }
            else
            {
                newMsg.innerHTML = time+' <b onclick=\'nickname("'+login+'")\'>'+login+'</b>: <span>'+message+'</span>'+del;
            }
                newMsg.className='msgln';
                newMsg.id=event[i].id;
               
                game2chat.appendChild(newMsg);
                
            var newscrollHeight = $('#game2chat').prop("scrollHeight") - 20; //Scroll height after the request
            if(newscrollHeight > oldscrollHeight){
            $('#game2chat').animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
            }   
                
                
                }          
            },
            error : function(error){
            }
        })
    WhoOnline();
    setTimeout(loadLog,5000);
    return false;
    
};



////Админ функции:

//Удаление:

function delmsg(idmsg){
var id = $(idmsg).parent().attr('id');
 var span = $(idmsg).parent();
    
    swal({
  title: "Вы хотите удалить это сообщение?",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Удалить",
  cancelButtonText: "Отмена",
  closeOnConfirm: true,
},
function(){
     $.ajax({
            url:'delmsg'
            , cache: false
            , data: {'id': id,'_token': $('meta[name="csrf-token"]').attr('content')}
            , type:'POST'
            , success: function(error) {
                span.detach();
                    
            },
            error : function(){
            }
        });
    
        });
   
}

 $('.delmsg2').click(function(){
 delmsg ($(this))
})





///Кто онлайн:

function WhoOnline(){


$.ajax({
            url:'chatonline'
            , cache: false
            , data: {'_token': $('meta[name="csrf-token"]').attr('content')}
            , type:'POST'
            , success: function(data) {
              
                var event = JSON.parse(data);
                onlinepolz.innerHTML='';
                for (var i = 0; i < event.length; i++) 
                {
                    var online = document.createElement('li');
                    var login = event[i].login;
                    online.innerHTML = login;
                    online.className ='polzonline';
                    online.setAttribute('onclick','nickname("'+event[i].login+'")');
                onlinepolz.appendChild(online);
                }          
            },
            error : function(error){
            }
        });
    }




</script> 