<?php
namespace FormBuilder;

use \framework\FormBuilder;
use \framework\StringField;
use \framework\TextField;
use \framework\MaxLengthValidator;
use \framework\NotNullValidator;

class CommentFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'author',
        'name' => 'author',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('L\'auteur spécifié est trop long', 50),
          new NotNullValidator('Merci de spécifier l\'auteur du commentaire'),
        ],
       ]))
       ->add(new TextField([
        'label' => 'Content',
        'name' => 'content',
        'rows' => 7,
        'cols' => 50,
        'validators' => [
          new NotNullValidator('Merci de spécifier votre commentaire'),
        ],
       ]));
  }
}