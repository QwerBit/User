@extends('user::layouts.master')

@section('head')
    @parent
    {{HTML::style('packages/qwerbit/assets/uikit/2.12.0/css/components/form-advanced.css')}}
    {{HTML::style('packages/qwerbit/user/css/login.css')}}
@stop

@section('content')
    <h2>Профель пользователя</h2>
    
    <div id="message"></div>

    <div class="ulogin">
        <script src="//ulogin.ru/js/ulogin.js"></script>
        <div id="uLogin" data-ulogin="display=panel;fields=email;optional=phone,city,first_name,country,sex,nickname,bdate,last_name,photo,photo_big;providers=vkontakte,mailru,google,yandex;redirect_uri=http%3A%2F%2Flaravel.dev%2Fuser%2Flogin;callback=ulogin"></div>
    </div> 
    
@stop

@section('footer')
    @parent
    {{HTML::script('packages/qwerbit/user/js/ulogin.js')}}
@stop    