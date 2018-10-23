<?php
namespace FormBuilder;

use \framework\FormBuilder;
use \framework\StringField;
use \framework\TextField;
use \framework\MaxLengthValidator;
use \framework\NotNullValidator;

class NewsFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'pseudo',
        'name' => 'pseudo',
        'maxLength' => 20,
        'validators' => [
          new MaxLengthValidator('L\'auteur spécifié est trop long', 50),
          new NotNullValidator('Merci de spécifier l\'auteur de la news'),
        ],
       ]));

       $this->form->add(new StringField([
        'label' => 'Title',
        'name' => 'title',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le titre spécifié est trop long', 100),
          new NotNullValidator('Merci de spécifier le titre de la news'),
        ],
       ]));

      $this->form->add(new TextField([
        'label' => 'Content',
        'name' => 'content',
        'rows' => 8,
        'cols' => 60,
        'validators' => [
          new NotNullValidator('Merci de spécifier le contenu de la news'),
        ],
       ]));
  }
}