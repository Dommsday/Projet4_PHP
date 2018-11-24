<?php
namespace App\Frontend\Modules\News;

use \framework\BackController;
use \framework\HTTPRequest;
use \framework\FormHandler;
use \framework\AuthorFormHandler;
use \Entity\Comment;
use \Entity\Author;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\AuthorFormBuilder;

class NewsController extends BackController
{
    
     //Méthode pour afficher les derniers articles postés
  public function executeIndex(HTTPRequest $request)
  {
    $nombreNews = $this->app->config()->get('nombre_news');
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
    
    // On ajoute une définition pour le titre.
    $this->page->addVarPage('title', 'Liste des '.$nombreNews.' dernières news');
    
    // On récupère le manager des news.
    $manager = $this->managers->getManagerOf('News');
    
    $listNews = $manager->getList(0, $nombreNews);
    
    foreach ($listNews as $news)
    {
      if (strlen($news->content()) > $nombreCaracteres)
      {
        $debut = substr($news->content(), 0, $nombreCaracteres);
        $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
        
        $news->setContent($debut);
      }
    }
    
    // On ajoute la variable $listeNews à la vue.
    $this->page->addVarPage('listNews', $listNews);
  }
  
  public function executeAllPost(){
    $this->page->addVarPage('title', 'Liste des articles');

    $manager = $this->managers->getManagerOf('News');

    $this->page->addVarPage('listNews', $manager->getList());
  }

   //Méthode pour affichier un article précis
  public function executePost(HTTPRequest $request){

    $post = $this->managers->getManagerOf("News")->getPost($request->getData('id'));

    if(empty($post)){

      $this->app->httpResponse()->page404();
    }

    $this->page->addVarPage('title', $post->title());
    $this->page->addVarPage('post', $post);
    $this->page->addVarPage('comments', $this->managers->getManagerOf('Comment')->getListOf($post->id()));
  }
    
    //Méthode pour ajouter un commentaire
  public function executeInsertComment(HTTPRequest $request){
      
      
    if($request->method() == 'POST'){

      $comment = new Comment([

        'news' => $request->getData('news'),
        'author' => $request->postData('author'),
        'content' => $request->postData('content')
      ]);

    }else{

      $comment = new Comment;
    }

    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();

    $form = $formBuilder->form();
      
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comment'), $request);

    if($formHandler->process()){

      $this->app->user()->setMessage('Le commentaire a bien été ajouté !');
      $this->app->httpResponse()->redirect('news-'.$request->getData('news').'.html');
    }

    $this->page->addVarPage('comment', $comment);
    $this->page->addVarPage('form', $form->createView());
    $this->page->addVarPage('title', 'Ajout d\'un commentaire');
   
  }

  public function executeInscription(HTTPRequest $request){

    $this->processAuthorForm($request);

    $this->page->addVarPage('title', 'Inscription');
  }

  public function processAuthorForm(HTTPRequest $request){

    if($request->method() == 'POST'){

      $author = new Author([

        'pseudo' => $request->postData('pseudo'),
        'email' => $request->postData('email'),
        'password' => $request->postData('password')
      ]);

    }else{

     $author = new Author;

    }

    $formAuthorBuilder = new AuthorFormBuilder($author);
    $formAuthorBuilder->build();

    $authorform = $formAuthorBuilder->authorform();

    $formAuthorBuilder = new AuthorFormHandler($authorform, $this->managers->getManagerOf('Author'), $request);

    if($formAuthorBuilder->process()){

      $this->app->user()->setAuthenticated(true);

      $this->app->httpResponse()->redirect('.');
    }

    $this->page->addVarPage('authorform', $authorform->createView());
  }
    
  public function executeWarningComment(HTTPRequest $request){

    $this->managers->getManagerOf('Comment')->warning($request->getData('id'));
  }

  public function executeConnexion(HTTPRequest $request){

    $this->page->addVarPage('title', 'Connexion');

    $manager = $this->managers->getManagerOf('Author');

    $this->page->addVarPage('connexion', $manager->connexionIdentifiant($request->postData('login'), $request->postData('password')));

    $login = $request->postData('login');
    $password = $request->postData('password');

    $passwordCorrect = password_verify($password, $connexion['password']);

    if(!empty($login)){

      echo 'login rempli';

    }else{

      echo 'login vide';

    }
  }

}

