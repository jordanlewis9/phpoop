<?php

function classAutoLoader($class) {
  $class = strtolower($class);
  $the_path = "includes/{$class}.php";
  if (is_file($the_path) && !class_exists($class)) {
    require_once($the_path);
  } else {
    die("The file name {$class}.php was not found.");
  }
}

spl_autoload_register('classAutoLoader');

?>