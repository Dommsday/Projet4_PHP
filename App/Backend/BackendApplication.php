<?php
namespace App\Backend;

use \framework\Application;

class BackendApplication extends Application{

	public function __construct(){

		parent::__construct();

		$this->name = 'Backend';
	}

	public function run(){

        if($this->user->isAuthenticated()){
            
            $controller = $this->getController();
            
        }else{
            
            $controller = new Modules\News\NewsController($this, 'News', 'connexion');
            
        }
		
		$controller->execute();

		$this->httpResponse->setPage($controller->page());
		$this->httpResponse->send();
	}
}
