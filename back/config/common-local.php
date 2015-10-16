<?
return [
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=application',
            'username' => 'root',
            'password' => '',
            'tablePrefix' => 'keys_',
        ],
        'mailer' => [
            'useFileTransport' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];