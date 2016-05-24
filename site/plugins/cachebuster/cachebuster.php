<?php 

if(!$kirby->option('cachebuster')) return;

load([
  'cachebuster\\css' => __DIR__ . DS . 'lib' . DS . 'css.php',
  'cachebuster\\js'  => __DIR__ . DS . 'lib' . DS . 'js.php',
]);

$kirby->set('component', 'css', 'cachebuster\\css');
$kirby->set('component', 'js',  'cachebuster\\js');