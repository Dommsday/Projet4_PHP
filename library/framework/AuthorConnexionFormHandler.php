<?php

namespace framework;

class AuthorConnexionFormHandler{

	protected $authorconnexionform;
	protected $manager;
	protected $request;

	public function __construct(Form $authorconnexionform, Manager $manager, HTTPRequest $request){

		$this->setAuthorForm($authorconnexionform);
		$this->setManager($manager);
		$this->setRequest($request);
	}

	public function process(){

		if($this->request->method() == 'POST' && $this->authorconnexionform->Valid()){

			
			return true;
		}
		
		
		return false;

	}

	public function setAuthorForm(Form $authorconnexionform){

		$this->authorconnexionform = $authorconnexionform;
	}

	public function setManager(Manager $manager){

		$this->manager = $manager;
	}

	public function setRequest(HTTPRequest $request){

		$this->request = $request;
	}
}