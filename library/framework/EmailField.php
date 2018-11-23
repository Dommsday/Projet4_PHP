<?php
namespace framework;

class EmailField extends Field{  

  public function buildWidget(){

    $widget = '';
    
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }
    
    $widget .= '<label for="'.$this->id.'">'.$this->label.'</label><input type="email" name="'.$this->name.'" id="'.$this->id.'" class="'.$this->boots.'"';
    
    if (!empty($this->value))
    {
      
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }
    
    return $widget .= ' />';
  }
  
}
