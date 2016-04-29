<?php

kirbytext::$tags['toolkit'] = array(
  'attr' => array(
    'text'
  ),
  'html' => function($tag) {

    if($page = page('docs/toolkit/api/' . $tag->attr('toolkit'))) {
      return $page->title()->link(); 
    } else {
      return $tag->attr('toolkit');
    }
  }
);
