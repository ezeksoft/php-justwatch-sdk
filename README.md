### Exemplo
Veja como pesquisar pelo filme que contém as palavras "The Flash".

```php

<?php
use Ezeksoft\JustWatchSDK\SDK;
require_once 'justwatch.php';

$justwatch = new SDK($country='BR');

$output = $justwatch->search_title($search='The Flash', 'movie');

print_r($output);

```