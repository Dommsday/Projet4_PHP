<?php

namespace App\Backend\Module\News;

use \framework\BackController;
use\framework\HTTPRequest;

class NewsController extends BackController{

	public function executeIndex(HTTPRequest $request){

		$this->page->addVarPage('title', 'Liste des news');

		$manager = $this->managers->getManagerOf('News');

		$this->page->addVarPage('listNews', $manager->getList());
		$this->page->addVarPage('nombreNews', $manager->count());
	}
}
