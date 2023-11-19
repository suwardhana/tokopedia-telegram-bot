<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';
// load data from database

require_once("env.php");
require_once("helper/mysql-helper.php");
require_once("helper/helper-general.php");

$db = new DataBase($_ENV['db_host'], 3306, $_ENV['db_user'], $_ENV['db_password'], $_ENV['db_name']);
$pdo = $db->query("select * from link_data where notif_sent = 1");

$data = $pdo->fetchAll(PDO::FETCH_ASSOC);

print('<pre>' . print_r($data, true) . '</pre>');
exit;
