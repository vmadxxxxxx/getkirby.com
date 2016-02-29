<?php

class CheatsheetItemPage extends Page {
  /**
   * Replaces the class placeholders in the title field
   *
   * @param  Page  $section Parent page to use as the class
   * @return Field          Title field with replaced strings
   */
  public function title($section = null) {
    // if a "Call" field is still set, use that for now
    $field = (!parent::call()->empty())? 'call' : 'title';
    
    return $this->replaceClass($field, $section);
  }
  
  /**
   * Replaces the class placeholders in the call field
   *
   * @param  Page  $section Parent page to use as the class
   * @return Field          Call field with replaced strings
   */
  public function call($section = null) {
    return $this->replaceClass('call', $section);
  }
  
  /**
   * Returns a URL to the item with an optional section parameter
   *
   * @param  Page   $section Parent page to use as the class
   * @return string
   */
  public function url($section = null) {
    if(!is_a($section, 'Page') || $section === $this->parent()) return parent::url();
    
    return $section->url() . '/' . $this->uid();
  }
  
  /**
   * Returns the inheriting parent based on the section parameter
   *
   * @return Page
   */
  public function inheritingParent() {
    return ($section = get('section'))? page($section) : $this->parent();
  }
  
  /**
   * Checks if the inheriting parent is different from the actual parent
   *
   * @return boolean
   */
  public function hasInheritingParent() {
    return $this->parent() !== $this->inheritingParent();
  }
  
  /**
   * Returns the next page element
   * Respects the inherited children
   *
   * @return Page
   */
  public function next() {
    return $this->_next($this->inheritingParent()->inheritedChildren(), func_get_args());
  }
  
  /**
   * Returns the next visible page in the current collection if available
   * Respects the inherited children
   *
   * @param string $sort An optional sort field for the siblings
   * @param string $direction An optional sort direction
   * @return mixed Page or null
   */
  public function nextVisible() {
    if(!$this->inheritingParent()) {
      return null;
    } else {
      return $this->_next($this->inheritingParent()->inheritedChildren(), func_get_args(), 'visible');
    }
  }
  
  /**
   * Returns the next invisible page in the current collection if available
   * Respects the inherited children
   *
   * @param string $sort An optional sort field for the siblings
   * @param string $direction An optional sort direction
   * @return mixed Page or null
   */
  public function nextInvisible() {
    if(!$this->inheritingParent()) {
      return null;
    } else {
      return $this->_next($this->inheritingParent()->inheritedChildren(), func_get_args(), 'invisible');
    }
  }
  
  /**
   * Returns the previous page element
   * Respects the inherited children
   *
   * @return Page
   */
  public function prev() {
    return $this->_prev($this->inheritingParent()->inheritedChildren(), func_get_args());
  }
  
  /**
   * Returns the previous visible page in the current collection if available
   * Respects the inherited children
   *
   * @param string $sort An optional sort field for the siblings
   * @param string $direction An optional sort direction
   * @return mixed Page or null
   */
  public function prevVisible() {
    if(!$this->inheritingParent()) {
      return null;
    } else {
      return $this->_prev($this->inheritingParent()->inheritedChildren(), func_get_args(), 'visible');
    }
  }
  
  /**
   * Returns the previous invisible page in the current collection if available
   * Respects the inherited children
   *
   * @param string $sort An optional sort field for the siblings
   * @param string $direction An optional sort direction
   * @return mixed Page or null
   */
  public function prevInvisible() {
    if(!$this->inheritingParent()) {
      return null;
    } else {
      return $this->_prev($this->inheritingParent()->inheritedChildren(), func_get_args(), 'invisible');
    }
  }
  
  /**
   * Replaces the class placeholders in a given field
   *
   * @param  String $field   Field name to replace the class in
   * @param  Page   $section Parent page to use as the class
   * @return Field           Field with replaced strings
   */
  private function replaceClass($field, $section = null) {
    // get the section page manually if not passed
    if(!is_a($section, 'Page')) {
      // default to the parent of this page
      $section = $this->parent();
      
      // try to get URI from the current URL
      if($param = get('section')) {
        $paramSection = page($param);
        if($paramSection && $paramSection->template() === 'cheatsheet.section') {
          $section = $paramSection;
        }
      }
    }
    
    // prefer `class` field if set
    $class = ($section->class()->exists())? $section->class() : $section->title();
    
    // trim dollar symbols at the beginning
    // make sure the class starts with a lowercase letter
    $class = lcfirst(ltrim($class, '$'));
    
    // replace the values in the field
    $replacements = array(
      '{{class.instance}}' => '$' . $class,
      '{{class.static}}'   => $class
    );
    $value = str_replace(array_keys($replacements), $replacements, parent::$field());
    
    return new Field($this, $field, $value);
  }
}
