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

		$request = $this->dao->prepare('SELECT id, news, author, content, date FROM comments WHERE news = :news');

		$request->bindValue(':news', $news, \PDO::PARAM_INT);
		$request->execute();

		$request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity\Comment');

		$comments = $request->fetchAll();

		foreach ($comments as $comment){
			$comment->setDate(new \DateTime($comment->date()));
		}

		return $comments;
	}
}