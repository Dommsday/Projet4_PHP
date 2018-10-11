<?php

namespace Entity;

use \framework\Entity;

class News extends Entity{

	protected $id;
	protected $idauthor;
	protected $title;
	protected $content;
	protected $date;
	protected $updateDate;

	const AUTEUR_INVALIDE = 1;
	const TITRE_INVALIDE = 2;
	const CONTENU_INVALIDE = 3;

	public function Valid(){

		return !(empty($this->idauthor) ||  empty($this->title) || empty($this->content));
	}

	public function setId($id){
		$id = (int) $id;

		if($id > 0){

			$this->id = $id;
		}
	}

	public function setIdAuthor($idauthor){

		$idauthor = (int) $idauthor;

		if($idauhor > 0){

			$this->idauthor = $idauthor;
		}
	}

	public function setTitle($title){

		if(!is_string($title) || empty($title)){

			$this->erreurs[] = self::TITRE_INVALIDE;
		}

		$this->title = $title;
	}

	public function setContent($content){

		if(!is_string($content) || empty($content)){

			$this->erreurs[] = self::CONTENU_INVALIDE;
		}

		$this->content = $content;

	}

	public function setDate(\DateTime $date){

		$this->date = $date;
	}

	public function setUpdateDate(\DateTime $updateDate){

		$this->updateDate = $updateDate;
	}

	public function id(){
		return $this->id;
	}

	public function idauthor(){
		return $this->idauthor;
	}

	public function title(){
		return $this->title;
	}

	public function content(){
		return $this->content;
	}

	public function date(){
		return $this->date;
	}

	public function updateDate(){
		return $this->updateDate;
	}

}
