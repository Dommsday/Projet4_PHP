<?php
namespace FormBuilder;

use \framework\AuthorConnexionBuilder;
use \framework\StringField;
use \framework\PasswordField;
use \framework\NotNullValidator;

class AuthorFormConnexionBuilder extends AuthorConnexionBuilder{
  
  public function build()
  {
    $this->authorconnexionform->add(new StringField([
        'label' => 'Pseudo',
        'name' => 'pseudo',
        'id' => 'pseudo',
        'maxLength' => '20',
        'boots' => 'form-control',
        'validators' => [
          new NotNullValidator('Merci de spécifier le pseudo'),
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