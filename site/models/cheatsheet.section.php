<?php

class CheatsheetSectionPage extends Page {
  protected $inheritedChildren = null;
  
  /**
   * Returns the children of the category and the inherited children
   *
   * @return Pages
   */
  public function inheritedChildren() {
    if($this->extends()->empty()) return $this->inheritedChildren = $this->children();
    if(!($parent = page($this->extends()))) return $this->inheritedChildren = $this->children();
    
    // get the inherited children of the parent class
    $children = $parent->inheritedChildren();
    if(!is_a($children, 'Pages')) return $this->inheritedChildren = $this->children();
    
    foreach($this->children() as $p) {
      // remove the inherited page first
      $children = $children->not($p->uid());
      
      // add the own child
      $children->append($p->id(), $p);
    }
    
    return $this->inheritedChildren = $children->sortBy('uid');
  }
  
  /**
   * Returns a linked subtitle regarding the inheritance
   * 
   * Expects the content file to contain a field named "extendingMode"
   * to be either "inherits", "toolkit" or "other"
   *
   * @return string
   */
  public function extendingModeLink() {
    if(!($parent = page($this->extends()))) return null;
    $url = $parent->url();
    $title = $parent->title();
    
    $return = null;
    switch($this->extendingMode()) {
      case 'inherits':
        $return = 'Inherits from <a href="' . $url . '">' . $title . '</a>';
        break;
      case 'toolkit':
        $return = 'Part of the <a href="' . $url . '">Kirby Toolkit</a>';
        break;
      default:
        $return = 'See also <a href="' . $url . '">' . $title . '</a>';
        break;
    }
    
    return $return;
  }
}
