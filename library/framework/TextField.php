<?php

namespace framework;

class TextField extends Field{

	protected $cols;
	protected $rows;

	public function buildWidget(){

		$widget = '';

		if(!empty($this->errorMessage)){

			$widget .=$this->errorMessage.'<br />';
		}

		$widget .= '<label>'.$this->label.'</label><textarea name="'.$this->name().'"';

		if(!empty($this->cols)){

			$widget = ' cols="'.$this->cols.'"';
		}

		if(!empty($this->rows)){
			
		}
	}
}
