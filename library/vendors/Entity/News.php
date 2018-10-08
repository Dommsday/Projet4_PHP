<?php

namespace Entity;

use framework/Entity;

class News extends Entity{

	protected $auteur;
	protected $titre;
	protected $contenu;
	protected $dateAjout;
	protected $updateDate;

	const AUTEUR_INVALIDE = 1;
	const TITRE_INVALIDE = 2;
	const CONTENU_INVALIDE = 3;

	public function Valid(){

		return !(empty($this->auteur) ||  empty($this->titre) || empty($this->contenu));
	}

	public function setAuteur($auteur){

		if(!is_string($auteur) || empty($auteur)){

			$this->erreurs[] = self::AUTEUR_INVALIDE;
		}

		$this->auteur = $auteur;
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

	public function setDateAjout(\DateTime $dateAjout){

		$this->dateAjout = $dateAjout;
	}

	public function setUpdateDate(\DateTime $updateDate){

		$this->updateDate = $updateDate;
	}

	public function auteur(){
		return $this->auteur;
	}

	public function titre(){
		return $this->titre;
	}

	public function contenu(){
		return $this->contenu;
	}

	public function dateAjout(){
		return $this->setDateAjout;
	}

	public function pudateDate(){
		return $this->updateDate;
	}

}