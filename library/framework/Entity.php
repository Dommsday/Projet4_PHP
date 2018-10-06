<?php

namespace framework;

//Utilisation de l'interface ArrayAccess
abstract class Entity implements \ArrayAccess{

	protected $erreurs = [];
	protected $id;

	public function __construct(array $donnees = []){

		if(!empty($donnees)){

			$this->hydrate($donnees);
		}
	}

	public function hydrate(array $donnees){

		foreach ($donnees as $attribut => $value){
			
			$method = 'set'.ucfirst($attribut);

			if(is_callable([$this, $method])){

				$this->$method($value);
			}
		}
	}

	public function idNew(){

		return empty($this->id);
	}

	public function erreurs(){

		return $this->erreurs;
	}

	public function id(){
		return $this->id;
	}

	public function setId($id){
		$this->id (int) $id;
	}

	public function offsetExists($var){
		return isset($this->$var) && is_callable($this, $var);
	}

	public function offsetGet($var){

		if(isset($this->$var) $$ is_callable([$this, $var])){
			return $this->$var();
		}
	}

	public function offsetSet($var, $value){
		$method = 'set'.ucfirst($var);

		if(is_callable([$this, $method]) && isset($this->$var)){
			$this->$method($value);
		}
	}

	public function offsetUnset($var){
		throw new \Exception('Impossible la valeur');
	}
}
