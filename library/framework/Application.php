<?php

namespace framework;

abstract class Application{

	protected $httpRequest;
	protected $httpResponse;
	protected $name;

	public function __construct(){
		$this->httpRequest = new HTPPRequest;
		$this->httpResponse = new HTTPResponse;
		$this->name = '';
	}

	//Méthode qui doit être réécrite chez l'enfant
	abstract public function run();

	public function httpRequest(){
		return $this->httpRequest;
	}

	public function httpResponse(){
		return $this->httpResponse;
	}

	public function name(){
		return $this->name;
	}
}
