<?php

namespace FrontendModel;

require('FrontModel/FrontModel.php');

class PostManager extends FrontendModel{

	public function getPosts(){

		$db->$this->dbConnect();
		$req->$db->query('SELECT id, id_author, title, content, DATE_FORMAT(date, \'%d %m %Y\') AS date_fr FROM news ORDER BY date_fr DESC');

		return $req;
	}
}
