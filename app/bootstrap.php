<?php

session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

date_default_timezone_set('America/Bahia');

// Setting constant
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('MODELS', ROOT . DS . 'app' . DS . 'models');
define('ROUTES', ROOT . DS . 'app' . DS . 'routes');
define('TEMPLATE_DEFAULT', ROOT . DS . 'app' . DS . 'template' . DS . 'default');

define('ROWS_PER_PAGE', 10);

$composer_autoload = ROOT . DS . 'vendor' . DS . 'autoload.php';

if ( ! file_exists($composer_autoload)) {
    die('Run: composer install');
}

require $composer_autoload;

use JeremyKendall\Password\PasswordValidator;
use JeremyKendall\Slim\Auth\Adapter\Db\PdoAdapter;
use JeremyKendall\Slim\Auth\Bootstrap;

// php-activerecord
\ActiveRecord\Config::initialize(function($cfg)
{
    $cfg->set_model_directory( MODELS );
    $cfg->set_connections(array(
        'development' => 'mysql://root:123@localhost/cloudcity'
    ));
});

// slim-framework
$app = new \Slim\Slim(array(
    'templates.path' => TEMPLATE_DEFAULT,

    'cookies.encrypt' => true,
    'cookies.secret_key' => '34l3h5lk3k34221212çk-0912309710',
));

require '../app/lib/Auth/Acl.php';

$app->add(new \Slim\Middleware\SessionCookie());

$db = new \PDO('mysql:host=localhost;dbname=cloudcity', 'root', '123');
$adapter = new PdoAdapter($db, 'users', 'email', 'password', new PasswordValidator());

$acl = new CloudCity\Auth\Acl();
$authBootstrap = new Bootstrap($app, $adapter, $acl);
$authBootstrap->bootstrap();

// Prepare view
$app->view(new \Slim\Views\Twig());
$app->view->parserOptions = array(
    'charset' => 'utf-8',
    'cache' => ROOT . DS . 'cache',
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
);

$app->view->parserExtensions = array(new \Slim\Views\TwigExtension());

// Include routes
include ROUTES . DS . 'default.php';

// Run app
$app->run();