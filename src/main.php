<?php

use Helper\SimpleHttpClient;
use Helper\Debug;

$httpClient = new SimpleHttpClient();
$getResponse = $httpClient->get('https://www.google.com/');


Debug::printToScreen($getResponse); die;


