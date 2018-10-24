<?php

namespace framework;

class StringField extends Field{

	protected $maxLength;

	public function buildWidget(){

		$widget = '';

		if(!empty($this->errorMessage)){

			$widget .= $this->errorMessage.'<br />';
		}

		$widget .= '<label>'.$this->label.'</label><input type="text" name="'.$this->name.'"';

		if(!empty($this->value)){

			$widget .= ' value="'.htmlspecialchars($this->value).'"';
		}

		if(!empty($this->maxLength)){

			$widget = ' maxlenght="'.$this->maxLength.'"';
		}

		return $widget .= ' />';
	}

	public function setMaxLength($maxLength){

		$maxLength = (int) $maxLength;

		if($maxlenght > 0){
			$this->maxLenght = $maxLength;

		}else{

			throw new \RuntimeException('La longueur maximal doit être un nombre supérieur à 0');
		}
	}


}
