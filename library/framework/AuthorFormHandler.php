<?php

namespace framework;

class AuthorFormHandler{

	protected $authorform;
	protected $manager;
	protected $request;

	public function __construct(Form $authorform, Manager $manager, HTTPRequest $request){

		$this->setAuthorForm($authorform);
		$this->setManager($manager);
		$this->setRequest($request);
	}

	public function process(){

		if($this->request->method() == 'POST' && $this->authorform->Valid()){

			$this->manager->save($this->authorform->entity());

			return true;
		}

		return false;
	}

	public function setAuthorForm(Form $authorform){

		$this->authorform = $authorform;
	}

	public function setManager(Manager $manager){

		$this->manager = $manager;
	}

	public function setRequest(HTTPRequest $request){

		$this->request = $request;
	}
}