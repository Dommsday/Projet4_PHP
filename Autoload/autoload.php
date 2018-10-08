<?php

const DEFAULT_APP = 'Frontend';

if(!isset($_GET['app']) || !file_exists(_DIR__.'/../Frontend')) $_GET['app'] = DEFAULT_APP;

require __DIR__.'/../library/framework/ClassLoader.php';

$libraryLoader = new ClassLoader('framework', __DIR__.'/../library');
$libraryLoader->register();

$FrontLoader = new ClassLoader('Frontend', __DIR.'/..');
$FrontLoader->register();

//Instancie la classe Frontend/FrontendApplication
$appClass = 'Frontend'.'\\'.$_GET['app'].'Application';