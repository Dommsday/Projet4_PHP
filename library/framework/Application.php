<?php
namespace framework;

abstract class Application{

	protected $httpRequest;
	protected $httpResponse;
	protected $name;
	protected $config;

	public function __construct(){
		$this->httpRequest = new HTTPRequest($this);
		$this->httpResponse = new HTTPResponse($this);
		$this->config = new Config($this);
		$this->name = '';
	}

	//Récupère le bon controlleur
	public function getController(){

		$routeur  = new Routeur;

		$xml = new \DOMDocument;
		$xml->load(__DIR__.'/../../App/'.$this->name.'/Routeur/routes.xml');

		$routes = $xml->getElementsByTagName('route');

		foreach ($routes as $route){

			$arrayVars = [];

			//Si une variable est présente dans l'URL
			if($route->hasAttribute('vars')){

				//Sépare le nom des variables par des ',' et récupère la valeur des variables
				$arrayVars = explode(',', $route->getAttribute('vars'));
			}

			$routeur->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $arrayVars));
		}

		try{
			$matchedRoute = $routeur->getRoute($this->httpRequest->requestURI());
			
		}catch(\RuntimeException $e){

			if($e->getCode() == Routeur::ERR_ROUTE){

				$this->httpResponse->page404();
			}
		}

		$_GET = array_merge($_GET, $matchedRoute->arrayVars());

		$controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';

		return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());


	}
	//Méthode qui doit être réécrite chez l'enfant
	abstract public function run();

	public function httpRequest(){
		return $this->httpRequest;
	}

	public function httpResponse(){
		return $this->httpResponse;
	}

	public function name(){
		return $this->name;
	}

	public function config(){
		return $this->config;
	}
}
