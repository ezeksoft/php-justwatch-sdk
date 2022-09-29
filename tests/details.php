<?php
use Ezeksoft\JustWatchSDK\SDK;
require_once '../src/justwatch.php';

$justwatch = new SDK($country='BR');

$output = $justwatch->get_title($id=148331, 'movie'); // movie | show

print_r($output);