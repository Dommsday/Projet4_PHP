<?php

namespace framework;

class Routeur{

	//Tableau contenant les routes
	protected $routes = []

	const ERR_ROUTE = 1;

	public function addRoute(Route $route){
		//Si la route ne se trouve pas dans le tableau, on l'ajoute
		if(!in_array($route, $this->routes)){
			$this->routes[] = $route;
		}
	}

	public function getRoute($url){
		foreach ($this->$routes as $route){
			
			//Si la route correspond à l'url
			if(($varRoute = $route->match($url)) == true){

				//Si l'url contient des variables
				if($route->vars()){

					$varNames = $route->varNames();
					$listVars = [];

					foreach ($varRoute as $key => $value) {
						
						if($key !==0){

							$listVars[$varNames[$key -1] = $value];
						}
					}

					$route->setVars($listVars);
				}

				return $route
			}
		}

		throw new \RuntimeException('L\'url n\'existe pas', self::ERR_ROUTE);
	}
}
