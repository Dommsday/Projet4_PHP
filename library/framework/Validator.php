<?php

namespace framework;

abstract class Validator{

	protected $errorMessage;

	public function __construct($errorMessage){

		$this->setErrorMessage($errorMessage);
	}

	abstract public function Valid($value);

	public function setErrorMessage($errorMessage){

		if(is_string($errorMessage)){

			$this->errorMessage = $errorMessage;
		}
	}

	public function errorMessage(){

		return $this->errorMessage;
	}
}
