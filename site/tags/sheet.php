<?php

kirbytext::$tags['sheet'] = array(
  'attr' => array(
    'text'
  ),
  'html' => function($tag) {

    if($page = page('docs/cheatsheet/' . $tag->attr('sheet'))) {
      return $page->title()->link(); 
    } else {
      return $tag->attr('sheet');
    }
  }
);
