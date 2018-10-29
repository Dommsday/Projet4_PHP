<?php

namespace Model;

use \framework\Manager;
use \Entity\Comment;

abstract class CommentManager extends Manager{

	abstract protected function add(Comment $comment);
    
    abstract protected function getListOf($news);
    
    abstract protected function modify(Comment $comment);
    
    abstract public function warning($id);

    abstract public function get($id);
    
    abstract public function delete($id);
    
    abstract public function deleteFromNews($news);
    
    abstract public function getCommentsWarning();

	public function save(Comment $comment){

		if($comment->Valid()){

			$comment->idNew() ? $this->add($comment) : $this->modify($comment);

		}else{

			throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
		}
	}
}
