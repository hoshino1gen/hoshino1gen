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

$quizSet = [];

try {

//  require_once(__DIR__ . '/config.php');

/*
  require_once(__DIR__ . '/functions.php');
*/

//  $quiz = new MyApp\Quiz();

//  if (!$quiz->isFinished()) {
//    $data = $quiz->getCurrentQuiz();
//    shuffle($data['a']);
//  }


    $quizSet[] = [
      'q' => 'What is A?',
      'a' => ['A0', 'A1', 'A2', 'A3']
    ];
    $quizSet[] = [
      'q' => 'What is B?',
      'a' => ['B0', 'B1', 'B2', 'B3']
    ];
    $quizSet[] = [
      'q' => 'What is C?',
      'a' => ['C0', 'C1', 'C2', 'C3']
    ];
#正解
#    error_log('quiz:'  . print_r($quizSet, true) );

} catch (Exception $e) {
  error_log($e->getMessage());
}




#$data['a'] h($a);

foreach ($events as $event) {

    error_log('event event:'  . print_r( $event, true) );






  if (($event instanceof \LINE\LINEBot\Event\BeaconDetectionEvent)) {

    $SendMessage10 = new MultiMessageBuilder();

/*
  if (date("H") >= 6 and date("H") <= 11) {
        $TextMessageBuilder9 = new TextMessageBuilder("おはようございます。");
  elseif (date("H") >= 12 and date("H") <= 17) { 
        $TextMessageBuilder9 = new TextMessageBuilder("こんにちわ。");
  } else {
        $TextMessageBuilder9 = new TextMessageBuilder("こんばんわ");
  }
*/

//      error_log('BEACON');
    error_log('type:'  . print_r( $event->getType(), true) );
    error_log('beacon:'  . print_r( $event->getBeaconEventType() , true) );

    $beaconEventType = $event->getBeaconEventType();      
    if ( $beaconEventType === 'enter' ) {
      $TextMessageBuilder10 = new TextMessageBuilder("出勤を記録しました。 " . date( "Y年m月d日 H時i分" ) );

    } else if ( $beaconEventType === 'leave' ) {
      $TextMessageBuilder10 = new TextMessageBuilder("退勤を記録しました。 " . date( "Y年m月d日 H時i分" ) );
    }

//    $SendMessage10->add($TextMessageBuilder9);
    $SendMessage10->add($TextMessageBuilder10);

//    $bot->pushMessage( "U" . "" , $SendMessage10);

  }


  if (!($event instanceof \LINE\LINEBot\Event\MessageEvent)) {
    error_log('Non message event has come');

//    error_log('event event:'  . print_r( $event, true) );

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

/*
$dummy = 'dummydata';
error_log('init:'  . print_r($dummy, true) );
*/
#syslog('syslog_test ' . var_dump($dummy) );

    $SendMessage = new MultiMessageBuilder();

/*
if (date("H") >= 6 and date("H") <= 11) : ?>
  <!--6時～11時のメッセージ-->
  "おはようございます。今日も一日頑張りましょう。"
elseif (date("H") >= 12 and date("H") <= 17) : 
  "こんにちは。今日は良い天気です。"
else : 
  "こんばんわ"
*/



    $TextMessageBuilder = new TextMessageBuilder("おはようございます!" . "げんさん、今日も1日がんばりましょう。");
    $TextMessageBuilder1 = new TextMessageBuilder("出勤を記録しました。");
    $TextMessageBuilder2 = new TextMessageBuilder( date( "Y年m月d日 H時i分" ) );

    $ImageMessageBuilder = new ImageMessageBuilder("https://hoshino1gen.herokuapp.com/sample.png", "https://hoshino1gen.herokuapp.com/sample.png");

    if ( $event->getText() === 'h' ) {
      $SendMessage->add($ImageMessageBuilder);
    } else {
      $SendMessage->add($TextMessageBuilder);
      $SendMessage->add($TextMessageBuilder1);
      $SendMessage->add($TextMessageBuilder2);
    }

    $bot->replyMessage($event->getReplyToken(), $SendMessage);

/*
    syslog(LOG_EMERG, 'システムは使用不可');
    syslog(LOG_DEBUG, 'でバックレベルのログ');
    syslog(LOG_INFO, '情報レベルのログ');
    syslog(LOG_WARNING, '警告');
*/

#  syslog(LOG_EMERG, print_r($event->replyToken, true));
}

 ?>