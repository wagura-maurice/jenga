<?php
use AfricasTalking\SDK\AfricasTalking;

class Sms{

    function sendMessage($recipients,$message) {
        // Set your app credentials
        $username   = "silvaboi";
        $apiKey= "1fcb5196f765c9e49dbbe92df9c8694a43960e1574ca911a93b903c5e4e77307";

        // Initialize the SDK
        $AT         = new AfricasTalking($username, $apiKey);

        // Get the SMS service
        $sms        = $AT->sms();
        
        // // Set the numbers you want to send to in international format
        // $recipients = "+254711XXXYYY,+254733YYYZZZ";

        // // Set your message
        // $message    = "I'm a lumberjack and its ok, I sleep all night and I work all day";

        try {
            // Thats it, hit send and we'll take care of the rest
            $result = $sms->send([
                'to'      => $recipients,
                'message' => $message
            ]);

            print_r($result);
        } catch (Exception $e) {
            echo "Error: ".$e.getMessage();
        }
    }

}

// sendMessage();