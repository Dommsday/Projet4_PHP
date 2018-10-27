<?php
namespace FormBuilder;

use \framework\TinyMCEBuilder;
use \framework\StringField;
use \framework\TextTinyField;
use \framework\MaxLengthValidator;
use \framework\NotNullValidator;

class NewsTinyMCEFormBuilder extends TinyMCEBuilder
{
  public function build()
  {
    $this->tinymce->add(new StringField([
        'label' => 'author',
        'name' => 'author',
        'maxLength' => 20,
        'validators' => [
          new MaxLengthValidator('L\'auteur spécifié est trop long', 50),
          new NotNullValidator('Merci de spécifier l\'auteur de la news'),
        ],
       ]));

       $this->tinymce->add(new StringField([
        'label' => 'Title',
        'name' => 'title',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le titre spécifié est trop long', 100),
          new NotNullValidator('Merci de spécifier le titre de la news'),
        ],
       ]));

      $this->tinymce->add(new TextTinyField([
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