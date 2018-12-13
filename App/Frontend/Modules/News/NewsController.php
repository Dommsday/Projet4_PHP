<?php
namespace App\Frontend\Modules\News;

use \framework\BackController;
use \framework\HTTPRequest;
use \framework\FormHandler;
use \framework\AuthorFormHandler;
use \framework\AuthorConnexionFormHandler;
use \Entity\Comment;
use \Entity\Author;
use \framework\User;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\AuthorFormBuilder;
use \FormBuilder\AuthorFormConnexionBuilder;

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
      
    $user = new User;

    if($request->method() == 'POST'){

      $comment = new Comment([

        'news' => $request->getData('news'),
        'author' => $request->postData('author'),
        'content' => $request->postData('content')
      ]);

    }else{

      $comment = new Comment;
      $comment->setAuthor($user->getAttribute('login'));
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

    $author = new Author;

    $verif = $this->managers->getManagerOf('Author')->connexionIdentifiant($request->postData('pseudo'));

    $pseudo = htmlspecialchars($request->postData('pseudo'));
    $password = htmlspecialchars($request->postData('password'));
    $passwordConfirm = htmlspecialchars($request->postData('passwordConfirm'));
    $email = htmlspecialchars($request->postData('email'));

    $pseudoLength = $this->app->config()->get('pseudo_length');
    $passwordLength = $this->app->config()->get('password_length');

    if($request->method() == 'POST'){

      if($pseudo == $verif['pseudo']){

        $this->app->user()->setMessage('Le pseudo est déjà utilisé');

      }elseif(filter_var($email, FILTER_VALIDATE_EMAIL)){

        if(($passwordConfirm === $password) && (strlen($pseudo) >= $pseudoLength) && (strlen($password) >= $passwordLength)){

            $author = new Author([

            'pseudo' => htmlspecialchars($request->postData('pseudo')),
            'email' => htmlspecialchars($request->postData('email')),
            'password' => htmlspecialchars($request->postData('password')),
            'passwordConfirm' => htmlspecialchars($request->postData('passwordConfirm')),
          ]);

          }else{
        
            $this->app->user()->setMessage('Vos identifiants ne sont pas correctements entrés');
          }
      }
    }

    $formAuthorBuilder = new AuthorFormBuilder($author);
    $formAuthorBuilder->build();

    $authorform = $formAuthorBuilder->authorform();

    $formAuthorBuilder = new AuthorFormHandler($authorform, $this->managers->getManagerOf('Author'), $request);

    if($formAuthorBuilder->process()){

      $this->app->user()->setAuthenticated(true);
      $this->app->user()->setAttribute('login', $request->postData('pseudo'));
      $this->app->httpResponse()->redirect('/blog/Autoload/confirmation-inscription.html');

      
    }

    $this->page->addVarPage('authorform', $authorform->createView());
  }

  public function processAuthorFormConnexion(HTTPRequest $request){

    $author = new Author;

    $connexion = $this->managers->getManagerOf('Author')->connexionIdentifiant($request->postData('pseudo'));

    $password = htmlspecialchars($request->postData('password'));

    $isCorrect = password_verify($password, $connexion['password']);

    if($request->method() == 'POST'){

        if($isCorrect){

          $this->app->user()->setAttribute('login', $request->postData('pseudo'));
          $this->app->user()->setAttribute('administrator', $connexion['administrator']);
          $this->app->user()->setAuthenticated(true);
          $this->app->httpResponse()->redirect('/blog/Autoload/confirmation-connexion.html');

        }
    }

    $formAuthorConnexionBuilder = new AuthorFormConnexionBuilder($author);
    $formAuthorConnexionBuilder->build();

    $authorconnexionform = $formAuthorConnexionBuilder->authorconnexionform();

    $formAuthorConnexionBuilder = new AuthorConnexionFormHandler($authorconnexionform, $this->managers->getManagerOf('Author'), $request); 

    $this->page->addVarPage('authorconnexionform', $authorconnexionform->createView());

  }

    
  public function executeWarningComment(HTTPRequest $request){

    $this->managers->getManagerOf('Comment')->warning($request->getData('id'));
  }

  public function executeConnexion(HTTPRequest $request){

    $this->page->addVarPage('title', 'Connexion');

    $this->processAuthorFormConnexion($request);

  }

  public function executeConfirmeInscription(HTTPRequest $request){

    $this->page->addVarPage('title', 'Confirmation d\'inscription');
  }

  public function executeConfirmeConnexion(HTTPRequest $request){

    $this->page->addVarPage('title', 'Confirmation de connexion');
  }

  public function executeConfirmDeconnexion(HTTPRequest $request){

    $this->page->addVarPage('title', 'Déconnexion');

    $this->app->user()->setAuthenticated(false);

    session_destroy(); 
  }
}