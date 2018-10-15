<?php
namespace App\Frontend\Modules\News;

use \framework\BackController;
use \framework\HTTPRequest;

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
  
   //Méthode pour affichier un article précis
  public function executePost(HTTPRequest $request){

    $post = $this->managers->getManagerOf("News")->getPost($request->getData('id'));

    if(empty($post)){

      $this->app->httpResponse()->page404();
    }

    $this->page->addVarPage('title', $post->title());
    $this->page->addVarPage('post', $post);

  }
    
    //Méthode pour ajouter un commentaire
  public function executeInsertComment(HTTPRequest $request){

    $this->page->addVarPage('title', 'Ajout d\'un commentaire');

    if($request->postExists('pseudo')){

      $comment = new Comment([
        'news' => $request->getData('news'),
        'author' => $request->getData('pseudo'),
        'content' => $request->getData('content')
      ]);

      if($comment->Valid()){

        $this->managers->getManagerOf('Comment')->save($comment);

        $this->app->httpResponse()->redirect('news-'.$request->getData('news').'.html');

      }else{

        $this->page->addVarPage('erreurs', $comment->erreurs());
      }

      $this->page->addVarPage('comment', $comment);
    }
  }
}