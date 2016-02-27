<?php

return function($site, $pages, $page) {
  if($section = get('section')) {
    $sectionPage   = page($section);
    $inheritedPage = $sectionPage->inheritedChildren()->find($page->uid());
    $inherited     = true;
  } else {
    $sectionPage   = $page->parent();
    $inheritedPage = $page;
    $inherited     = false;
  }
  
  $overviewPage = $sectionPage->parent();
  
  return compact('inherited', 'sectionPage', 'overviewPage', 'inheritedPage');
};
