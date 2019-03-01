<?php

return array(
    'driver' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => 465,
    'from' => array('address' => 'artico2digital@gmail.com', 'name' => 'Auth'),
    'encryption' => 'ssl',
    'username' => 'artico2digital@gmail.com',
    // 'username' => 'mymail',
    'password' => 'Artico2017&*&',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false
);
