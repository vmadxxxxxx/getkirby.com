<?php

c::set('stage', false);
c::set('markdown.extra', true);
c::set('cache.driver', 'file');

c::set('routes', array(
  array(
    'pattern' => 'docs.json',
    'action'  => function() {

      $cache = new Cache\Driver\File(kirby()->roots()->cache());
      $data  = $cache->get('docs');

      if(empty($data)) {
        $data = page('docs')->index()->visible()->sortBy('title', 'asc')->toArray(function($item) {
          return array(
            'title' => $item->title()->toString(),
            'uri'   => $item->uri()
          );
        });
        $data = array_values($data);
        $cache->set('docs', $data);
      }

      return response::json($data);
    }
  ),
  array(
    'pattern' => 'docs/toolkit/generate', 
    'action'  => function() {
      
      if(c::get('documentor')) {

        $documentor = new Documentor();
        $data       = $documentor->start();

        dump($data);

      } else {
        go();
      }

    }
  ),
  array(
    'pattern' => 'blog/feed', 
    'action'  => function() {
      go('feed');
    }
  ),
));



c::set('cdn.assets', 'http://assets.getkirby.com/assets');
c::set('cdn.content', 'http://assets.getkirby.com/content');
c::set('cdn.thumbs', 'http://assets.getkirby.com/thumbs');
c::set('cachebuster', true);

c::set('cache.cheatsheet', true);