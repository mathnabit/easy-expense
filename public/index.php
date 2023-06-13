<?php
// Enable strict typing in the code
declare(strict_types = 1);

// Sets up constant paths for the application's main directory, transaction files directory, and views directory
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

// ...
require APP_PATH . "App.php";

$files = getTransactionFiles(FILES_PATH);

$transactions = [];

foreach ($files as $file) {
    $transactions = array_merge($transactions, getTransaction($file));
}
var_dump($transactions);
