<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-05 04:39
 */

return [
    'class'              => \yii\swiftmailer\Mailer::class,
    'viewPath'           => '@components/mail',
    'useFileTransport'   => true,
//    'transport' => [
//        'class'        => Swift_SmtpTransport::class,
//        'host'         => 'smtp.yandex.ru',
//        'username'     => 'noreply@my.site',
//        'password'     => '123456',
//        'port'         => '465',
//        'encryption'   => 'ssl',
//    ],
];