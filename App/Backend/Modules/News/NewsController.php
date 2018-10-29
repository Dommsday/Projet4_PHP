<?php

namespace App\Backend\Modules\News;

use \framework\BackController;
use\framework\HTTPRequest;
use \Entity\News;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\NewsFormBuilder;
use \FormBuilder\NewsTinyMCEFormBuilder;
use \framework\FormHandler;
use \framework\FormTinyMCEHandler;

class NewsController extends BackController{

	public function executeIndex(HTTPRequest $request){

		$this->page->addVarPage('title', 'Liste des news');

		$manager = $this->managers->getManagerOf('News');
        $managerscomments = $this->managers->getManagerOf('Comment');

		$this->page->addVarPage('listNews', $manager->getList());
		$this->page->addVarPage('nombreNews', $manager->count());
        
        $this->page->addVarPage('commentsWarning', $managerscomments->getCommentsWarning());
        $this->page->addVarPage('nombreComments', $managerscomments->count());
	}
    
    public function executeInsert(HTTPRequest $request){

		$this->processTinyMCEForm($request);

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

				$news = $this->managers->getManagerOf('News')->getPost($request->getData('id'));

			}else{

				$news = new News;
			}
		}

		$formBuilder = new NewsFormBuilder($news);
		$formBuilder->build();

		$form = $formBuilder->form();
        
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('News'), $request);


		if($formHandler->process()){

			
			$this->app->user()->setMessage($news->idNew() ? 'L\'article à bien été ajouté !' : 'L\'article a bien été modifié ! ');
			$this->app->httpResponse()->redirect('/admin/');
		}

		$this->page->addVarPage('form', $form->createView());
	}
    
    public function processTinyMCEForm(HTTPRequest $request){

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

				$news = $this->managers->getManagerOf('News')->getPost($request->getData('id'));

			}else{

				$news = new News;
			}
		}

		$formTinyMCEBuilder = new NewsTinyMCEFormBuilder($news);
		$formTinyMCEBuilder->build();

		$tinymce = $formTinyMCEBuilder->tinymce();
        
        $formTinyMCEHandler = new FormTinyMCEHandler($tinymce, $this->managers->getManagerOf('News'), $request);


		if($formTinyMCEHandler->process()){

			
			$this->app->user()->setMessage($news->idNew() ? 'L\'article à bien été ajouté !' : 'L\'article a bien été modifié ! ');
			$this->app->httpResponse()->redirect('/admin/');
		}

		$this->page->addVarPage('tinymce', $tinymce->createView());
	}
    
    public function executeUpdate(HTTPRequest $request){

		$this->processTinyMCEForm($request);

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

		$this->app->httpResponse()->redirect('.');
	}
}
