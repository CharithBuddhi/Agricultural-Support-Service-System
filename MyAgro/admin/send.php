<?php
session_start();
if(!isset($_SESSION['login_staff_user'])){
    header('Location: index.php');
    exit();
}
use Infobip\ApiException;
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsReportResponse;
use Infobip\ObjectSerializer;

require __DIR__ ."/vendor/autoload.php";
 
$phone = $_POST['phone'];
$message = strtolower($_POST['message']);
$message = "Added a new video about ".$message.". You can now watch it under new techniques in MyAgro website.";

$base_url = "https://rge53y.api.infobip.com";
$api_key = "3b392f8f950e67e3b11a43e6ebd40a73-36fb8bbd-17b8-44c3-83e2-ada23a492437";

$configuration = new Configuration($base_url, $api_key);

$api = new SmsApi($configuration);

$destination = new SmsDestination($phone);

$message = new SmsTextualMessage(
    [$destination], 
    text:$message,
    from:"MyAgro"
);

$request = new SmsAdvancedTextualRequest([$message]);
$response = $api->sendSmsMessage($request);

$apiException = new  ApiException();

if ($apiException->getCode() == 0) {  
    $_SESSION['technology'] = "Your message has been sent successfully";
    header("Location: technology.php");
    exit(0);
}else{
    $_SESSION['technology'] = $apiException->getMessage();
    header("Location: technology.php");
    exit(0);
}


?>