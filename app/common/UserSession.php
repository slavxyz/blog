<?php
namespace App\Common;

class UserSession {
    
    const SESSION_LOGGED_IN = 'auth_logged_in';
    const SESSION_USER_ID = 'auth_user_id';
    const SESSION_USERNAME = 'auth_username';
    const SESSION_ROLE = 'auth_role';
    const SESSION_RESYNC = 'auth_resync';
    
    private  static $loginTimeDuration = 60 * 5;
    
    public static function setSessionLoggedIn($authLoggedIn)
    {
        $_SESSION[self::SESSION_LOGGED_IN] = $authLoggedIn;
    }
    
    public static function setSessionUserid($userId)
    {
        $_SESSION[self::SESSION_USER_ID] = $userId;
    }
    
    public static function setSessionUsername($username)
    {
        $_SESSION[self::SESSION_USERNAME] = $username;
    }
    
    public static function setSessionRole($role)
    {
        $_SESSION[self::SESSION_ROLE] = $role;
    }
    
    public static function setSessionResync($authResync)
    {
        $_SESSION[self::SESSION_RESYNC] = $authResync;
    }
    
    public static function getSessionLoggedIn()
    {
        return $_SESSION[self::SESSION_LOGGED_IN];
    }
    
    public static function getSessionUserid()
    {
        return $_SESSION[self::SESSION_USER_ID];
    }
    
    public static function getSessionUsername()
    {
        return $_SESSION[self::SESSION_USERNAME];
    }
    
    public static function getSessionRole()
    {
        return $_SESSION[self::SESSION_ROLE];
    }
    
    public static function getSessionResync()
    {
        return $_SESSION[self::SESSION_RESYNC];
    }
    
    public static function getLoginTimeDuration()
    {
        return self::$loginTimeDuration;
    }
    
    
}
