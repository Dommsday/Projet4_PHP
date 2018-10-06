<?php

namespace frameworks;

class Config extends Component{

	protected $configs = [];

	public function get($var){

		if(!$this->configs){

			$xml = new \DOMDocument;
			$xml = load(__DIR__.'/../../Frontend/Routeur/configroute.xml');

			$elements = $xml->getElementsByTagName('define');

			foreach ($elements as $element){
				$this->configs[$element->getAttribute('var')] = $value->getAttribute('value');
			}
		}
	
		if(isset($this->configs[$var])){

			return $this->configs[$var];
		}

		return null;
	}

}
