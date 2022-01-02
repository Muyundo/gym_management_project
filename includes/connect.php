<?php

class dbConfig{

	protected $serverName;
	protected $userName;
	protected $password;
	protected $dbName;

	function dbConfig(){
		$this -> serverName = 'localhost';
		$this -> userName = 'my_working';
		$this -> password = 'Brian1234';
		$this -> dbName = 'kimfitty';	

#Protected is to ensure that the methods daclared are cannot be accessed externally but can be inherited by child classes
	}

}
?>