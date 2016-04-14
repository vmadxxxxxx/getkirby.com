<?php

return function($site, $pages, $page) {

  if(!c::get('algolia.app')) {
    go();
  }

  $query = trim(get('q'));
  
  if(!empty($query)) {
    $results = algolia()->search($query, param('page'), [
      'hitsPerPage'           => 50,
      'typoTolerance'         => false,
      'attributesToHighlight' => false,
      'attributesToSnippet'   => '*',
    ]);
  } else {
    $results = new Collection;
    $results = $results->paginate(10);
  }

  return [
    'results' => $results,
    'query'   => html(strip_tags($query), false),
  ];

};