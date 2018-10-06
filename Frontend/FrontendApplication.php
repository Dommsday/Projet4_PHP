<?php

namespace Frontend;

class FrontendApplication extends Application{

	public function __construct(){

		parent::__construct();
	}

	public function run(){

		$controller = $this->getController();
		$controller->execute();

		$this->httpResponse->setPage($controller->page());
		$this->httpResponse->send();
	}

	
}
