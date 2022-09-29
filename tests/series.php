<?php
use Ezeksoft\JustWatchSDK\SDK;
require_once '../src/justwatch.php';

$justwatch = new SDK($country='BR');

$output = $justwatch->search_title($search='The Flash', 'show');

print_r($output);