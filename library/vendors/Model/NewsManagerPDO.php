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

		$requete = $this->dao->prepare('SELECT id, author, title, content, date, update_date FROM news WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
    
    if ($post = $requete->fetch())
    {
      $post->setDate(new \DateTime($post->date()));
      $post->setUpdateDate(new \DateTime($post->updateDate()));
      
      return $post;
    }
    
    return null;
	}

	public function count(){

		return $this->dao->query('SELECT COUNT(*) FROM news')->fetchColumn();
	}
}

