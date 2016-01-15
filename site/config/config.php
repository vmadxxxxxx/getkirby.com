<?php

header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Content-Security-Policy-Report-Only: default-src https: \'unsafe-inline\' \'unsafe-eval\'');

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
    'pattern' => 'docs/inspect', 
    'action'  => function() {

      if(c::get('inspector')) {

        $inspector = new Inspector();
        var_dump($inspector->results());

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



c::set('cdn.assets', 'https://assets.getkirby.com/assets');
c::set('cdn.content', 'https://assets.getkirby.com/content');
c::set('cdn.thumbs', 'https://assets.getkirby.com/thumbs');
c::set('cachebuster', true);


c::set('cache.cheatsheet', true);