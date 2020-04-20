<?php

define('APPLICATION_PATH', realpath(dirname(__FILE__)) . '/../src');
define('SITE_PATH', realpath(dirname(__FILE__)) . '/');
define('VIEW_PATH', APPLICATION_PATH . '/Application/View');

set_include_path(
    SITE_PATH . '../vendor' . PATH_SEPARATOR .
    APPLICATION_PATH . PATH_SEPARATOR .
    get_include_path()
);

require_once 'CRUD/Autoloader.php';
require_once('../config/config.php');


// Executa o router que escolhe qual controller acionar
try {
    $loader = new CRUD\Autoloader();
    $loader->register();
    CRUD\Router::run(new CRUD\Request());
} catch (\Exception $e) {
    new Application\Controller\Error($e->getMessage());
}
