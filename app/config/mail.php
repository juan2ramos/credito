return array(
    'driver' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => 465,
    'from' => array('address' => 'mymail@gmail.com', 'name' => 'Auth'),
    'encryption' => 'ssl',
    'username' => 'mymail@gmail.com',
    // 'username' => 'mymail',
    'password' => 'mypass',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false
);
