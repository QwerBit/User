<?php

namespace Qwerbit\User\Models;

use Controller,
    Auth,
    Hash;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

// implements UserInterface, RemindableInterface
class User extends Ardent implements UserInterface, RemindableInterface
{

    use UserTrait,
        RemindableTrait;

    /*
      public static $rules = array(
      //'username' => 'required|between:4,16',
      //'email' => 'email|unique:users',
      //'password' => 'alpha_num|min:6|confirmed',
      //'password_confirmation' => 'alpha_num|min:6',
      );

      public $autoPurgeRedundantAttributes = true;
     */

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * Получить уникальный идентификатор пользователя.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Получить пароль пользователя.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Получить адрес e-mail для отправки напоминания о пароле.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function roles()
    {
        return $this->hasMany( 'Role' );
    }

    /**
     *
     * @return void
     */
    public function addRoles($role)
    {
        if (!is_array( $role ))
        {
            $roles = array();
            $roles[] = $role;
        }
        else
        {
            $roles = $role;
        }
        foreach ($roles as $val)
        {

            $issetRole = Role::where( 'user_id', '=', $this->id )
                    ->where( 'name', '=', $val )
                    ->take( 1 )
                    ->get();

            if (!sizeof( $issetRole ))
            {
                $obj = new Role();
                $obj->user_id = $this->id;
                $obj->name = $val;
                $obj->save();
            }
        }
    }

    /**
     *
     * @return void
     */
    public function removeRoles($role)
    {
        if (!is_array( $role ))
        {
            $roles = array();
            $roles[] = $role;
        }
        else
        {
            $roles = $role;
        }

        $obj = $this->roles;
        if (sizeof( $obj ))
        {
            foreach ($obj as $val)
            {
                if (in_array( $val->name, $roles ))
                    $val->delete();
            }
        }
    }

    public function issetRole($role)
    {
        $issetRole = Role::where( 'user_id', '=', $this->id )
                ->where( 'name', '=', $role )
                ->take( 1 )
                ->get();

        if (sizeof( $issetRole ))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function setPassword($password)
    {
        if ($password)
        {
            $this->password = Hash::make( $password );
        }
    }

    public static function auth($where, $remember = false)
    {
        $where['active'] = true;
        $user = User::where( $where )->first();
        if ($user)
        {
            Auth::loginUsingId( $user->id, $remember );
            return Auth::user();
        }
        else
        {
            return null;
        }
    }

    public function Ulogin()
    {
        return $this->hasMany( 'Qwerbit\User\Models\Ulogin' );
    }

}
