<?php
namespace Qwerbit\User\Controllers;

use Qwerbit\User\Models\User;
use Qwerbit\User\Models\Ulogin;

use View,
    Auth,
    Input,
    Validator,
    Redirect,
    Lang,
    Response,
    URL,
    Mail;
	

class UserController extends \Qwerbit\User\Controller 
{

    /**
     * Название пакету
     *
     * @return string
     */
    public $pkName = 'user';
    
    /**
     * Канструктор в нем определены фильтры
     *
     * @return string
     */
    public function __construct()
    {
        $this->beforeFilter('user.auth',[
            'except' => [
                'getLogin',
                'postLogin',
                'getReg',
                'postReg',
                'getUlogin',
                'postUlogin'
            ]
        ]);
        
        $this->beforeFilter('user.is_auth',[ 
            'only' => [
                'getLogin',
                'postLogin',
                'getReg',
                'postReg',
                'getUlogin'
            ]
        ]);
    }
    
    /**
     * Абстракция на view::make при необходимости можно переопределить
     * 
     * @param  string  $name название шаблона
     * @param  array   $item содержимое шаблона
     * 
     * @return string
     */
    public function view($name, $item = []) 
    {
        return View::make($name, $item);
    }
    /**
     * Абстракция для view::make при необходимости можно переопределить
     * 
     * @param string $email логин пользователя
     * @param string $password пароль
     * @param bool $remember запомнить пользователя
     * 
     * @return User|null
     */
    public function auth ($email,$password,$remember = false) 
    {
        Auth::attempt([
            'email' => $email, 
            'password' => $password,
            'active' => true,
        ],$remember);
    }
   
    /**
     * Выводит страницу авторизации
     * 
     * @return string
     */
    public function getLogin() 
    { 
        return $this->view('user::tpl.login');
    }
    
    /**
     * Абробатывает пост запрос на авторизацию
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function postLogin() 
    {
        $validator = Validator::make(
            [
                'email'     => Input::get('email'),
                'password'  => Input::get('password'),
            ],[
                'email'     => 'required|email',
                'password'  => 'required',
            ],[
                'password.required' => Lang::get('user::validator.password_required'),
                'email.required'    => Lang::get('user::validator.email_required_reg'),
                'email.email'       => Lang::get('user::validator.email_format')
            ]
        );

        if ($validator->fails()) 
        {
            return $this->responseJsonErrorFailed(false, $validator->messages()->toArray());
        }
        
        if ( $this->auth( Input::get('email'), Input::get('password'), Input::get('remember') ) )
        {
            return  $this->responseJsonMessage(true);
        } 
        else 
        {
            return $this->responseJsonMessage(false, Lang::get('user::login.is_no_user'));
        }
    }
    
    /**
     * 
     * @return void
     */
    public function anyLogout() {
        Auth::logout();
        return Redirect::to(Input::get('redirect','/'));
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return string
     */
    public function getReg($ulogin_token = null) {
        if ($ulogin_token) {
            $token = Ulogin::getToken($ulogin_token);
            $ulogin = Ulogin::getUserFromToken($token);
            if ($ulogin)
            {
                if ($ulogin->User)
                {
                    User::auth( ['id' => $ulogin->user->id] ,Input::get('remember'));;
                    return Redirect::to(URL::route('user.profile'));
                }
            }
        }
        
        $r['email'] = (isset($token['email'])) ? $token['email'] : null;
        $r['ulogin_token'] = (isset($ulogin_token)) ? $ulogin_token : null;

        return $this->view('user::tpl.reg', [
            'email' => $r['email'],
            'ulogin_token' => $r['ulogin_token']
        ]);
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return string
     */
    public function postReg() {
        $message = [];
        
        $validator = Validator::make(
            [
                'email' => Input::get('email'),
                'password' => Input::get('password'),
            ],[
                'email' => 'required|email',
                'password' => 'confirmed'
            ],[
                'required' => Lang::get('user::validator.email_required_reg'),
                'email' => Lang::get('user::validator.email_format'),
                'password.confirmed' => Lang::get('user::validator.password_confirmed'),
            ]
        );

        if ($validator->fails()) 
        {
            return $this->responseJsonErrorFailed(false, $validator->messages()->toArray());
        }
        
        /*
         * Проверка существования пользователя
         */
        if (User::where(['email'=>Input::get('email')])->first())
        {
            return $this->responseJsonErrorFailed( false, ['email'=>Lang::get('user::reg.isset_user')]);
        }
        
        $user = new User();
        $password = (Input::get( 'password' )) ? Input::get( 'password' ) : rand( 1000, 9999 );

        $user->email = Input::get( 'email' );
        $user->setPassword( $password );
        $user->active = true;
        
        if ($user->save())
        {
            User::auth( ['id' => $user->id] ,Input::get('remember'));
   
            if (Input::get( 'ulogin_token' ))
            {
                $ulogin = Ulogin::getUserFromToken( Input::get( 'ulogin_token' ) );
            }
            return $this->responseJsonMessage( true );
        }
        return $this->responseJsonMessage(false,'error');
    }
    
    /**
     * Setup the layout used by the controller.
     *
     * @return string
     */
    public function postUlogin() {
        
        if (Auth::check())
        {
            if (Ulogin::getUserFromToken(Input::get('token')))
            {
                return $this->responseJsonMessage(true,'Add servece','success');
            }
            else
            {
                return $this->responseJsonMessage(false,'Error');
            }
        }
        
        $user = Ulogin::getUserFromToken(Input::get('token'));
        if ($user)
        {
            User::auth( ['id' => $user->id] ,Input::get('remember'));
            return Response::json( ['redirect'=>URL::route('user.profile')] );
        }
        else
        {
            return Response::json( ['redirect'=>URL::route('user.reg',['ulogin_token'=>Input::get('token')])] );;
        }
    }
    
    public function getProfile() {
        return $this->view('user::tpl.profile');
    }
}
