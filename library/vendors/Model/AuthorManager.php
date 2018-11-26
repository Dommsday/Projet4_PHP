<?php

namespace Model;

use \framework\Manager;
use \Entity\Author;

abstract class AuthorManager extends Manager{

	abstract protected function newIdentifiant(Author $author);

	abstract public function connexionIdentifiant($pseudo);

	public function save(Author $author){

    	if($author->Valid()){

    		if($author->idNew()){

    		 $this->newIdentifiant($author);

    		}

    	}else{

    		throw new \RuntimeException('Les identifiants doivent être validé pour être enregistré');
    	}
    }
}