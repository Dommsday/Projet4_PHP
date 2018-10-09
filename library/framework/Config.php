<?php

namespace framework;

class Config extends Component{

	protected $configs = [];

	public function get($var){

		if(!$this->configs){

			$xml = new \DOMDocument;
			$xml->load(__DIR__.'/../../Frontend/Routeur/config.xml');

			$elements = $xml->getElementsByTagName('define');

			foreach ($elements as $element){
				$this->configs[$element->getAttribute('var')] = $element->getAttribute('value');
			}
		}
	
		if(isset($this->configs[$var])){

			return $this->configs[$var];
		}

		return null;
	}

}