<?php

use Symfony\Component\HttpFoundation\Request;

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});


//Ruta de demostración, para validar que se recibe(n) dato(s) y se responde con este mismo
$app->post('/enviarDato', function (Request $request) use ($app) {
   return $request;
});


//Ruta de demostración, se recibe(n) dato(s) y se manipulan
$app->post('/newDato', function (Request $request) use ($app) {
   
    $dbconn = pg_pconnect("host=ec2-3-210-178-167.compute-1.amazonaws.com port=5432 dbname=des77jp9cat6qo user=bsntemegqjneun password=f4525a1d46d3754a0e203ca2c9f4f37b181bb300a0022301bbcf1604e71898ee")

    if ($dbconn) {
    	return "conectado"
    	
    }
    else{
    	return "no conectado"



   	$nombre = $request->get('nombre');
	$respuesta = "Hola " .$nombre;
   	return $respuesta;
});

//Ruta de demostración, se recibe(n) dato(s) y se manipulan
$app->post('/postArduino', function (Request $request) use ($app) {
   	return "OK";
});

$app->run();
