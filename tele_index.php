<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';

use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\RunningMode\Webhook;
// include env.php
require_once("env.php");

$bot = new Nutgram($_ENV['token']);
$bot->setRunningMode(Webhook::class);

$bot->onCommand('start', function (Nutgram $bot) {
  $bot->sendMessage('Papa!!!');
});

$bot->onText('My name is {name}', function (Nutgram $bot, string $name) {
  $bot->sendMessage("Hi $name");
});

$bot->run();
