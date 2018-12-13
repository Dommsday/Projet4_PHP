<?php 
namespace Model;

use \Entity\Author;

class AuthorManagerPDO extends AuthorManager{

	protected function newIdentifiant(Author $author){

		$request = $this->dao->prepare('INSERT INTO author SET pseudo = :pseudo, email = :email, password = :password, passwordConfirm = :passwordConfirm, date = NOW()');

		$request->bindValue(':pseudo', $author->pseudo());
		$request->bindValue(':email', $author->email());
		$request->bindValue(':password', password_hash($author->password(), PASSWORD_DEFAULT));
		$request->bindValue(':passwordConfirm', password_hash($author->passwordConfirm(), PASSWORD_DEFAULT));

		$request->execute();

		$author->setId($this->dao->lastInsertId());
	}


	public function connexionIdentifiant($pseudo){

		$request = $this->dao->prepare('SELECT id, pseudo, password, administrator FROM author WHERE pseudo = :pseudo');

		$request->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
		$request->execute();

		$request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity\Author');

		$connexion = $request->fetch();

		return $connexion;
	}

	
	public function connexionAdministrator($pseudo){

		$request = $this->dao->prepare('SELECT id, password, administrator FROM author WHERE pseudo = :pseudo AND administrator = 1');

		$request->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
		$request->execute();

		$request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity\Author');

		$connexion = $request->fetch();

		return $connexion;
	}

	public function getAllMembers(){

		$request = $this->dao->query('SELECT id, pseudo, email, administrator, DATE_FORMAT(date, "%d/%m/%Y") AS date FROM author');

		$members = $request->fetchAll();

		return $members;
	}

	public function count(){

		return $this->dao->query('SELECT COUNT(*) FROM author')->fetchColumn();
	}

	public function delete($id){

		$request = $this->dao->prepare('DELETE FROM author WHERE id = :id');
		$request->bindValue(':id', (int) $id, \PDO::PARAM_INT);

		$request->execute();
	}
}