<?php

namespace framework;

abstract class Field{

	use Hydrator;

	protected $errorMessage;
	protected $label;
	protected $name;
	protected $value;
    protected $validators = [];
	protected $length;

	public function __construct(array $options =[]){

		if(!empty($option)){

			$this->hydrate($option);
		}
	}

	abstract public function buildWidget();

	public function Valid(){
        
        foreach ($this->validators as $validator){
			
			if(!$validator->Valid($this->value)){

				$this->errorMessage = $validator->errorMessage();
				return false;
			}
		}

		return true;

	}

	public function label(){
		return $this->label;
	}

	public function name(){
		return $this->name;
	}

	public function value(){
		return $this->value;
	}
    
    public function length(){
		return $this->length;
	}


	public function setLabel($label){

		if(is_string($label)){
			$this->label = $label;
		}
	}
    
    public function setLength($length){

		$length = (int) $length;

		if($length > 0){

			$this->length = $length;
		}
	}

	public function setName($name){

		if(is_string($name)){
			$this->name= $name;
		}
	}

	public function setValue($value){

		if(is_string($value)){
			$this->value = $value;
		}
	}
    
    public function setValidators(array $validators){

    	foreach ($validators as $validator){

      		if ($validator instanceof Validator && !in_array($validator, $this->validators)){

        		$this->validators[] = $validator;
      		}
    	}
  	}
}
