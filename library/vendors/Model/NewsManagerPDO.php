<?php

namespace Model;

use Entity\News;

class NewsManagerPDO extends NewsManager{

	public function getList($debut = -1, $limitr = -1){

		$req = 'SELECT id, id_author, title, content, date, updatedate FROM news ORDER BY id DESC';

		if($debut != -1 || $limite != -1){

			$req .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}

		$request = $this->dao->query->($req);
		$request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity\News');

		$listeNews = $request->fetchAll();

		foreach ($listeNews as $vnews){
			$news->setDateAjout(new \DateTime($news->dateAjout()));
			$news->setUpdateDate(new \DateTime($news->updateDate()));
		}
	}
}
