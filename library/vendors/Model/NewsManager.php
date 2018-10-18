<?php

namespace Model;

use \framework\Manager;

abstract class NewsManager extends Manager{

	abstract public function getList($debut = -1, $limite = -1);
    
    abstract public function getPost($id);

    abstract public function count();
    
    abstract protected function add(News $post);
    
     //Méthode qui s'écrit directement car elle n'est pas dépendante de la DAO
    public function save(News $post){

    	if($post->Valid()){

    		$post->idNew() ? $this->add($post) : $this->modify($post);
    	}else{

    		throw new \RuntimeException('L\'article doit être validé pour être enregistré';
    	}
    }
}
