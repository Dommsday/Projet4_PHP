<?php
namespace App\Backend\Modules\Connexion;

use \framework\BackController;
use \framework\HTTPRequest;

class ConnexionController extends BackController{

	public function executeIndex(HTTPRequest $request){

		$this->page->addVarPage('title', 'Connexion');

		//Si le pseudo est rentré dans le formulaire
		if($request->postExists('login')){

			$login = $request->postData('login');
			$password = $request->postData('password');

			//Si les valeurs entrées sont identiques au fichiers de configuration 
			if($login == $this->app->config()->get('login') && $password == $this->app->config()->get('pwd')){

				$this->app->httpResponse()->redirect('.');

			}
		}
	}
}
