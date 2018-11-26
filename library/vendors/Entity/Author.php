<?php

namespace Entity;

use \framework\Entity;

class Author extends Entity{

	protected $id;
	protected $pseudo;
	protected $email;
	protected $password;
	protected $passwordConfirm;

	const PSEUDO_INVALIDE = 1;
	const EMAIL_INVALIDE = 2;
	const MDP_INVALIDE = 3;

	public function Valid(){

		return !(empty($this->pseudo) ||  empty($this->email) || empty($this->password) || empty($this->passwordConfirm));
	}

	public function setId($id){
		$id = (int) $id;

		if($id > 0){

			$this->id = $id;
		}
	}

	public function setPseudo($pseudo){

		if(!is_string($pseudo) || empty($pseudo)){

			$this->erreurs[] = self::PSEUDO_INVALIDE;
		}

		$this->pseudo = $pseudo;
	}

	

	public function setEmail($email){

		if(!is_string($email) || empty($email)){

			$this->erreurs[] = self::EMAIL_INVALIDE;
		}

		$this->email = $email;

	}

	public function setPassword($password){

		if(!is_string($password) || empty($password)){

			$this->erreurs[] = self::MDP_INVALIDE;
		}

		$this->password = $password;

	}

	public function setPasswordConfirm($passwordConfirm){

		if(!is_string($passwordConfirm) || empty($passwordConfirm)){

			$this->erreurs[] = self::MDP_INVALIDE;
		}

		$this->passwordConfirm = $passwordConfirm;

	}

	public function id(){
		return $this->id;
	}

	public function pseudo(){
		return $this->pseudo;
	}

	public function email(){
		return $this->email;
	}

	public function password(){
		return $this->password;
	}

	public function passwordConfirm(){
		return $this->passwordConfirm;
	}
}
