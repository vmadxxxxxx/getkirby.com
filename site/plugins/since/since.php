<?php

function version($version, $format) {

  $id = 'changelog/kirby-' . str_replace('.', '-', $version);

  if($log = page($id)) {
    return html::a($log->url(), sprintf($format, $version));
  } else {
    return '<span>' . sprintf($format, $version) . '</span>';
  }

}

kirbytext::$pre[] = function($kirbytext, $text) {



  return preg_replace_callback('!<since v="([0-9.]+)"\>(.*?)</since>!s', function($match) {

    if(version_compare(kirby::$version, $match[1], '<')) {
      $class = ' upcoming-feature';
    } else {
      $class = '';
    }

    $block  = '<div class="relative' . $class . '">';
    $block .= '<p class="version-badge">' . version($match[1], '%s +') . '</p>';
    $block .= kirbytext($match[2]);
    $block .= '</div>';
    return $block;

  }, $text);
};

field::$methods['future'] = function($field) {
  return version_compare(kirby::$version, $field->value(), '<');
};

field::$methods['version'] = function($field, $format = '%s') {
  return $field->isEmpty() ? '' : version($field->value(), $format);
};
