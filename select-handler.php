<?php
/**
 * Created by PhpStorm.
 * User: fsoul
 * Date: 10.10.2017
 * Time: 22:02
 */
require __DIR__ . '/vendor/autoload.php';

use Minishlink\WebPush\WebPush;

$fp = fopen('leads-ips.json', 'a');
$written = fwrite($fp, json_encode($_POST)."\n");
fclose($fp);

if($written){
    $links = file('leads-ips.json');

    echo json_encode($links);
}

