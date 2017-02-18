<?php

return [
    'class' => 'yii\swiftmailer\Mailer',
    // send all mails to a file by default. You have to set
    // 'useFileTransport' to false and configure a transport
    // for the mailer to send real emails.
    'useFileTransport' => true,
//    'transport' => [
//        'class' => 'Swift_SmtpTransport',
//        'host' => 'smtp.mail.ru',
//        'username' => 'kbelyi@list.ru',
//        'password' => '',
//        'port' => '465',
//        'encryption' => 'ssl',
//    ],
];