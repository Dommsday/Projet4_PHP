<?php

namespace App\Backend\Modules\News;

use \framework\BackController;
use\framework\HTTPRequest;
use \Entity\News;
use \Entity\Author;
use \FormBuilder\AuthorFormBuilder;
use \FormBuilder\AuthorFormConnexionBuilder;
use \framework\AuthorFormHandler;
use \framework\AuthorConnexionFormHandler;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\NewsFormBuilder;
use \FormBuilder\NewsTinyMCEFormBuilder;
use \framework\FormHandler;
use \framework\FormTinyMCEHandler;

class NewsController extends BackController{

	public function processAuthorFormConnexion(HTTPRequest $request){

    $author = new Author([
    	'pseudo' => htmlspecialchars($request->postData('pseudo')),
		'password' => htmlspecialchars($request->postData('password')),
    ]);

    $connexion = $this->managers->getManagerOf('Author')->connexionAdministrator($request->postData('pseudo'));

    $password = htmlspecialchars($request->postData('password'));

    $isCorrect = password_verify($password, $connexion['password']);

    if($request->method() == 'POST'){

        if(($isCorrect) && ($connexion['administrator'] == 1)){

          $this->app->user()->setAuthenticated(true);
          $this->app->httpResponse()->redirect('/admin/');

        }else{

        	$this->app->user()->setMessage('Vous n\'êtes pas l\'administrateur');
        }

    }

    $formAuthorConnexionBuilder = new AuthorFormConnexionBuilder($author);
    $formAuthorConnexionBuilder->build();

    $authorconnexionform = $formAuthorConnexionBuilder->authorconnexionform();

    $formAuthorConnexionBuilder = new AuthorConnexionFormHandler($authorconnexionform, $this->managers->getManagerOf('Author'), $request); 

    $this->page->addVarPage('authorconnexionform', $authorconnexionform->createView());

  }

   public function executeConnexion(HTTPRequest $request){

    $this->page->addVarPage('title', 'Connexion');

    $this->processAuthorFormConnexion($request);

  }

	public function executeIndex(HTTPRequest $request){

		$this->page->addVarPage('title', 'Tableau de bord');

		$manager = $this->managers->getManagerOf('News');
        $managerscomments = $this->managers->getManagerOf('Comment');

		$this->page->addVarPage('nombreNews', $manager->count());
        
        $this->page->addVarPage('comments', $managerscomments->getAllComment());
	}
    
    public function executeAllPost(HTTPRequest $request){

		$this->page->addVarPage('title', 'Liste des articles');

		$manager = $this->managers->getManagerOf('News');
		

		$this->page->addVarPage('listNews', $manager->countComments());
		
	}
    
    public function executeSeeAllComments(HTTPRequest $request){

		$this->page->addVarPage('title', 'Liste des commentaires');

		$managercomments = $this->managers->getManagerOf('Comment');

		$this->page->addVarPage('comments', $managercomments->getAllComment());

	}
    
    public function executeInsert(HTTPRequest $request){

		$this->processTinyMCEForm($request);

		$this->page->addVarPage('title', 'Ajout d\'un article');
	}

    public function processTinyMCEForm(HTTPRequest $request){

		if($request->method() == 'POST'){

			$author = new Author([
				'author' => $request->postData('author'),
			]);

			$news = new News([
				'authorId' => $author['id'],
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

			
			$this->app->user()->setMessage($news->idNew() ? 'L\'article à bien été ajouté' : 'L\'article a bien été modifié');
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

		$this->app->httpResponse()->redirect('/admin/all-post.html');
	}
    
    public function executeDeleteComment(HTTPRequest $request){

		$this->managers->getManagerOf('Comment')->delete($request->getData('id'));

		$this->app->user()->setMessage('Le commentaire à bien été supprimé');

		$this->app->httpResponse()->redirect('/admin/all-comments.html');
	}
    
    public function executeCommentValid(HTTPRequest $request){

		$this->managers->getManagerOf('Comment')->commentValid($request->getData('id'));

		$this->app->user()->setMessage('Le commentaire a bien été validé');

		$this->app->httpResponse()->redirect('/admin/');
	}

	public function executeConfirmeDeconnexion(HTTPRequest $request){

    $this->page->addVarPage('title', 'Déconnexion');

    $this->app->user()->setAuthenticated(false);

    session_destroy(); 
  }

}
