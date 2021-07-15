@extends('app')

@section('content')

{!! Form::open(['url' => 'mafka/create']) !!}
    
      {!! Form::submit('Создать',['class'=>'btn btn-polz ','name'=>'anew']) !!}
        
 {!! Form::close() !!}
@if (isset($partias))
@foreach ($partias as $partia)

<a href='mafka/game/{{$partia->id}}'>Партия {{$partia->id}}</a>

@endforeach
@endif

@include('errors.list')




@stop

    