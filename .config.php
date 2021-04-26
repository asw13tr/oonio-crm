<?php
$config = array(


    'URL_ROOT' => false, // false olarak verilirse tarayıcıdan girilen domaini alır.
    'URL_404' => '',


    'DB_DRIVER' => 'mysql',
    'DB_HOST' => 'localhost',
    'DB_PORT' => '3306',
    'DB_NAME' => '',
    'DB_USER' => 'root',
    'DB_PASS' => '',
    'DB_CHARSET' => 'utf8',


    'MAIL_HOST' => '',
    'MAIL_USERNAME' => '',
    'MAIL_PASSWORD' => '',
    'MAIL_SMTP' => true,
    'MAIL_SECURE' => 'SSL',
    'MAIL_PORT' => 587,
    'MAIL_SET_FROM_EMAIL' => '',
    'MAIL_SET_FROM_NAME' => '',



    'CUSTOM_PHP_FILES' => ['app/helpers/helpers.php'], // Projelere her zaman dahil olacak özel php dosyaları.


    'USER_STATUS_LIST' => [
        1 => 'Kullanıcı',
        2 => 'Müşteri',
        3 => 'Editör',
        4 => 'Yönetici',
        5 => 'Süper Yönetici',

    ]


);

foreach($config as $key => $val){
    define($key, $val);
}
?>
