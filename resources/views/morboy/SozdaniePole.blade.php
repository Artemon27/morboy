<div id="create-pole">
    
    {!! Form::open(['url' => 'admins']) !!}
<div class="clearfix">
<div class='form-group-create'>
    {!! Form::label('kol1', 'Количество 1:') !!}
    {!! Form::text('kol1',70,['class'=>'form-control2']) !!}
</div>
<div class='form-group-create'>
    {!! Form::label('kol2', 'Количество 2:') !!}
    {!! Form::text('kol2',30,['class'=>'form-control2']) !!}
</div>
<div class='form-group-create'>
    {!! Form::label('kol3', 'Количество 3:') !!}
    {!! Form::text('kol3',15,['class'=>'form-control2']) !!}
</div>
<div class='form-group-create'>
    {!! Form::label('kol4', 'Количество 4:') !!}
    {!! Form::text('kol4',8,['class'=>'form-control2']) !!}
</div>
<div class='form-group-create'>
    {!! Form::label('kol5', 'Количество 5:') !!}
    {!! Form::text('kol5',4,['class'=>'form-control2']) !!}
</div>
</div>
    <div class="clearfix">
<div class='form-group-create'>
    {!! Form::label('kolb', 'Количество бомб:') !!}
    {!! Form::text('kolb',2,['class'=>'form-control2']) !!}
</div>
<div class='form-group-create'>
    {!! Form::label('kolk', 'Количество клада:') !!}
    {!! Form::text('kolk',2,['class'=>'form-control2']) !!}
</div>
    </div>
    <div class="clearfix">
<div class='form-group-create'>
    {!! Form::label('n', 'ширина:') !!}
    {!! Form::text('n',15,['class'=>'form-control2']) !!}
</div>
<div class='form-group-create'>
    {!! Form::label('m', 'высота:') !!}
    {!! Form::text('m',15,['class'=>'form-control2']) !!}
</div>
</div>
<div class='form-group-variant'>
    <div>Вариант игры:</div>
    {!! Form::label('var', 'До трёх мимо:') !!}
    {!! Form::radio('var', '1', true); !!}
    {!! Form::label('var2', 'Три хода в день') !!}
    {!! Form::radio('var', '0', false,array('id'=>'var2')); !!}
</div>
    
<div class='form-group'>
    <label for="sozd1" id='pre-sozd-pole' class="btn btn-create-pole">Создать</label>
    <input type="checkbox" id="sozd1"  name="createpole" >
    

    
    <section id="sozdanie2">
     {!! Form::submit('Подтвердить',['class'=>'btn btn-create-pole','id'=>'creatpol']) !!}
     <label for="sozd1" id='cancel-sozd-pole' class="btn btn-create-pole">Отменить</label>

    </section>
    </div>    
{!! Form::close() !!}

</div>
