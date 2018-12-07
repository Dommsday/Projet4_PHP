<?php
namespace FormBuilder;

use \framework\AuthorBuilder;
use \framework\StringField;
use \framework\PasswordField;
use \framework\PasswordConfirmField;
use \framework\EmailField;
use \framework\NotNullValidator;

class AuthorFormBuilder extends AuthorBuilder{
  
  public function build()
  {
    $this->authorform->add(new StringField([
        'label' => 'Pseudo',
        'name' => 'pseudo',
        'id' => 'pseudo',
        'placeholder' => "6 caractères minimum",
        'maxLength' => '20',
        'boots' => 'form-control',
        'idSpan' => 'pseudoHelp',
        'validators' => [
          new NotNullValidator('Merci de spécifier le pseudo'),
        ],
       ]));

       $this->authorform->add(new PasswordField([
        'label' => 'Mot de Passe',
        'name' => 'password',
        'id' => 'password',
        'placeholder' => '8 caractères minimum',
        'boots' => 'form-control',
        'idSpan' => 'passwordHelp',
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
        'placeholder' => 'Ex: aaa@bb.cc',
        'idSpan' => 'emailHelp',
        'boots' => 'form-control',
        'validators' => [
          new NotNullValidator('Merci de spécifier une adresse mail valide'),
        ],
       ]));
  }
}