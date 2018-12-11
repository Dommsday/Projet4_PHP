<?php
namespace Model;

use \Entity\News;

class NewsManagerPDO extends NewsManager{

	public function getList($debut = -1, $limite = -1){

		$req = 'SELECT id, title, content, DATE_FORMAT(date, "%d/%m/%Y à %Hh%imin") AS date, DATE_FORMAT(updateDate, "%d/%m/%Y à %Hh%imin") AS updateDate FROM news ORDER BY id DESC';

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

		$requete = $this->dao->prepare('SELECT id, author, title, content, DATE_FORMAT(date, "%d/%m/%Y à %Hh%imin") AS date, DATE_FORMAT(updateDate, "%d/%m/%Y à %Hh%imin") AS updateDate FROM news WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
    
    $post = $requete->fetch();
  
     return $post;
    
	}

    

	public function countComments(){

		$request =  $this->dao->query('SELECT n.id AS id, n.title AS title, DATE_FORMAT(n.date,"%d/%m/%Y à %Hh%imin") AS date, DATE_FORMAT(n.updateDate, "%d/%m/%Y à %Hh%imin") AS updateDate , COUNT(c.id) AS total FROM news  n LEFT JOIN comments  c ON c.news = n.id GROUP BY n.id');

		$request->execute();

		$listNews = $request->fetchAll();

		$request->closeCursor();

		return $listNews;

	}


	public function count(){

		return $this->dao->query('SELECT COUNT(*) FROM news')->fetchColumn();
	}
    
    protected function add(News $post){

		$request = $this->dao->prepare('INSERT INTO news SET author = :author, title = :title, content = :content, date = NOW(), updatDate = NOW()');

		$request->bindValue(':author', $post->author());
		$request->bindValue(':title', $post->title());
		$request->bindValue(':content', $post->content());

		$request->execute();
	}
    
    protected function modify(News $post){

		$request = $this->dao->prepare('UPDATE news SET author = :author, title = :title, content = :content, updateDate = NOW() WHERE id = :id');

		$request->bindValue(':author', $post->author());
		$request->bindValue(':title', $post->title());
		$request->bindValue(':content', $post->content());
		$request->bindValue(':id', $post->id(), \PDO::PARAM_INT);

		$request->execute();
	}
    
    public function delete($id){

		$this->dao->exec('DELETE FROM news WHERE id = '.(int) $id);
	}
}

