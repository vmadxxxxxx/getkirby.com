<?php

kirbytext::$tags['docs'] = array(
  'attr' => array(
    'field'
  ),
  'html' => function($tag) {
    return kirbytext(tpl::load(kirby()->roots()->snippets() . DS . 'docs' . DS .  $tag->attr('docs') . '.php', [
      'page'  => $tag->page(),
      'field' => $tag->attr('field')
    ]));
  }
);
