<?php 

function imgix($url, $params = array()) {

  if(is_object($url)) {
    $url = $url->url();
  } 

  $url = trim(str_replace(url(), '', $url), '/');
  $url = 'https://getkirby.imgix.net/' . $url . '?' . http_build_query($params);

  return $url;

}