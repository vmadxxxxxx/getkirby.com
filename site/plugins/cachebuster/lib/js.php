<?php 

namespace Cachebuster;

use F;

class JS extends \Kirby\Component\JS {

  public function tag($url, $async = null) {
    
    if(!is_array($url) && file_exists($this->kirby->roots()->index() . DS . $url)) {
      $file = $this->kirby->roots()->index() . DS . $url;
      $mod  = f::modified($file);
      $url  = dirname($url) . '/' . f::name($url) . '.' . $mod . '.js';      
    }

    return parent::tag($url, $async);

  }

}