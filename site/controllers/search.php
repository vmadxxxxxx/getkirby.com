<?php

return function($site, $pages, $page) {

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
  }

  return [
    'results' => $results,
    'query'   => html(strip_tags($query), false),
  ];

};