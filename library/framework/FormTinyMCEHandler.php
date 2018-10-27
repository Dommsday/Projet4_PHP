<?php

namespace framework;

class FormTinyMCEHandler{

	protected $tinymce;
	protected $manager;
	protected $request;

	public function __construct(Form $tinymce, Manager $manager, HTTPRequest $request){

		$this->setTinymce($tinymce);
		$this->setManager($manager);
		$this->setRequest($request);
	}

	public function process(){

		if($this->request->method() == 'POST' && $this->tinymce->Valid()){

			$this->manager->save($this->tinymce->entity());

			return true;
		}

		return false;
	}

	public function setTinymce(Form $tinymce){

		$this->tinymce = $tinymce;
	}

	public function setManager(Manager $manager){

		$this->manager = $manager;
	}

	public function setRequest(HTTPRequest $request){

		$this->request = $request;
	}
}