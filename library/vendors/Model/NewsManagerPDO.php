<?php

namespace Model;

use \Entity\News;

class NewsManagerPDO extends NewsManager{

	public function getList($debut = -1, $limite = -1){

		$req = 'SELECT id, id_author, title, content, date, update_date FROM news ORDER BY id DESC';

		if($debut != -1 || $limite != -1){

			$req .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}

		$request = $this->dao->query($req);
		$request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

		$listNews = $request->fetchAll();

		foreach ($listNews as $news){
			$news->setDateAjout(new \DateTime($news->dateAjout()));
			$news->setUpdateDate(new \DateTime($news->updateDate()));
		}

		$request->closeCursor();

		return $listNews;
	}
}
