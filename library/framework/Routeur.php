<?php

namespace framework;

class Routeur{

	//Tableau contenant les routes
	protected $routes = [];

	const ERR_ROUTE = 1;

	//Ajoute une route
	public function addRoute(Route $route){
		//Si la route ne se trouve pas dans le tableau, on l'ajoute
		if(!in_array($route, $this->routes)){
			$this->routes[] = $route;
		}
	}

	//Renvoie la route demandé
	public function getRoute($url){

		foreach ($this->routes as $route){
			
			//Si la route correspond à l'url
			if(($varRoute = $route->match($url)) == true){

				//Si l'url contient des variables
				if($route->varsExists()){

					$varNames = $route->varName();
					$listVars = [];

					foreach ($varRoute as $key => $value) {
						
						if($key !==0){

							$listVars[$varNames[$key -1]] = $value;
						}
					}

					$route->setArrayVars($listVars);
				}
				return $route;
			}
		}

		throw new \RuntimeException('L\'url n\'existe pas', self::ERR_ROUTE);
	}
}
