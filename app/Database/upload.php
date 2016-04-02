<?php

$databaseSource = [
    'name' => 'chronicle',
    'username' => 'abdillah',
    'password' => '@Codelatte96'
];

$databaseDestination = [
    'api' => 'http://abdillah.me/database/uploader.php',
    'name' => 'abdilla1_chronicle',
    'username' => 'abdilla1_master',
    'password' => '@Zyl-chronicle0',
    'hash' => 'AicAiMRsniars9t023n'
];

function getMysqlDump() {
    global $databaseSource;

    $dumpfilename = 'dump-' . date('Ymd') . '.sql';
    exec('mysqldump --user=' . $databaseSource['username'] . ' --password=' . $databaseSource['password'] . ' --host=localhost ' . $databaseSource['name'] . ' > ./' . $dumpfilename);

    $dump = '';
    if (file_exists($dumpfilename)) {
        $dump = file_get_contents($dumpfilename);
    } else {
        die('Dump file not created: ' . $dumpfilename);
    }
    return $dump;
}

function postData($fields) {
    global $databaseDestination;
    $url = $databaseDestination['api'];

    $postvars='';
    $sep='';
    foreach ($fields as $key => $value) {
        $postvars .= $sep . urlencode($key) . '=' . urlencode($value);
        $sep='&';
    }

    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,count($fields));
    curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

    $result = curl_exec($ch);

    curl_close($ch);

    echo $result;
}

$dump = getMysqlDump();
postData([
    'sqldump' => $dump
]);
