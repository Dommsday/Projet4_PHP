<?php 

namespace  framework;

class Route{

	protected $url;
	protected $module;
	protected $action;
	protected $varName;
	protected $arrayVars = [];

	public function __construct($url, $module, $action, array $varName){

		$this->setUrl($url);
		$this->setModule($module);
		$this->setAction($action);
		$this->setVarName($varName);
	}

	public function vars(){

		//on retourne la variable si elle est présente
		return(!empty($this->varName));
	}

	public function match($url){

		if(preg_match('`^'.$this->url.'$`', $url, $matches)){

			return $matches;
		}else{

			return false;
		}
	}


	public function setUrl($url){
		if(is_string($url)){
			$this->url = $url;
		}
	}

	public function setModule($module){
		if(is_string($module)){
			$this->module = $module;
		}
	}

	public function setAction($action){
		if(is_string($action)){
			$this->action = $action;
		}
	}

	public function setVarName(array $varName){
		$this->varName = $varName;
	}

	public function setArrayVars(array $arrayVars){
		$this->arrayVars = $arrayVars;
	}

	public function url(){
		return $this->url;
	}

	public function module(){
		return $this->module;
	}

	public function action(){
		return $this->action;
	}

	public function varName(){
		return $this->varName;
	}

	public function arrayVars(){
		return $this->arrayVars;
	}

}
