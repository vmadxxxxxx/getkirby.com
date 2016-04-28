<?php

return function($site, $pages, $page) {

  $path = kirby()->request()->path();

  // rewrite old urls
  $aliases = [
    'docs/security'                                  => 'docs/developer-guide/security',
    'docs/advanced/options'                          => 'docs/developer-guide/configuration/options',
    'docs/advanced/customized-folder-setup'          => 'docs/developer-guide/configuration/folders',
    'docs/advanced/routing'                          => 'docs/developer-guide/advanced/routing',
    'docs/advanced/caching'                          => 'docs/developer-guide/advanced/caching',
    'docs/advanced/kirbytext'                        => 'docs/developer-guide/kirbytext/tags',
    'docs/advanced/field-methods'                    => 'docs/developer-guide/objects/fields',
    'docs/advanced/filter-methods'                   => 'docs/developer-guide/objects/collections',
    'docs/thumbnails/building-your-own-thumb-driver' => 'docs/developer-guide/toolkit/thumb-driver',
    'docs/thumbnails/configuration'                  => 'docs/developer-guide/configuration/thumbnails',
    'docs/thumbnails'                                => 'docs/templates/thumbnails',
    'docs/thumbnails/creating-thumbnails'            => 'docs/templates/thumbnails',
    'docs/thumbnails/troubleshooting'                => 'docs/developer-guide/troubleshooting/thumbnails',
    'docs/toolkit/databases'                         => 'docs/developer-guide/toolkit/database',
    'docs/toolkit/uploads'                           => 'docs/developer-guide/toolkit/upload',
    'docs/toolkit/routing'                           => 'docs/developer-guide/toolkit/routing',
    'docs/toolkit/sending-email'                     => 'docs/developer-guide/advanced/emails',
    'docs/panel/developers'                          => 'docs/developer-guide/panel',
    'docs/panel/developers/custom-form-fields'       => 'docs/developer-guide/panel/fields',
    'docs/panel/developers/custom-css'               => 'docs/developer-guide/panel/css',
    'docs/panel/developers/widgets'                  => 'docs/developer-guide/panel/widgets',
    'docs/panel/developers/translations'             => 'docs/developer-guide/panel/translations',
    'docs/panel/developers/hooks'                    => 'docs/developer-guide/advanced/hooks',
  ]; 

  if(isset($aliases[(string)$path])) {
    go($aliases[(string)$path]);
  }

  if($path->nth(0) == 'forum') {
    if($page = page('forum/archive/' . $path->slice(1))) {
      go($page->url());
    }
  }

};