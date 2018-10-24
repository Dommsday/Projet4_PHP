<?php

namespace App\Backend\Modules\News;

use \framework\BackController;
use\framework\HTTPRequest;
use \Entity\News;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\NewsFormBuilder;
use \framework\FormHandler;

class NewsController extends BackController{

	public function executeIndex(HTTPRequest $request){

		$this->page->addVarPage('title', 'Liste des news');

		$manager = $this->managers->getManagerOf('News');

		$this->page->addVarPage('listNews', $manager->getList());
		$this->page->addVarPage('nombreNews', $manager->count());
	}
    
    public function executeInsert(HTTPRequest $request){

		$this->processForm($request);

		$this->page->addVarPage('title', 'Ajout d\'un article');
	}

	public function processForm(HTTPRequest $request){

		if($request->method() == 'POST'){

			$news = new News([

				'author' => $request->postData('author'),
				'title' => $request->postData('title'),
				'content' => $request->postData('content')
			]);

			if($request->getExists('id')){

				$news->setId($request->getData('id'));
			}
		}else{

			if($request->getExists('id')){

				$news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));

			}else{

				$news = new News;
			}
		}

		$formBilder = new NewsFormBuilder($news);
		$formBilder->build();

		$form = $formBuilder->form();
        
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('News'), $request);


		if($formHandler->process()){

			
			$this->app->user()->setMessage($news->idNew() ? 'L\'article à bien été ajouté !' : 'L\'article a bien été modifié ! ');
			$this->app->httpResponse()->redirect('/admin/');
		}

		$this->page->addVarPage('form', $form->createView());
	}
    
    public function executeUpdate(HTTPRequest $request){

		$this->processForm($request);

		$this->page->addVarPage('title', 'Modification de l\'article');
	}
    
    public function executeDelete(HTTPRequest $request){

		$this->managers->getManagerOf('News')->delete($request->getData('id'));
        
        $this->managers->getManagerOf('Comment')->deleteFromNews($request->getData('id'));

		$this->app->user()->setMessage('L\'article à bien été supprimé');

		$this->app->httpResponse()->redirect('.');
	}
    
    public function executeUpdateComment(HTTPRequest $request){

		$this->page->addVarPage('title', 'Modification d\'un commentaire');

		if($request->method() == 'POST'){

			$comment = new Comment([

				'id' => $request->getData('id'),
				'author' => $request->postData('author'),
				'content' => $request->postData('content')
			]);
		}else{

			$comment = $this->managers->getManagerOf('Comment')->get($request->getData('id'));
		}

		$formBuilder = new CommentFormBuilder($comment);
		$formBuilder->build();

		$form = $formBuilder->form();
        
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comment'), $request);

		if($formHandler->process()){
            
			$this->app->user()->setMessage('Le comment a bien été modifié');
			$this->app->httpResponse()->redirect('/admin/');
		}

		$this->page->addVarPage('form', $form->createView());
	}
    
    public function executeDeleteComment(HTTPRequest $request){

		$this->managers->getManagerOf('Comment')->delete($request->getData('id'));

		$this->app->user()->setMessage('Le commentaire à bien été supprimé !');

		$this->app->httpResponse->redirect('.');
	}
}
