<?php

return function($site, $pages, $page) {

  if(c::get('cache.cheatsheet')) {
    $cache   = new Cache\Driver\File(kirby()->roots()->cache());
    $cacheId = sha1($page->id()) . '.main';
    $content = $cache->get($cacheId);    
  } else {
    $content = null;
  }

  if(empty($content)) {    
    $content = snippet('cheatsheet', array('page' => $page), true);
    if(c::get('cache.cheatsheet')) {
      $cache->set($cacheId, $content);
    }
  }

  return compact('content');

};