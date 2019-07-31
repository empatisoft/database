<?php
/**
 * Developer: ONUR KAYA
 * Contact: empatisoft@gmail.com
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Database.php';

$local = true;
$host = 'localhost';
$user = 'root';
$password = 'root';
$database = 'randevu';

if($local != true) {
    $host = '';
    $user = '';
    $password = '';
    $database = '';
}

$db = new \Database\Database(array(
    'host' => $host,
    'database' => $database,
    'user' => $user,
    'password' => $password
));