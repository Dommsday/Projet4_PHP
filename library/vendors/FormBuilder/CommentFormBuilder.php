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
        'label' => 'Pseudo',
        'name' => 'author',
        'id' => 'pseudo',
        'boots' => 'form-control',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('L\'auteur spécifié est trop long', 50),
          new NotNullValidator('Merci de spécifier l\'auteur du commentaire'),
        ],
       ]));
       $this->form->add(new TextField([
        'label' => 'Commentaire',
        'name' => 'content',
        'id' => 'comment',
        'boots' => 'form-control',
        'rows' => 7,
        'cols' => 50,
        'validators' => [
          new NotNullValidator('Merci de spécifier votre commentaire'),
        ],
       ]));
  }
}