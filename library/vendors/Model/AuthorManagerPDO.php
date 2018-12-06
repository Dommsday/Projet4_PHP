<?php 
namespace Model;

use \Entity\Author;

class AuthorManagerPDO extends AuthorManager{

	protected function newIdentifiant(Author $author){

		$request = $this->dao->prepare('INSERT INTO author SET pseudo = :pseudo, email = :email, password = :password, passwordConfirm = :passwordConfirm');

		$request->bindValue(':pseudo', $author->pseudo());
		$request->bindValue(':email', $author->email());
		$request->bindValue(':password', password_hash($author->password(), PASSWORD_DEFAULT));
		$request->bindValue(':passwordConfirm', password_hash($author->passwordConfirm(), PASSWORD_DEFAULT));

		$request->execute();

		$author->setId($this->dao->lastInsertId());
	}


	public function connexionIdentifiant($pseudo){

		$request = $this->dao->prepare('SELECT id, password, administrator FROM author WHERE pseudo = :pseudo AND administrator = 1');

		$request->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
		$request->execute();

		$request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity\Author');

		$connexion = $request->fetch();

		return $connexion;
	}

}