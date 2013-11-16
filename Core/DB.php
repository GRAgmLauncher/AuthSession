<?php

class DB
{
	public static $connection; 
	
	public static function connect()
	{
		if (self::$connection)
		{
			return self::$connection;
		}
		
		self::$connection = new PDO('mysql:host=localhost;dbname=fakesite', 'fakesiteadmin', '');
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		return self::$connection;
	}
}

?>