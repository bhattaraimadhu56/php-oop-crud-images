<?php

class Database{
	
	protected $con;

	function __construct()
	{
		$this->connect_db();
	}

	public function connect_db(){
		$this->con = mysqli_connect('localhost', 'root', '', 'db_madhu_App');
		if(mysqli_connect_error()){
			die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_errno());
		}
	}

}



?>