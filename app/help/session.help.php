<?php
class help_session extends help
{
	static public $start_tag=false;

	public static function start()
	{
		if(self::$start_tag === false){
			session_start();
			self::$start_tag = true;
		}
		
	}

	public static function destroy()
	{
		session_destroy();
		self::$start_tag = false;
	}

    public static function set($key, $value)
    {
		$_SESSION[$key] = $value;
    }

    public static function get($key )
    {
		$result = empty($_SESSION[$key])?"":$_SESSION[$key];
		return $result;
    
    }

	public static function set_token($string)
	{
		$now = microtime();
		$md5 = md5($string.$now);
		self::set('token', $md5);
		return $md5;
	}
}

?>
