<?php
namespace framework;

session_start();

$_SESSION['nom'] = "Jean Forteroche";

class User{

	public function getAttribute($attr){

		return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
	}

	public function getMessage(){

		$message = $_SESSION['message'];
		unset($_SESSION['message']);

		return $message;
	}

	public function hasMessage(){

		return isset($_SESSION['message']);
	}

	public function isAuthenticated(){

		return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
	}

	public function setAttribute($attr, $value){

		$_SESSION[$attr] = $value;
	}

	public function setAuthenticated($authenticated = true){

		if (!is_bool($authenticated)){

			throw new \InvalidAugumentException('La valeur spécifié à la méthode User::setAuthenticated doit être un boolean');
		}

		$_SESSION['auth'] = $authenticated;
	}

	public function setMessage($value){

		$_SESSION['message'] = $value;
	}
}
