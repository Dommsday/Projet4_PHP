<?php
namespace App\Frontend\Modules\News;

use \framework\BackController;
use \framework\HTTPRequest;
use \Entity\Comment;
use \framework\Form;
use \framework\StringField;
use \framework\Textfield;

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
    $this->page->addVarPage('comments', $this->managers->getManagerOf('Comment')->getListOf($post->id()));
  }
    
    //Méthode pour ajouter un commentaire
  public function executeInsertComment(HTTPRequest $request){

   if($request->method() == 'POST'){

      $comment = new Comment([

        'author' => $request->getData('pseudo'),
        'news' => $request->getData('news'),
        'content' => $request->getData('content')
      ]);

    }else{

      $comment = new Comment;
    }

    $form = new Form($comment);

    $form->add(new StringField([
      'label' => 'Author',
      'name' => 'pseudo',
      'maxLength' => 50
    ]));

    $form->add(new Textfield([
      'label' => 'Content',
      'name' => 'content',
      'cols'=> 50,
      'rows' => 7
    ]));

    if($form->Valid()){


    }

    $this->page->addVarPage('comment', $comment);
    $this->page->addVarPage('form', $form->createView());
    $this->page->addVarPage('title', 'Ajour d\'un commentaire');
  }
  }
}