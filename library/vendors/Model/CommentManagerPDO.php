<?php 
namespace Model;

use \Entity\Comment;

class CommentManagerPDO extends CommentManager{

	protected function add(Comment $comment){

		$request = $this->dao->prepare('INSERT INTO comments SET news = :news, author = :author, content = :content, date = NOW() ');

		$request->bindValue(':news', $comment->news(), \PDDO::PARAM_INT);
		$request->bindValue(':author', $comment->author());
		$request->bindValue(':content', $comment->content());

		$request->execute();

		$comment->setId($this->dao->lastInsertId());
	}
}