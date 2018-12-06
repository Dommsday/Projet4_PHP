<?php
namespace framework;

class EmailField extends Field{  

  public function buildWidget(){

    $widget = '';
    
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }
    
    $widget .= '<label for="'.$this->id.'">'.$this->label.'</label><input type="email" name="'.$this->name.'" id="'.$this->id.'" class="'.$this->boots.'" placeholder="'.$this->placeholder.'"/><span id="'.$this->idSpan.'"';
    
    return $widget .= '></span>';
  }
  
}
