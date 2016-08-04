<?php

return function($site, $pages, $page) {

  $today = mktime(0, 0, 0, date("m"), date("d"),   date("Y"));
  $twoMonthsAgo = mktime(0, 0, 0, date("m")-2, date("d"),   date("Y"));

  if($cat = urldecode(param('category'))) {
    if($cat == 'new') {
      $items = $page->children()->visible()->filterBy('date', '>', $twoMonthsAgo)->filterBy('date', '<', $today);
    } else {
      $items = $page->children()->visible()->filterBy('category', $cat);
    }
  } else {
    $items = $page->children()->visible();
  }

  $categories = $page->children()->visible()->pluck('category', ',', true);
  sort($categories, SORT_STRING | SORT_FLAG_CASE);


  return compact('items','categories');

};
