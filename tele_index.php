<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';

use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\RunningMode\Webhook;
use Nickyeoman\Dbhelper;

require_once("env.php");

$bot = new Nutgram($_ENV['token']);
$bot->setRunningMode(Webhook::class);

$db = new Nickyeoman\Dbhelper\Dbhelp($_ENV['db_host'], $_ENV['db_user'], $_ENV['db_password'], $_ENV['db_name'], '3306');

$bot->onCommand('start', function (Nutgram $bot) {
  $bot->sendMessage('Papa!!!');
});

$bot->onText('My name is {name}', function (Nutgram $bot, string $name) {
  $bot->sendMessage("Hi $name");
});

$bot->run();
