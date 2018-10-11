<?php
namespace App\Frontend\Modules\News;

use \framework\BackController;
use \framework\HTTPRequest;

class NewsController extends BackController
{
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
  
  
}