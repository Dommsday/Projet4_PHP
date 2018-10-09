<?php

const DEFAULT_APP = 'Frontend';

echo $_SERVER['REQUEST_URI'];


if(!isset($_GET['app']) || !file_exists(__DIR__.'/../Frontend')){
	
	$_GET['app'] = DEFAULT_APP;
} 

require __DIR__.'/../library/framework/ClassLoader.php';

$libraryLoader = new SplClassLoader('framework', __DIR__.'/../library');
$libraryLoader->register();

$FrontLoader = new SplClassLoader('Frontend', __DIR__.'/..');
$FrontLoader->register();

$modelLoader = new SplClassLoader('Model', __DIR__.'/../library/vendors');
$modelLoader->register();

$entityLoader = new SplClassLoader('Entity', __DIR__.'/../library/vendors');
$entityLoader->register();

//Instancie la classe Frontend/FrontendApplication
$appClass = 'Frontend'.'\\'.$_GET['app'].'Application';

$app = new $appClass;
$app->run();