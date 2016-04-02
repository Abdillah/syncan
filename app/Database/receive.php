<?php

// $dump = $_POST['sqldump'];
$dumpfilename = 'dump-' . date('Ymd') . '.sql';
$databaseDestination = [
    'api' => 'http://abdillah.me/database/uploader.php',
    'name' => 'abdilla1_chronicle',
    'username' => 'abdilla1_master',
    'password' => '@Zyl-chronicle0',
    'hash' => 'AicAiMRsniars9t023n'
];

//file_put_contents($dumpfilename, $dump);
exec("mysql -h localhost -u {$databaseDestination['username']} -p{$databaseDestination['password']} {$databaseDestination['name']} < {$dumpfilename}");
