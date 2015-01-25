@if (Auth::check())
<div class="auth">
    <span class="first">
        <img src="/img/auth/avatar.png"/>
        <a href="{{URL::route('user.profile')}}">Личный кабинет</a>
    </span>
    <span>
        <img src="/img/auth/reg.png"/>
        <a href="{{URL::route('user.logout')}}">Выход</a>
    </span>	
</div>
@else
<div class="auth">
    <span class="first">
        <img src="/img/auth/enter.png"/>
        <a href="{{URL::route('user.login')}}">Вход</a>
    </span>
    <span>
        <img src="/img/auth/reg.png"/>
        <a href="{{URL::route('user.reg')}}">Регистрация</a>
    </span>	
</div>
@endif