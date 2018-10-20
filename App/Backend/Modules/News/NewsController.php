<?php

namespace App\Backend\Modules\News;

use \framework\BackController;
use\framework\HTTPRequest;
use \Entity\News;

class NewsController extends BackController{

	public function executeIndex(HTTPRequest $request){

		$this->page->addVarPage('title', 'Liste des news');

		$manager = $this->managers->getManagerOf('News');

		$this->page->addVarPage('listNews', $manager->getList());
		$this->page->addVarPage('nombreNews', $manager->count());
	}
    
    public function executeInsert(HTTPRequest $request){

		if($request->postExists('author')){

			$this->processForm($request);
		}

		$this->page->addVarPage('title', 'Ajour d\'un post');
	}

	public function processForm(HTTPRequest $request){

		$post = new News([
			'author' => $request->postData('author'),
			'title' => $request->postData('title'),
			'content' => $request->postData('content')
		]);

		if($request->postExists('id')){

			$post->setId($request->postData('id'));
		}

		if($post->Valid()){
			$this->managers->getManagerOf('News')->save($post);

			$this->app->user()->setMessage($post->idNew()) ? 'L\'article à bien été ajouté !' : 'L\'article à bien été modifié !';

		}else{

			$this->page->addVarPage('erreurs', $post->erreurs());
		}

		$this->page->addVarPage('news', $post);
	}
    
    public function executeUpdate(HTTPRequest $request){

		if($request->postExists('author')){

			$this->processForm($request);
		}else{

			$this->page->addVarPage('news', $this->managers->getManagerOf('News')->getPost($request->getData('id')));
		}

		$this->page->addVarPage('title', 'Modification de l\'article');
	}
}
