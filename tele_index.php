<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';

use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\RunningMode\Webhook;
use SergiX44\Nutgram\Telegram\Types\Keyboard\ForceReply;

require_once("env.php");
require_once("helper/mysql-helper.php");

$db = new DataBase($_ENV['db_host'], 3306, $_ENV['db_user'], $_ENV['db_password'], $_ENV['db_name']);
$bot = new Nutgram($_ENV['token']);
$bot->setRunningMode(Webhook::class);


$bot->onCommand('start', function (Nutgram $bot) {
  $bot->sendMessage(
    text: 'balas dengan harga target!',
    reply_to_message_id: $bot->message()->message_id,
    reply_markup: ForceReply::make(
      force_reply: true,
      input_field_placeholder: '300000',
      selective: true,
    ),
  );
});

$bot->onMessage(function (Nutgram $bot) {
  global $db;
  $text = $bot->message()->text;
  if (filter_var($text, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) {
    $url = $text;
    $sender_id = $bot->userId();
    $data = [
      'link_tokped' => $url,
      'sender_id' => $sender_id
    ];
    $db->insert('link_data', $data);
    $bot->sendMessage(
      "balas dengan harga target anda",
      reply_to_message_id: $bot->message()->message_id,
      reply_markup: ForceReply::make(
        force_reply: true,
        selective: true
      ),
    );
  } else if ($bot->message()->reply_to_message()->text == "balas dengan harga target anda") {
    $bot->sendMessage("berhasil");
  } else {
    $bot->sendMessage(json_encode($bot->message()));
  }
});

$bot->run();
echo "Bot is running";
