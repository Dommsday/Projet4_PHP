<?php

namespace framework;

class HTTPResponse extends Component{

	protected $page;

	//Assigne une page
	public function setPage(Page $page){
		$this->page = $page;
	}

	//Envoi de le page
	public function send(){
		exit($this->page->getGeneratedPage());
	}

	//Redirige l'utilisateur
	public function redirect($location){
		header('Location'.$location);
	}

	//En cas d'erreur l'utilisateur est redirigé vers la page 404
	public function page404{
		$this->page = new Page($this->app);
		$this->page->setContentFile(__DIR__.'//../../Errors/404.html');
		$this->addHeader('HTTP/1.0 404 Not Found');

		$this->send();
	}

	//Ajout du header
	public function header($header){
		header($header);
	}

	//Ajout d'un cookie
	public function setCookie($name, $value= '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true){
		setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
	}
}
