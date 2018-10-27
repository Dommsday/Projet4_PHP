<?php

namespace framework;

abstract class TinyMCEBuilder{

	protected $tinymce;

	public function __construct(Entity $entity){

		$this->setTinymce(new Form($entity));
	}

	abstract public function build();

	public function setTinymce(Form $tinymce){

		$this->tinymce = $tinymce;
	}

	public function tinymce(){
		return $this->tinymce;
	}
}
