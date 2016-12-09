<?php

ini_set('display_errors', 1);

ini_set('log_errors','On');
ini_set('error_log','syslog');
error_reporting(E_ALL);

session_start();

require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/autoload.php');
