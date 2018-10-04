<?php

namespace framework;

class HTPPRequest extends Component{

	//Obtenir un cookie
	public function cookieData($key){
		return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
	}

	//Vérifie si le cookie existe
	public function cookieExists($key){
		return isset($_COOKIE[$key]);
	}

	//Obtenir la variable GET
	public function getData($key){
		return isset($_GET[$key]) ? $_GET[$key] : null;
	}

	//Vérifie si la variable GET existe
	public function getExists($key){
		return isset($_GET[$key]);
	}

	//Obtenir la variable POST
	public function postData($key){
		return isset($_POST[$key]) ? $_POST[$key] : null;
	}

	//Vérifie si la variable POST existe
	public function postExists($key){
		return isset($_POST[$key]);
	}

	//Obtenir la méthode utilisé GET ou POST
	public function method(){
		return $_SERVER['REQUEST_METHOD'];
	}

	//Obtenir l'URL
	public function requestURI(){
		return $_SERVER['REQUEST_URI'];
	}
}
