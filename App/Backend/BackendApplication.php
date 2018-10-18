<?php
namespace App\Backend;

use \framework\Application;

class BackendApplication extends Application{

	public function __construct(){

		parent::__construct();

		$this->name = 'Backend';
	}

	public function run(){

		$controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'index');
		$controller->execute();

		$this->httpResponse->setPage($controller->page());
		$this->httpResponse->send();
	}
}
