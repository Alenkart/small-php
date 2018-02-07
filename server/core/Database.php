<?php

include './../config/database.php';

class Database {

	public $conn;

	private $dsn = $database_config['DB_DSN'];
	private $db = $database_config['DB_DATABASE'];
	private $host = $database_config['DB_HOST'];
	private $user = $database_config['DB_USERNAME'];
	private $password = $database_config['DB_PASSWORD'];

	private $options = [
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	];

	public function connect() {

		$this->dsn = "mysql:dbname=$this->db;host=$this->host";

		try {

		    $this->conn = new PDO(
		    	$this->dsn, 
		    	$this->user, 
		    	$this->password,
		    	$this->options
		    );

		} catch (PDOException $e) {
		    echo 'Connection failed: ' . $e->getMessage();
		}
	}
}

