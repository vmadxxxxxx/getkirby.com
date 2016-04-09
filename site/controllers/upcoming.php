<?php

return function($site, $pages, $page) {

  $upcoming = page('docs')->index()->filter(function($page) {
    return $page->since()->future();
  })->sortBy('title', 'desc');

  return [
    'upcoming'  => $upcoming,
    'changelog' => page('changelog')->children()->last()
  ];

};