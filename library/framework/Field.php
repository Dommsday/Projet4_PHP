<?php

namespace framework;

abstract class Field{

	use Hydrator;

	protected $errorMessage;
	protected $label;
	protected $name;
	protected $id;
	protected $idSpan;
	protected $maxLength;
	protected $placeholder;
	protected $boots;
	protected $value;
    protected $validators = [];

	public function __construct(array $options =[]){

		if(!empty($options)){

			$this->hydrate($options);
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

	public function boots(){
		return $this->boots;
	}

	public function id(){
		return $this->id;
	}

	public function idSpan(){
		return $this->idSpan;
	}

	public function MaxLength(){
		return $this->maxLength;
	}

	public function placeholder(){
		return $this->placeholder;
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

	public function setId($id){

		if(is_string($id)){
			$this->id = $id;
		}
	}

	public function setIdSpan($idSpan){

		if(is_string($idSpan)){
			$this->idSpan = $idSpan;
		}
	}

	public function setPlaceholder($placeholder){

		if(is_string($placeholder)){
			$this->placeholder = $placeholder;
		}
	}

	public function setMaxLength($maxLength){

		if(is_string($maxLength)){
			$this->maxLength = $maxLength;
		}
	}

	public function setBoots($boots){

		if(is_string($boots)){
			$this->boots = $boots;
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
