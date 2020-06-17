<?php

class Db {
	private static $instance = null;
	private $connection;

	protected function __construct(){
		$this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		if(mysqli_connect_error()){
			throw new ErrorException("Could not connect to DB.");
		}
	}


	public static function getInstance() : Db {
		if(static::$instance === null){
			static::$instance = new static();
		}
		return static::$instance;
	}

	public function getConnection(){
		return $this->connection;
	}

	protected function __clone(){}

	public function __wakeup(){}
}