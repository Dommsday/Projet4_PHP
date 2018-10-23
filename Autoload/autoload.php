<?php

const DEFAULT_APP = 'Frontend';

if(!isset($_GET['app']) || !file_exists(__DIR__.'/../App/'.$_GET['app'])){
	
	$_GET['app'] = DEFAULT_APP;
} 

require __DIR__.'/../library/framework/ClassLoader.php';

$libraryLoader = new SplClassLoader('framework', __DIR__.'/../library');
$libraryLoader->register();

$FrontLoader = new SplClassLoader('App', __DIR__.'/..');
$FrontLoader->register();

$modelLoader = new SplClassLoader('Model', __DIR__.'/../library/vendors');
$modelLoader->register();

$entityLoader = new SplClassLoader('Entity', __DIR__.'/../library/vendors');
$entityLoader->register();

$formBuilderLoader = new SplClassLoader('FormBuilder', __DIR__.'/../library/vendors');
$formBuilderLoader->register();

//Instancie la classe Frontend/FrontendApplication
$appClass = 'App\\'.$_GET['app'].'\\'.$_GET['app'].'Application';

$app = new $appClass;
$app->run();