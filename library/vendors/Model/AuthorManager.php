<?php

namespace Model;

use \framework\Manager;
use \Entity\Author;

abstract class AuthorManager extends Manager{

	abstract protected function newIdentifiant(Author $author);

	abstract public function connexionIdentifiant($pseudo);

    abstract public function connexionAdministrator($pseudo);
    
    abstract public function getAllMembers();

    abstract public function count();

    abstract public function delete($id);

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