<?php

namespace Entity;

use \framework\Entity;

class News extends Entity{

	protected $id;
	protected $idauteur;
	protected $titre;
	protected $contenu;
	protected $date;
	protected $updateDate;

	const AUTEUR_INVALIDE = 1;
	const TITRE_INVALIDE = 2;
	const CONTENU_INVALIDE = 3;

	public function Valid(){

		return !(empty($this->auteur) ||  empty($this->titre) || empty($this->contenu));
	}

	public function setId($id){
		$id = (int) $id;

		if($id > 0){

			$this->id = $id;
		}
	}

	public function setIdAuteur($idauteur){

		$idauteur = (int) $idauteur;

		if($idauteur > 0){

			$this->idauteur = $idauteur;
		}
	}

	public function setTitre($titre){

		if(!is_string($titre) || empty($titre)){

			$this->erreurs[] = self::TITRE_INVALIDE;
		}

		$this->titre = $titre;
	}

	public function setContenu($contenu){

		if(!is_string($contenu) || empty($contenu)){

			$this->erreurs[] = self::CONTENU_INVALIDE;
		}

		$this->contenu = $contenu;

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

	public function idauteur(){
		return $this->idauteur;
	}

	public function titre(){
		return $this->titre;
	}

	public function contenu(){
		return $this->contenu;
	}

	public function date(){
		return $this->date;
	}

	public function updateDate(){
		return $this->updateDate;
	}

}
