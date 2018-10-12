<?php
namespace Model;

use \Entity\News;

class NewsManagerPDO extends NewsManager{

	public function getList($debut = -1, $limite = -1){

		$req = 'SELECT id, title, content, date, update_date FROM news ORDER BY id DESC';

		if($debut != -1 || $limite != -1){

			$req .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}

		$request = $this->dao->query($req);
		$request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

		$listNews = $request->fetchAll();

		foreach ($listNews as $news){
			$news->setContent($news->content());
		}

		$request->closeCursor();

		return $listNews;
	}
    
    public function getPost($id){

		$request = $this->dao->prepare('SELECT id, author, title, content, date, update_date FROM news WHERE id = :id');
		$request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$request->execute();

		$request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

		if($news = $request->fetch()){

			$news->setContent($news->content());

			return $news;
		}

		return null;
	}
}

