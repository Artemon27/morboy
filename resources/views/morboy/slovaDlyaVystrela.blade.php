 <table id="slovaDlyaVystrela"> 
                
    <tr>
    {!! Form::open(['url' => 'slovaDlyaVystrela']) !!}
    
    <td>{!!Form::select('sobytie', array('m' => 'Мимо', '1' => '1', '2' => '2', '3' => '3',
        '4' => '4', '5' => '5', 'k' => 'Клад', 'b' => 'Бомба'))!!}</td>
    <td>
        {!! Form::label('msg', 'Сообщение:',['class'=>'labelMsgDlyaVystrela']) !!}
        {!! Form::textarea('msg','',['class'=>'msgDlyaVystrela']) !!}</td>
      
       <td>{!! Form::submit('Добавить',['class'=>'btn btn-polz ','name'=>'anew']) !!}</td>
        
    {!! Form::close() !!}
    
    </tr>
    
               </table>