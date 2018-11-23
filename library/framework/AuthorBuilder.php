<?php

namespace framework;

abstract class AuthorBuilder{

	protected $authorform;

	public function __construct(Entity $entity){

		$this->setAuthorForm(new Form($entity));
	}

	abstract public function build();

	public function setAuthorForm(Form $authorform){

		$this->authorform = $authorform;
	}

	public function authorform(){
		return $this->authorform;
	}
}