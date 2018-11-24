<?php 
namespace Model;

use \Entity\Author;

class AuthorManagerPDO extends AuthorManager{

	protected function newIdentifiant(Author $author){

		$request = $this->dao->prepare('INSERT INTO author SET pseudo = :pseudo, email = :email, password = :password');

		$request->bindValue(':pseudo', $author->pseudo());
		$request->bindValue(':email', $author->email());
		$request->bindValue(':password', password_hash($author->password(), PASSWORD_DEFAULT));

		$request->execute();

		$author->setId($this->dao->lastInsertId());
	}

	public function connexionIdentifiant($pseudo, $password){

		$request = $this->dao->prepare('SELECT id FROM author WHERE pseudo = :pseudo AND password = :password');

		$request->execute(array(
			'pseudo' => $pseudo,
			'password' => $password
		));

		$connexion = $request->fetch();


		return $connexion;
	}
}