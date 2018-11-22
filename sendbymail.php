<?php
namespace SendGrid;
// If you are using Composer
require __DIR__ . '/../../../vendor/autoload.php';
// comment out the above line if not using Composer
// require("./sendgrid-php.php"); 
// If not using Composer, uncomment the above line
use SendGrid\Mail\To;
use SendGrid\Mail\From;
use SendGrid\Mail\Content;
use SendGrid\Mail\Mail;
function helloEmail()
{
    try {
        $from = new From(null, "test@example.com");
        $subject = "Hello World from the SendGrid PHP Library";
        $to = new To(null, "jrabanillog@gmail.com");
        $content = new Content("text/plain", "some text here");
        $mail = new Mail($from, $to, $subject, $content);
        $to = new To(null, "jrabanillog@gmail.com");
        $mail->addPersonalization($to);
        //echo json_encode($mail, JSON_PRETTY_PRINT), "\n";
        return $mail;
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
    return null;
}
function sendHelloEmail()
{
    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);
    $request_body = helloEmail();
    
    try {
        $response = $sg->client->mail()->send()->post($request_body);    
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}
sendHelloEmail();  // this will actually send an email
?>