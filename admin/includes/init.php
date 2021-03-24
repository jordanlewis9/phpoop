<?php
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', 'C:' . DS . 'wamp64' . DS . 'www' . DS . 'oopcms');
define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'includes');
require_once("functions.php");
require_once("new_config.php");
require_once("db_object.php");
require_once("database.php");
require_once("user.php");
require_once("session.php");
require_once("photo.php");
?>