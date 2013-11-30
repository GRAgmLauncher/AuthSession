<?php

class DB
{
	public static function connect() {
		return new PDO('mysql:host=localhost;dbname=fakesite', 'fakesiteadmin', '');
	}
}

?>