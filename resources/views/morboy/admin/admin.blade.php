@extends('morboy.admin.app')

@section('content')

<div class="Admin">
<div class="leftAdmin">
    <div id="leftAdminZagolovok">МЕНЮ</div>
    <ul class="leftAdminMenu">
        <li><span>Морской бой</span>
            <ul class="leftAdminPodmenu">
                <li>
                    <a href='/admin/users'>Пользователи</a>
                </li>
                <li>
                    <a href='/admin/pole'>Создание поля</a>
                </li>
                <li>
                    <a href='/admin/frazy'>Добавление фраз для чата</a>
                </li>
            </ul>
        </li>
        
    </ul>
    
    
</div>



<div class="rightAdmin">
    <div class="rightAdminContent">
        @yield('adminContent')
    </div>
</div>
</div>
    


@include('errors.list')




@stop
