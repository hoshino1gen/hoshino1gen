<?php



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

#$test = array("a","b","c","d","e");


$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('yoo!');
    
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
  $bot->replyText($event->getReplyToken(), $textMessageBuilder->getText());
#  $bot->replyText($event->getReplyToken(), ["返信あり","試す"]);
  syslog(LOG_EMERG, print_r($event->replyToken, true));
}

 ?>