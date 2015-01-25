@extends('user::layouts.master')

@section('head')
    @parent
    {{HTML::style('packages/qwerbit/assets/uikit/2.12.0/css/components/form-advanced.css')}}
    {{HTML::style('packages/qwerbit/user/css/form_center.css')}}
@stop

@section('content')
    <h2>{{Lang::get('user::login.form_title')}}</h2>
    
    <p class='desc'>{{Lang::get('user::login.form_desc')}}</p>
    
    <div id="message"></div>
    
    <form id="form_login" action="" method="POST" class="uk-form">
        
        <div class="uk-form-row">
            <label class="uk-form-label">{{Lang::get('user::login.form_login')}}</label>
            <div class="uk-form-controls">
                <input class="uk-width-1-1" type="text" name="email" value="" autofocus/>
            </div>
        </div>
        
        <div class="uk-form-row">
            <label class="uk-form-label">{{Lang::get('user::login.form_password')}}</label>
            <div class="uk-form-controls">
                <input class="uk-width-1-1" type="password" name="password" value=""/>
            </div>
        </div>
        
        <div class="uk-form-row remeber">
            <div class="l">
                <a href="/user/forgot">{{Lang::get('user::login.form_remember_password')}}</a>
            </div>
            <div class="r">
                <label class="cursor-pointer"><input type="checkbox" name="remember" value="1"> {{Lang::get('user::login.form_remember')}}</label>
            </div>
        </div>
        
        <div class="uk-form-row">
            <input type="submit" value="{{Lang::get('user::login.form_submit')}}" class="uk-width-1-1 uk-button uk-button-success"/>
        </div>
        
        <div class="uk-form-row">
            <a class="uk-width-1-1 uk-button uk-button-default" href="{{URL::route('user.reg')}}">{{Lang::get('user::login.form_reg')}}</a>
        </div>
        
    </form>
    
    <div class="ulogin">
        <script src="//ulogin.ru/js/ulogin.js"></script>
        <div id="uLogin" data-ulogin="display=panel;fields=email;optional=phone,city,first_name,country,sex,nickname,bdate,last_name,photo,photo_big;providers=vkontakte,mailru,google,yandex;redirect_uri=http%3A%2F%2Flaravel.dev%2Fuser%2Flogin;callback=ulogin"></div>
    </div> 
    
@stop

@section('footer')
    @parent
    
    <script>
        $('#form_login').qForm({
            success_func: function() {
                document.location.href = '{{URL::route('user.profile')}}';
            },
            loader_container: '#form_login',
            loader_func_set: 'loader_find_all_set',
            loader_func_remove: 'loader_find_all_remove',
        });
    </script>
    {{HTML::script('packages/qwerbit/user/js/ulogin.js')}}
@stop    