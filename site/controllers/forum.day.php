<?php

return function($site, $pages, $page) {

  $topics     = $page->children()->paginate(20);
  $pagination = $topics->pagination();

  return compact('topics', 'pagination');

};