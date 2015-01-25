@extends('user::layouts.master')

@section('head')
    @parent
    {{HTML::style('packages/qwerbit/assets/uikit/2.12.0/css/components/form-advanced.css')}}
    {{HTML::style('packages/qwerbit/user/css/form_center.css')}}
@stop

@section('content')
    <h2>{{Lang::get('user::reg.form_title')}}</h2>
    <p class='desc'>{{Lang::get('user::reg.form_desc')}}
    </p>        


    <div id="message"></div>
    
    <form id="form_login" action="{{URL::route('user.reg')}}" method="POST" class="uk-form" data-connector-view="user_form_view_ajax" data-ajax-loading=".container">
        
        <div class="uk-form-row">
            <label class="uk-form-label" >{{Lang::get('user::reg.form_login')}}</label>
            <div class="uk-form-controls">
                <input class="uk-width-1-1" type="text" name="email" value="{{{ $email }}}" autofocus/>
            </div>
        </div>
        
        <div class="uk-form-row">
            <input type="submit" value="{{Lang::get('user::reg.form_submit')}}" class="uk-width-1-1 uk-button uk-button-success"/>
        </div>
        
        <div class="uk-form-row remeber">
            <div class="l">
                <a href="{{URL::route('user.login')}}">{{Lang::get('user::reg.form_enter')}}</a>
            </div>
            <div class="r">
                <label class="cursor-pointer"><input type="checkbox" name="remember" value="1"> {{Lang::get('user::reg.form_remember')}}</label>
            </div>
        </div>
        
        <input type="hidden" name="ulogin_token" value="{{{ $ulogin_token }}}"/>
    </form>
    
@stop

@section('footer')
    @parent
    <script>
        $('#form_login').qForm({
            success_func: function(json) {
                document.location.href = '{{URL::route('user.profile')}}';
            }            
        });
    </script>
@stop    