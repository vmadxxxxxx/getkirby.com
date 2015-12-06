<?php

use \phpDocumentor\Reflection\DocBlock;

class Documentor {

  public $uri  = null;
  public $root = null;

  public function __construct() {
    require(__DIR__ . DS . 'vendor' . DS . 'autoload.php');

    $this->uri  = 'docs/toolkit/api';
    $this->root = kirby()->roots()->kirby() . DS . 'toolkit' . DS . 'lib';

  }

  public function glob($pattern, $flags = 0) {
    $files = glob($pattern);
    foreach(glob(dirname($pattern) . '/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
      $files = array_merge($files, $this->glob($dir . DS . basename($pattern), $flags));
    }
    sort($files);
    return $files;
  }

  public function start() {

    $classes = $this->glob($this->root . '/*.php');
    $data    = array();

    foreach($classes as $class) {
      $data[] = $this->fetchClass($class);
    } 

    return $this->build($data);

  }

  public function fetchClass($classRoot) {

      $className  = str_replace($this->root, '', $classRoot);
      $className  = str_replace('.php', '', $className);
      $className  = ltrim($className, '/');
      $className  = str_replace('/', '\\', $className);
      $classTitle = str_replace('\\', '\\\\', $className);
      $classSlug  = str::slug($className);
      $reflection = new ReflectionClass($className);
      $classData  = array(
        'name'    => $classTitle,
        'slug'    => $classSlug,
        'methods' => array(),
      );

      foreach($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
        $classData['methods'][] = $this->fetchMethod($classTitle, $method);
      }

      return $classData;

  }

  public function fetchMethod($className, $method) {

    $phpdoc = new DocBlock($method->getDocComment());
    $call   = array();
    $params = array();
    $return = null;

    // build the call example string
    foreach($method->getParameters() as $param) {
      if($param->isOptional()) {

        try {
          $value = var_export($param->getDefaultValue(), true);
          $value = str_replace(PHP_EOL, '', $value);
          $value = str_replace('NULL', 'null', $value);
          $value = str_replace('array ()', 'array()', $value);          
          $call[] = '$' . $param->getName() . ' = ' . $value;
        } catch(Exception $e) {
          $call[] = '$' . $param->getName(); 
        }

      } else {
        $call[] = '$' . $param->getName();        
      }
    }

    // get all parameter docs
    foreach($phpdoc->getTags() as $tag) {        
      switch($tag->getName()) {
        case 'param':
          $params[] = array(
            'name' => $tag->getVariableName(),
            'type' => $tag->getType(),
            'text' => $tag->getDescription()
          );
          break;
        case 'return':
          $return = array(
            'type' => $tag->getType(),
            'text' => $tag->getDescription()
          );
          break;
      }
    }

    // a::first
    $methodName = strtolower($className) . '::' . $method->getName();
    $methodSlug = str::slug($method->getName());

    // build the full method array
    return array(
      'name'    => $methodName, 
      'slug'    => $methodSlug,
      'excerpt' => str_replace(PHP_EOL, ' ', $phpdoc->getShortDescription()), 
      'call'    => $methodName . '(' . implode(', ', $call) . ')', 
      'return'  => $return, 
      'params'  => $params
    );

  }

  public function build($data) {

    $docs = page($this->uri);

    foreach($data as $class) {

      if($classPage = $docs->find($class['slug'])) {
        $this->updateClassPage($docs, $class, $classPage);
      } else {
        $this->createClassPage($docs, $class);
      }

    }

  }

  protected function createClassPage($docs, $class) {

    try {

      $classPage = $docs->children()->create('0-' . $class['slug'], 'cheatsheet.item', array(
        'title' => $class['name'],
      ));

      var_dump($classPage->uri() . ' has been created');

      foreach($class['methods'] as $method) {
        
        if($methodPage = $classPage->find($method['slug'])) {
          $this->updateMethodPage($method, $methodPage);          
        } else {
          $this->createMethodPage($classPage, $method);          
        }

      }

    } catch(Exception $e) {
      var_dump($e->getMessage());
    } 

  }

  protected function updateClassPage($docs, $class, $classPage) {

    try {
      $classPage->update(array(
        'title' => $class['name'],
      ));
      var_dump($classPage->uri() . ' has been updated');
    } catch(Exception $e) {
      var_dump($e->getMessage());
    } 

  }

  protected function createMethodPage($classPage, $method) {

    try {
      $methodPage = $classPage->children()->create('0-' . $method['slug'], 'cheatsheet.item', array(
        'title'   => $method['name'],
        'excerpt' => $method['excerpt'],
        'call'    => $method['call'],
        'return'  => yaml::encode($method['return']),
        'params'  => yaml::encode($method['params']),
      ));
      var_dump($methodPage->uri() . ' has been created');
    } catch(Exception $e) {
      var_dump($e->getMessage());
    }

  }

  protected function updateMethodPage($method, $methodPage) {

    try {
      $methodPage->update(array(
        'title'   => $method['name'],
        'excerpt' => $method['excerpt'],
        'call'    => $method['call'],
        'return'  => yaml::encode($method['return']),
        'params'  => yaml::encode($method['params']),
      ));
      var_dump($methodPage->uri() . ' has been updated');
    } catch(Exception $e) {
      var_dump($e->getMessage());
    } 

  }


}