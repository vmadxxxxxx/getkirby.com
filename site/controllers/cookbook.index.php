<?php

return function($site, $pages, $page) {

  if($cat = urldecode(param('category'))) {
    $items = $page->children()->visible()->filterBy('category', $cat);
  } else {
    $items = $page->children()->visible();
  }

  $categories = $page->children()->visible()->pluck('category', null, true);
  sort($categories, SORT_STRING | SORT_FLAG_CASE);


  return compact('items','categories');

};
