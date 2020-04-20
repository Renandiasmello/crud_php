<?php

## Dados de conexão com banco

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'crud_php');
define('DB_USER', 'root');
define('DB_PASS', '');

## Geralmente crio essa constante 'DS' por causa das barras q são diferentes no Windows e no Linux 
define('DS', DIRECTORY_SEPARATOR);

# Pega o caminho completo conforme o diretorio desse arquivo
define('PATH', dirname(__DIR__));

# Verifica se roudou as dependencias definidas no composer.json
$composer_autoload = PATH . DS . 'vendor' . DS . 'autoload.php';

if (!file_exists($composer_autoload)) {
    die('Você Precisa Instalar o Composer: php composer.phar install');
}

## Diretórios Padrões

define('SITE_URL', 'http://localhost' . DS . 'crud_php');
define('STATIC_URL', 'http://localhost' . DS . 'crud_php' . DS . 'public' . DS . 'static');
define('IMG_URL', 'http://localhost' . DS . 'crud_php' . DS . 'public' . DS . 'static' . DS . 'img');


