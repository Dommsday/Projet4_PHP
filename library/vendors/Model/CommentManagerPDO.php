<?php 
namespace Model;

use \Entity\Comment;

class CommentManagerPDO extends CommentManager{

	protected function add(Comment $comment){

		$request = $this->dao->prepare('INSERT INTO comments SET news = :news, author = :author, content = :content, date = NOW() ');

		$request->bindValue(':news', $comment->news(), \PDO::PARAM_INT);
		$request->bindValue(':author', $comment->author());
		$request->bindValue(':content', $comment->content());

		$request->execute();

		$comment->setId($this->dao->lastInsertId());
	}
    
    public function getListOf($news){

		if(!ctype_digit($news)){

			throw new \InvalidAugumentException('L\'identifiant de la news doit être un nombre entier et valide');
		}

		$request = $this->dao->prepare('SELECT id, news, author, content, date FROM comments WHERE news = :news AND warning = 0');

		$request->bindValue(':news', $news, \PDO::PARAM_INT);
		$request->execute();

		$request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity\Comment');

		$comments = $request->fetchAll();

		foreach ($comments as $comment){
			$comment->setDate(new \DateTime($comment->date()));
		}

		return $comments;
	}
    
    public function getCommentsWarning(){

		$request = $this->dao->query('SELECT id, author, news, content, date FROM comments WHERE warning = 1');
		
		$request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity\Comment');

		$commentsWarning = $request->fetchAll();

		foreach ($commentsWarning as $comment){
			$comment->setDate(new \DateTime($comment->date()));
		}

		return $commentsWarning;

	}
    
    public function getAllComment(){

		$request = $this->dao->query('SELECT c.id id_comments, c.author author_comments, c.content content_comments, c.warning warning_comments, c.date date_comments, n.title title_news FROM comments c INNER JOIN news n ON c.news = n.id');

		$request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity\Comment');

		$comments = $request->fetchAll();

		foreach ($comments as $comment){
			$comment->setDate(new \DateTime($comment->date()));
		}

		return $comments;
	}
    
    protected function modify(Comment $comment){

		$request = $this->dao->prepare('UPDATE comments SET author = :author, content = :content WHERE id = :id');

		$request->bindValue(':author', $comment->author());
		$request->bindValue(':content', $comment->content());
		$request->bindValue(':id', $comment->id(), \PDO::PARAM_INT);

		$request->execute();
	}

	public function get($id){

		$request = $this->dao->prepare('SELECT id, news, author, content FROM comments WHERE id = :id');
		$request->bindValue(':id', (int) $id, \PDO::PARAM_INT);

		$request->execute();

		$request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

		return $request->fetch();
	}
    
    public function delete($id){

		$this->dao->exec('DELETE FROM comments WHERE id = '. (int) $id);
	}
    
    public function deleteFromNews($news){

		$this->dao->exec('DELETE FROM comments WHERE news ='.(int) $news);
	}
    
    public function count(){

		return $this->dao->query('SELECT COUNT(*) FROM comments')->fetchColumn();
	}
    
    public function warning($id){

		$request = $this->dao->exec('UPDATE comments SET warning = 1 WHERE id = '.(int) $id);

	}
    
    public function commentValid($id){

		$request = $this->dao->exec('UPDATE comments SET warning = 0 WHERE id = '.(int) $id);
	}
}