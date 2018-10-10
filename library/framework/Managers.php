<?php

namespace framework;

class Managers{

	protected $api = null;
	protected $dao = null;
	protected $managers = [];

	public function __construct($api, $dao){

		$this->api = $api;
		$this->dao = $dao;
	}

	public function getManagerOf($module){

		if(!is_string($module) || empty($module)){
			throw new \InvalidArgumentException('Le module demandé n\'est pas une chaîne de caractère ou est absent');
		}

		if(!isset($this->managers[$module])){

			$manager = '\\Model\\'.$module.'Manager'.$this->api;

			$this->managers[$module] = new $manager($this->dao);
		}

		return $this->managers[$module];
	}
}
