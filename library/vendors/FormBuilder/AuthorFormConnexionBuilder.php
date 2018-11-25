<?php
namespace FormBuilder;

use \framework\AuthorConnexionBuilder;
use \framework\StringField;
use \framework\PasswordField;
use \framework\MaxLengthValidator;
use \framework\NotNullValidator;

class AuthorFormConnexionBuilder extends AuthorConnexionBuilder{
  
  public function build()
  {
    $this->authorconnexionform->add(new StringField([
        'label' => 'Pseudo',
        'name' => 'pseudo',
        'id' => 'pseudo',
        'boots' => 'form-control',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('L\'auteur spécifié est trop long', 50),
          new NotNullValidator('Merci de spécifier l\'auteur du commentaire'),
        ],
       ]));

       $this->authorconnexionform->add(new PasswordField([
        'label' => 'Mot de Passe',
        'name' => 'password',
        'id' => 'password',
        'boots' => 'form-control',
        'validators' => [
          new NotNullValidator('Merci de spécifier votre mot de passe'),
        ],
       ]));
  }
}