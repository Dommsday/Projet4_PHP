<?php

namespace App\Backend\Modules\News;

use \framework\BackController;
use \framework\HTTPRequest;
use \Entity\News;
use \Entity\Comment;
use \Entity\Author;
use \framework\User;
use \FormBuilder\AuthorFormBuilder;
use \FormBuilder\AuthorFormConnexionBuilder;
use \framework\AuthorFormHandler;
use \framework\AuthorConnexionFormHandler;
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
          $this->app->user()->setAttribute('administrator', $connexion['administrator']);
          $this->app->user()->setAttribute('login', $request->postData('pseudo'));
          $this->app->httpResponse()->redirect('/blog/Autoload/admin/');

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

		$user = new User;

		if($user->getAttribute('administrator') == 1){

		$this->page->addVarPage('title', 'Tableau de bord');

		$manager = $this->managers->getManagerOf('News');
        $managerscomments = $this->managers->getManagerOf('Comment');
        $managersmembers = $this->managers->getManagerOf('Author');

		$this->page->addVarPage('nombreNews', $manager->count());
        
        $this->page->addVarPage('comments', $managerscomments->getAllComment());
        $this->page->addVarPage('nombreComments', $managerscomments->count());

        $this->page->addVarPage('nombreMembers', $managersmembers->count());

    	}else{

    		$this->app->httpResponse()->page404();
    	}
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

	public function executeSeeAllMembers(HTTPRequest $request){

		$this->page->addVarPage('title', 'Liste des membres');

		$managercomments = $this->managers->getManagerOf('Author');

		$this->page->addVarPage('members', $managercomments->getAllMembers());

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
			$this->app->httpResponse()->redirect('blog/Autoload/admin/');
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

			
			$this->app->user()->setMessage($news->idNew() ? '<p class="message">L\'article à bien été ajouté !</p>' : '<p class="message">L\'article a bien été modifié ! </p>');
			$this->app->httpResponse()->redirect('/blog/Autoload/admin/');
		}

		$this->page->addVarPage('tinymce', $tinymce->createView());
	}
    
    public function executeUpdate(HTTPRequest $request){

		$this->processTinyMCEForm($request);

		$this->page->addVarPage('title', 'Modification de l\'article');
	}
    
    public function executeDelete(HTTPRequest $request){

		$this->managers->getManagerOf('News')->delete($request->getData('id'));
        
		$this->app->user()->setMessage('L\'article à bien été supprimé');

		$this->app->httpResponse()->redirect('/blog/Autoload/admin/all-post.html');
	}
    
    public function executeDeleteComment(HTTPRequest $request){

		$this->managers->getManagerOf('Comment')->delete($request->getData('id'));

		$this->app->user()->setMessage('Le commentaire à bien été supprimé !');

		$this->app->httpResponse()->redirect('.');
	}

	public function executeDeleteMember(HTTPRequest $request){

		$this->managers->getManagerOf('Author')->delete($request->getData('id'));

		$this->app->user()->setMessage('Le membre à bien été supprimé');

		$this->app->httpResponse()->redirect('/blog/Autoload/admin/all-members.html');
	}
    
    public function executeCommentValid(HTTPRequest $request){

		$this->managers->getManagerOf('Comment')->commentValid($request->getData('id'));

		$this->app->user()->setMessage('<p class="message">Le commentaire a bien été validé ! </p>');

		$this->app->httpResponse()->redirect("/blog/Autoload/admin/");
	}
}
