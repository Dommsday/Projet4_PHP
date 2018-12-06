<?php
namespace framework;

class StringField extends Field
{
  
  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage)){

      $widget .= $this->errorMessage.'<br />';
    }
    
    $widget .= '<label for="'.$this->id.'">'.$this->label.'</label><input type="text" name="'.$this->name.'" id="'.$this->id.'" class="'.$this->boots.'" placeholder="'.$this->placeholder.'" maxlength="'.$this->maxLength.'"/><span id="'.$this->idSpan.'"';
    
    return $widget .= '></span>';
  }
  
}
