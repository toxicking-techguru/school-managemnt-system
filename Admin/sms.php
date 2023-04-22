<?php

// Load Twilio library
require_once '../vendor/autoload.php';

// Account SID and Auth Token from twilio.com/console
$account_sid = 'ACe1e1016ab3afb5899f4fce8fc5fbc9a2';
$auth_token = '10a0b9be672c0e9431b8808d5c325ccc';

// Create a new Twilio client
$client = new Twilio\Rest\Client($account_sid, $auth_token);

// Get the list of phone numbers to send SMS messages to
$phone_numbers = array('+14326562603', '+14324562603', '+14353562603');

// Loop through the phone numbers and send an SMS message to each one
foreach ($phone_numbers as $phone_number) {
    try {
        // Send an SMS message
        $message = $client->messages->create(
            $phone_number, // Destination phone number
            array(
                'from' => '+14323562603', // Twilio phone number
                'body' => 'Hello from Twilio!' // SMS message body
            )
        );

        // Print the message SID if the message was sent successfully
        echo 'SMS message sent to ' . $phone_number . ', message SID: ' . $message->sid . '<br>';
    } catch (Twilio\Exceptions\RestException $e) {
        // Print an error message if there was an error sending the message
        echo 'Error sending SMS message to ' . $phone_number . ': ' . $e->getMessage() . '<br>';
    }
}

?>
