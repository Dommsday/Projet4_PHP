<?php

namespace Model;

use \framework\Manager;
use \Entity\Comment;

abstract class CommentManager extends Manager{

	abstract protected function add(Comment $comment);
    
    abstract protected function getListOf($news);

	public function save(Comment $comment){

		if($comment->Valid()){

			$comment->isNew() ? $this->add($comment) : $this->modify($comment);

		}else{

			throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
		}
	}
}
