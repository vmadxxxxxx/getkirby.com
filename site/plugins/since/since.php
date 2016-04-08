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

  $text = preg_replace_callback('!<since v="([0-9.]+)"\>!', function($match) {
    $block  = '<div class="relative" markdown="1">';
    $block .= '<p class="version-badge">' . version($match[1], '%s +') . '</p>';
    return $block;
  }, $text);

  $text = str_replace('</since>', '</div>', $text);

  return $text;

};

field::$methods['future'] = function($field) {
  return version_compare(kirby::$version, $field->value(), '<');
};

field::$methods['version'] = function($field, $format = '%s') {
  return $field->isEmpty() ? '' : version($field->value(), $format);
};