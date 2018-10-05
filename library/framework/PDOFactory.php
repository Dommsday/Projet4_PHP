<?php

namespace frameworks;

class PDOFactory{

	protected $mysql = 'mysql:host=localhost; dbname=blog_p4';
	protected $user = 'root';
	protected $mdp = ' ';

	public static function mysqlConnexion(){

		$db = new \PDO($this->mysql, $this->user, $this->mdp);
		$db->setAttribut(\PDO::ATR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $db;
	}
}
