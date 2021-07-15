@extends('morboy.admin.admin')

@section('adminContent')




    <div class="container">
        <div class="tabs">
            <input id="tab1" type="radio" name="tabs" checked>
            <label for="tab1" title="Polzovat">Пользователи</label>
            <input id="tab2" type="radio" name="tabs">
            <label for="tab2" title="Admin">Админы</label>
            <section id="polzovat">
       
                 <table id="odobrenie">
                @foreach ($users as $user)
<gamer>
    <tr>
    {!! Form::open(['url' => 'admins3']) !!}
    
       <td><span class='apolzn'>{{$user->id}}.</span></td>
       <td><span class='apolz'>{{$user->name}}</span></td>
        {!!Form::hidden('id', $user->id)!!}
       <td>{!! Form::checkbox('dostup', 1, $user->usersStat->dostup)!!}</td>
       <td>{!! Form::submit('Обновить',['class'=>'btn btn-polz ','name'=>'anew']) !!}</td>
        
    {!! Form::close() !!}
</tr>
</gamer>
                
@endforeach         
</table>
                
                </section>
            
            
            
            
            
            <section id="admins">
           
               <table id="odobrenie"> 
                
             @foreach ($users as $user)
<user>
    <tr>
    {!! Form::open(['url' => 'admins2']) !!}
    
    <td><span class='apolzn'>{{$user->id}}.</span></td>
       <td><span class='apolz'>{{$user->name}}</span></td>
        {!!Form::hidden('id', $user->id)!!}
       <td>{!!Form::select('zvanie', array('admin' => 'admin', 'user' => 'user'), $user->zvanie)!!}</td>
       <td>{!! Form::submit('Обновить',['class'=>'btn btn-polz ','name'=>'anew']) !!}</td>
        
    {!! Form::close() !!}
    
    </tr>
</user>
    @endforeach
    
               </table>
    
            </section>
            
            
            
        </div>

    
    
        <div>Приветик</div><div>Приветик</div><div>Приветик</div><div>Приветик</div><div>Приветик</div>
        <div>Приветик</div><div>Приветик</div><div>Приветик</div><div>Приветик</div><div>Приветик</div>
        <div>Приветик</div><div>Приветик</div><div>Приветик</div><div>Приветик</div><div>Приветик</div>
        <div>Приветик</div><div>Приветик</div><div>Приветик</div><div>Приветик</div><div>Приветик</div>
        <div>Приветик</div><div>Приветик</div><div>Приветик</div><div>Приветик</div><div>Приветик</div>
        <div>Приветик</div><div>Приветик</div><div>Приветик</div><div>Приветик</div><div>Приветик</div>
        <div>Приветик</div><div>Приветик</div><div>Приветик</div><div>Приветик</div><div>Приветик</div>
        <div>Приветик</div><div>Приветик</div><div>Приветик</div><div>Приветик</div><div>Приветик</div>
        

@include('errors.list')




@stop

    
    
    
