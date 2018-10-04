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
	public function page($location){
		header('Location'.$location);
	}

	//En cas d'erreur l'utilisateur est redirigé vers la page 404
	public function page404{

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
