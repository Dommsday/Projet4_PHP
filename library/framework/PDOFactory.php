<?php

namespace frameworks;

class PDOFactory{

	public static function MysqlConnexion(){

		$db = new \PDO('mysql:host=localhost;dbname=blog_p4', 'root', '');
		$db->setAttribut(\PDO::ATR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $db;
	}
}
