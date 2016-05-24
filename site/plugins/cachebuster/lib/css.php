<?php 

namespace Cachebuster;

use F;

class CSS extends \Kirby\Component\CSS {

  public function tag($url, $media = null) {
    
    if(!is_array($url) && file_exists($this->kirby->roots()->index() . DS . $url)) {
      $file = $this->kirby->roots()->index() . DS . $url;
      $mod  = f::modified($file);
      $url  = dirname($url) . '/' . f::name($url) . '.' . $mod . '.css';      
    }

    return parent::tag($url, $media);

  }

}