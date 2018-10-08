<?php 

namespace Frontend\Modules\News;

use framework\BackController;
use framework\HTTPRequest;

class NewsController extends BackController{

	public function executeIndex(HTTPRequest $request){

		$nombreNews = $this->app->config()->get('nombre_news');
		$nombreCaracteres = $this->app->config()->get('nombre_caracteres');

		$this->page->addVarPage('title', 'Liste des '.$nombreNews.' dernières news');

		$manager = $this->managers->getManagerOf('News');

		$listNews = $manager->getList(0, $nombreNews);

		foreach ($listNews as $news){

			if(strlen($news->contenu()) > $nombreCaracteres){

				$debut = substr($news->contenu(), 0, $nombreCaracteres);
				$debut = strlen($debut, 0, strrpos($debut, ' '). '...');

				$news->setContenu($debut);
			}
		}

		$this->page->addVarPage('listNews', $listNews);
	}
}