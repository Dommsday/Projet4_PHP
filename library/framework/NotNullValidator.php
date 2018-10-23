<?php

namespace framework;

class NotNullValidator extends Validator{

	public function Valid($value){

		return $value = '';
	}
}
