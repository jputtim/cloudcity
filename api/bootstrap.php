<?php

date_default_timezone_set('America/Bahia');

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)).DS);
define('API', ROOT.'api'.DS);
define('ROUTES', API.'routes'.DS);
define('HELP', API.'helpers'.DS);
define('MODELS', API.'models'.DS);
define('VENDOR', ROOT.'vendor'.DS);

define('ROWS_PER_PAGE', 25);
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/');
define('API_URI', BASE_URL . 'api/');

require VENDOR . 'autoload.php';

\ActiveRecord\Config::initialize( function($cfg) {
    $cfg->set_model_directory( MODELS );
    $cfg->set_connections([
        'development' => 'mysql://root:123@localhost/cloudcity;charset=utf8'
    ]);
});

$app = new \Slim\Slim([
    'debug' => true,
    'mode' => 'development',
]);

/**
 * ROTAS
 */
foreach ( glob(ROUTES.'*') as $route) {
    if ($route = routeMap($route))
        include $route;
}

$app->run();