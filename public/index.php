<?php

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

require __DIR__ . '/../vendor/autoload.php';


$caminho = $_SERVER['PATH_INFO'];
$rotas = require __DIR__ . '/../config/routes.php';

if(!array_key_exists($caminho, $rotas)){
    http_response_code(404);
    exit();
}

session_start();
$rotaDeCaminho = stripos($caminho, 'login');
if(!isset($_SESSION['logado']) && $rotaDeCaminho === false){
    header('Location: /login');
    exit();
}
$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UrlFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory // StreamFactory
);

$request = $serverRequest = $creator->fromGlobals();


$classeControladora = $rotas[$caminho];
/** @var ContainerInterface $container */
$container = require __DIR__ . '/../config/dependencies.php';
/** @var RequestHandlerInterface $controlador */
$controlador = $container->get($classeControladora);
$resposta = $controlador->handle($request);

foreach ($resposta->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $resposta->getBody();

