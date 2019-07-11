<?php

require './vendor/autoload.php';


error_reporting(E_ALL);
ini_set("display_errors", 1);


if(isset($_POST["message"]) && isset($_POST["phone"]))
{
    $params = array(
        'credentials' => array(
            'key' => 'AKIAIQATCJXPQWTEEZDA',
            'secret' => 'ySOotRSMrk4ST+KbRpxJ+iTSb2ZJrO5SXcWylnBE',
        ),
        'region' => 'us-west-2', // < your aws from SNS Topic region
        'version' => 'latest'
    );

    $sns = new \Aws\Sns\SnsClient($params);

    $args = array(
        "MessageAttributes" => [
                    'AWS.SNS.SMS.SenderID' => [
                        'DataType' => 'String',
                        'StringValue' => 'M0153268977'
                    ],
                    'AWS.SNS.SMS.SMSType' => [
                        'DataType' => 'String',
                        'StringValue' => 'Transactional'
                    ]
                ],
            "Message" => $_POST["message"],
            "PhoneNumber" => $_POST["phone"]
    );


    $result = $sns->publish($args);
    //echo "<pre>";
    //var_dump($result);
    //echo "</pre>";

    //!empty($result)
    $array = array('sent' => true);
}else{
    $array = array('sent' => false);
}

print(json_encode($array));