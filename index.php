<?php
// automatizacion/index.php
use App\Kernel;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;


//require dirname(__DIR__).'/vendor/autoload.php';
require 'C:/AppServ/www/automatizacion/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

//(new Dotenv())->usePutenv()->loadEnv(dirname(__DIR__).'/.env');
(new Dotenv())->usePutenv()->loadEnv('C:/AppServ/www/automatizacion/.env');


if ($_SERVER['APP_DEBUG']) {
    umask(0000);

    Debug::enable();
}

if ($trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? false) {
    Request::setTrustedProxies(
        explode(',', $trustedProxies),
        Request::HEADER_X_FORWARDED_AWS_ELB ^ Request::HEADER_X_FORWARDED_HOST
    );
}

if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? false) {
    Request::setTrustedHosts([$trustedHosts]);
}

$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);