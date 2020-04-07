<?php
use MySqlSessions\Sessions\PersistentSessionHandler;

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Psr4AutoloaderClass.php';
require_once __DIR__ . '/db_connect.php';

$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('MySqlSessions', __DIR__ . '/../../test/includes');
$handler = new PersistentSessionHandler($db);
session_set_save_handler($handler);
session_start();
$_SESSION['active'] = time();