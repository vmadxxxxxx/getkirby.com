<?php

class Inspector {

  public $results = array();

  public function __construct() {
    $this->inspectKirbyOptions();
    $this->inspectPanelOptions();
  } 

  protected function inspectOptions($options) {
    $page     = page('docs/cheatsheet/options');
    $children = $page->children();
    foreach($options as $key => $value) {
      if(!$children->find(str::slug($key))) {
        $this->results[] = 'Missing option: ' . $key;
      }
    }
  }

  public function inspectKirbyOptions() {
    $this->inspectOptions(kirby()->defaults());  
  }

  public function inspectPanelOptions() {
    $root = kirby()->roots()->index() . DS . '/panel';
    require_once($root . DS . '/app/bootstrap.php');
    $panel = new Kirby\Panel(kirby(), $root);
    $this->inspectOptions($panel->defaults());
  }

  public function results() {
    return $this->results;
  } 

}