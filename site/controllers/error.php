<?php

return function($site, $pages, $page) {

  $path = kirby()->request()->path();

  if($path->nth(0) == 'forum') {
    if($page = page('forum/archive/' . $path->slice(1))) {
      go($page->url());
    }
  }

};