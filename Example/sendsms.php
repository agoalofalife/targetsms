<?php
//example of sending through the wrapper
$foo = new agoalofalife\targetsms\Wrappers\WrapperSendSms();

$response = $foo->sendSMS([
    'messages' => 'Hello!!',
    [
        'phone'          => '79999999999',
        'TimeSend'       => '2015-12-15 15:12',
        'ValidityPeriod' => '2015-12-16 16:00'

    ],
    [
        'phone'          => '79999999999',
        'TimeSend'       => '2015-12-15 15:12',
        'ValidityPeriod' => '2015-12-16 16:00'

    ]
]);
dd($response);
