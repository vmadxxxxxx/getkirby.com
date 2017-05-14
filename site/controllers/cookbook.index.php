<?php

return function($site, $pages, $page) {

  if($cat = urldecode(param('category'))) {
    if($cat == 'new') {
      $items = $page->children()->visible()->sortBy('date', 'desc')->limit(6);
    } else {
      $items = $page->children()->visible()->filterBy('category', $cat, ',');
    }
  } else {
    $items = $page->children()->visible();
  }

  $categories = $page->children()->visible()->pluck('category', ',', true);
  sort($categories, SORT_STRING | SORT_FLAG_CASE);


  return compact('items','categories');

};
