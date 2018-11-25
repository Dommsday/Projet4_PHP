<?php

namespace framework;

abstract class AuthorConnexionBuilder{

	protected $authorconnexionform;

	public function __construct(Entity $entity){

		$this->setAuthorConnexionForm(new Form($entity));
	}

	abstract public function build();

	public function setAuthorConnexionForm(Form $authorconnexionform){

		$this->authorconnexionform = $authorconnexionform;
	}

	public function authorconnexionform(){
		return $this->authorconnexionform;
	}
}