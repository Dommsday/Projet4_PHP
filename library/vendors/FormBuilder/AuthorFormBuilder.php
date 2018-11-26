<?php
namespace FormBuilder;

use \framework\AuthorBuilder;
use \framework\StringField;
use \framework\PasswordField;
use \framework\PasswordConfirmField;
use \framework\EmailField;
use \framework\MaxLengthValidator;
use \framework\NotNullValidator;

class AuthorFormBuilder extends AuthorBuilder{
  
  public function build()
  {
    $this->authorform->add(new StringField([
        'label' => 'Pseudo',
        'name' => 'pseudo',
        'id' => 'pseudo',
        'boots' => 'form-control',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('L\'auteur spécifié est trop long', 50),
          new NotNullValidator('Merci de spécifier le pseudo'),
        ],
       ]));

       $this->authorform->add(new PasswordField([
        'label' => 'Mot de Passe',
        'name' => 'password',
        'id' => 'password',
        'boots' => 'form-control',
        'validators' => [
          new NotNullValidator('Merci de spécifier votre mot de passe'),
        ],
       ]));


       $this->authorform->add(new PasswordField([
        'label' => 'Retaper Mot de Passe',
        'name' => 'passwordConfirm',
        'id' => 'passwordConfirm',
        'boots' => 'form-control',
        'validators' => [
          new NotNullValidator('Merci de spécifier le même mot de passe que le précédent '),
        ],
       ])); 

       $this->authorform->add(new EmailField([
        'label' => 'E-mail',
        'name' => 'email',
        'id' => 'email',
        'boots' => 'form-control',
        'validators' => [
          new NotNullValidator('Merci de spécifier une adresse mail valide'),
        ],
       ]));
  }
}