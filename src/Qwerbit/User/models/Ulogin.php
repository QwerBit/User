<?php

namespace Qwerbit\User\Models;

use Controller,
    Request,
    Auth,
    Input;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

// implements UserInterface, RemindableInterface
class Ulogin extends Ardent implements UserInterface, RemindableInterface
{

    use UserTrait,
        RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ulogins';
    protected $fillable = array(
        "first_name",
        "last_name",
        "email",
        "nickname",
        "bdate",
        "sex",
        "phone",
        "photo",
        "photo_big",
        "city",
        "country",
        "network",
        "profile",
        "uid",
        "identity",
        "manual",
        "verified_email"
    );

    /**
     *
     * @var array
     */
    protected $hidden = array();

    public function User()
    {
        return $this->belongsTo( 'User' );
    }

    /**
     * 
     * @param string $token принимает номер токина в системе Ulogin.ru 
     * @return User|null
     */
    public static function getService($token)
    {
        if ( !is_array( $token ))
        {
            $token = self::getToken( $token );
        }
        if ( is_array( $token ) and !isset($token['error']) )
        {
            $ulogin = Ulogin::where( ['identity' => $token['identity']] )->first();
            
            if ($ulogin)
            {
                return $ulogin;
            }
            else
            {
                return new Ulogin( $token );
            }
        }
        return null;
    }

    /**
     * Получения знгачения token
     * реализовано с помощью http://ulogin.ru
     * 
     * @param string $token токен пользователя
     * @return array
     */
    public static function getToken($token)
    {
        $s = file_get_contents( 'http://ulogin.ru/token.php?token=' . $token . '&host=' . Request::server( 'HTTP_HOST' ) );
        return json_decode( $s, true );
    }
    /**
     * 
     * @param type $token
     * @return boolean | User
     */
    public static function getUserFromToken($token)
    {
        $ulogin = self::getService( $token );
        if (!$ulogin)
        {
            return false;
        }

        if (Auth::check() and $ulogin)
        {
            if ($ulogin->user_id != Auth::user()->id)
            {    
                $ulogin->user_id = Auth::user()->id;
                Auth::user()->Ulogin()->save( $ulogin );
            }
            return Auth::user();
        }
        else
        {
            if ($ulogin->User)
            {
                return $ulogin->User;
            }
        }
        
        return self::createUser($ulogin);
    }
    /**
     * 
     * @param \Qwerbit\User\Models\Ulogin $ulogin
     * @return boolean | Ulogin
     */
    static public function createUser(Ulogin $ulogin)
    {
        if (User::where( ['email' => $ulogin->email ] )->first())
        {
            return false;
        }
        $user = new User();

        if ($ulogin->first_name)
        {
            $user->firstname = $ulogin->first_name;
        }
        if ($ulogin->last_name)
        {
            $user->lastname = $ulogin->last_name;
        }
        $user->email = $ulogin->email;
        $user->setPassword( rand( 1000, 9999 ) );
        $user->active = true;
        $user->save();
        
        if ($user->Ulogin()->save( $ulogin ))
        {
            return $ulogin->user;
        }
        return false;
    }

}
