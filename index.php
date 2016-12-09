<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);

use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use \LINE\LINEBot\Constant\HTTPHeader;

require_once __DIR__ . '/vendor/autoload.php';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);

$signature = $_SERVER["HTTP_" . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
try {
  $events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
} catch(\LINE\LINEBot\Exception\InvalidSignatureException $e) {
  error_log("parseEventRequest failed. InvalidSignatureException => ".var_export($e, true));
} catch(\LINE\LINEBot\Exception\UnknownEventTypeException $e) {
  error_log("parseEventRequest failed. UnknownEventTypeException => ".var_export($e, true));
} catch(\LINE\LINEBot\Exception\UnknownMessageTypeException $e) {
  error_log("parseEventRequest failed. UnknownMessageTypeException => ".var_export($e, true));
} catch(\LINE\LINEBot\Exception\InvalidEventRequestException $e) {
  error_log("parseEventRequest failed. InvalidEventRequestException => ".var_export($e, true));
}

#$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
#$response = $bot->pushMessage('<to>', $textMessageBuilder);
#echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

#$response_format_image = ['contentType'=>2,"toType"=>1,'originalContentUrl'=>"https://hoshino1gen.herokuapp.com/sample.png","previewImageUrl"=>"https://hoshino1gen.herokuapp.com/sample.png"];

#$imageMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('こんにちわー');
#new ImageMessageBuilder('https://example.com/image.jpg', 'https://example.com/image_preview.jpg')
#{
#    "type": "image",
#    "originalContentUrl": "https://hoshino1gen.herokuapp.com/sample.png",
#    "previewImageUrl": "https://hoshino1gen.herokuapp.com/sample.png"
#};

/*
try {

  require_once(__DIR__ . '/config.php');

  $quiz = new MyApp\Quiz();

  if (!$quiz->isFinished()) {
    $data = $quiz->getCurrentQuiz();
    shuffle($data['a']);
  }

} catch (Exception $e) {
  error_log($e->getMessage());
}
*/



#$data['a'] h($a);

foreach ($events as $event) {
  if (!($event instanceof \LINE\LINEBot\Event\MessageEvent)) {
    error_log('Non message event has come');
    continue;
  }
  if (!($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage)) {
    error_log('Non text message has come');
    continue;
  }

#  $bot->replyText($event->getReplyToken(), $event->getText());
#  $bot->replyText($event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder('./sample.png', './sample.png') );
#  $bot->replyText($event->getReplyToken(), $textMessageBuilder->getText());
#  $bot->replyText($event->getReplyToken(), ["返信あり","試す"]);

$dummy = 'ダミーデータ';
error_log('errorlog_test '  . print_r($dummy) );
#syslog('syslog_test ' . var_dump($dummy) );

    $SendMessage = new MultiMessageBuilder();
    $TextMessageBuilder = new TextMessageBuilder("444！");
    $TextMessageBuilder1 = new TextMessageBuilder("888！");
#    $TextMessageBuilder2 = new TextMessageBuilder( h($data['q']) );

    $ImageMessageBuilder = new ImageMessageBuilder("https://hoshino1gen.herokuapp.com/sample.png", "https://hoshino1gen.herokuapp.com/sample.png");

    if ( $event->getText() === 'h' ) {
      $SendMessage->add($ImageMessageBuilder);
    } else {
      $SendMessage->add($TextMessageBuilder);
      $SendMessage->add($TextMessageBuilder1);
#      $SendMessage->add($TextMessageBuilder2);
    }

    $bot->replyMessage($event->getReplyToken(), $SendMessage);

    syslog(LOG_EMERG, 'システムは使用不可');
    syslog(LOG_DEBUG, 'でバックレベルのログ');
    syslog(LOG_INFO, '情報レベルのログ');
    syslog(LOG_WARNING, '警告');


  syslog(LOG_EMERG, print_r($event->replyToken, true));
}

 ?>