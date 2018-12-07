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
			$news->setDate(new \DateTime($news->date()));
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

	public function countComments(){

		$request =  $this->dao->query('SELECT n.id AS id, n.title AS title, n.date_news AS date_news, COUNT(c.news) AS total FROM news AS n INNER JOIN comments AS c ON c.news = n.id WHERE n.id = 1');

		$request->execute();

		$request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

		$listNews = $request->fetchAll();

		foreach ($listNews as $news){
			$news->setDateNews(new \DateTime($news->dateNews()));
		}

		$request->closeCursor();

		return $listNews;


	public function count(){

		return $this->dao->query('SELECT COUNT(*) FROM news')->fetchColumn();
	}
    
    protected function add(News $post){

		$request = $this->dao->prepare('INSERT INTO news SET author = :author, title = :title, content = :content, date = NOW(), update_date = NOW()');

		$request->bindValue(':author', $post->author());
		$request->bindValue(':title', $post->title());
		$request->bindValue(':content', $post->content());

		$request->execute();
	}
    
    protected function modify(News $post){

		$request = $this->dao->prepare('UPDATE news SET author = :author, title = :title, content = :content, update_date = NOW() WHERE id = :id');

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

