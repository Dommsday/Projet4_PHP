<?php

namespace framework;

class Page extends Component{

	protected $contentFile;
	protected $arrayVars = [];

	public function addVarPage($var, $value){

		if(!is_string($var) || is_numeric($var) || empty($var)){
			throw new \InvalidAugumentException('Le nom de la variable doit être une chaîne de caractère et présente');
		}

		$this->arrayVars[$var] = $value;
	}

	public function getGeneratedPage(){

		if(!file_exists($this->contentFile)){

			throw new \RuntimeException('La vue demandée n\'existe pas');

		}
        
        $user = $this->app->user();

		extract($this->arrayVars);

		ob_start();
		require $this->contentFile;
		$content = ob_get_clean();

		ob_start();
		require __DIR__.'/../../App/'.$this->app->name().'/Template/layout.php';
		return ob_get_clean();
	}

	public function setContentFile($contentFile){

		if(!is_string($contentFile) || empty($contentFile)){
			throw new \InvalidAugumentException('La vue demandés est invalide');
		}

		$this->contentFile = $contentFile;
	}


}
