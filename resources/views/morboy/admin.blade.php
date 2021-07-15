@extends('app')

@section('content')


  <style>
               
        .tabs {
            min-width: 320px;
            max-width: 800px;
            padding: 0px;
            margin: 0 auto;
        }
        
        .tabs > section {
            display: none;
            padding: 15px;
            background: #fff;
            border: 1px solid #ddd;
        }
        
        .tabs > section > p {
            margin: 0 0 5px;
            line-height: 1.5;
            color: #383838;
            
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
            -webkit-animation-name: fadeIn;
            animation-name: fadeIn;
        }
        @-webkit-keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        /* Прячем чекбоксы */
        
        .tabs > input {
            display: none;
            position: absolute;
        }
        /* Стили переключателей вкладок (табов) */
        
        .tabs > label {
            display: inline-block;
            margin: 0 0 -1px;
            padding: 15px 25px;
            font-weight: 600;
            text-align: center;
            color: #aaa;
            border: 0px solid #ddd;
            border-width: 1px 1px 1px 1px;
            background: #f1f1f1;
            border-radius: 3px 3px 0 0;
        }
        
        
        
        /* Изменения стиля переключателей вкладок при наведении */
        
        .tabs > label:hover {
            color: #888;
            cursor: pointer;
        }
        /* Стили для активной вкладки */
        
        .tabs > input:checked + label {
            color: #555;
            border-top: 1px solid #009933;
            border-bottom: 1px solid #fff;
            background: #fff;
        }
        /* Активация секций с помощью псевдокласса :checked */
        
        #tab1:checked ~ #polzovat,
        #tab2:checked ~ #pole,
        #tab3:checked ~ #words,
        #tab4:checked ~ #admins{
            display: block;
        }
       
    </style>

    <div class="container">
        <div class="tabs">
            <input id="tab1" type="radio" name="tabs" checked>
            <label for="tab1" title="Polzovat">Пользователи</label>
            <input id="tab2" type="radio" name="tabs">
            <label for="tab2" title="Pole">Создание поля</label>
            <input id="tab3" type="radio" name="tabs">
            <label for="tab3" title="Words">Слова для чата</label>
            <input id="tab4" type="radio" name="tabs">
            <label for="tab4" title="Admin">Админы</label>
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
            
            
            
            <section id="pole">
          
                <div class="clearfix">

@include('morboy.SozdaniePole')

</div>
                    
                
            </section>
            
            <section id="words">
          
                <div class="clearfix">

@include('morboy.slovaDlyaVystrela')

</div>
                    
                
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

    
    


@include('errors.list')




@stop

    
    
    
