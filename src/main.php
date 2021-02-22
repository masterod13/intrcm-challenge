<?php

use Helper\SimpleHttpClient;
use Helper\Debug;
use Model\Coordinate;
use Model\CustomerInviter;
use Model\Parser;
use Model\Reader\HttpReader;
use Model\Validation\CustomerValidator;
use Model\Validation\UserArrayBuilder;

const CUSTOMERS_URLS = 'https://s3.amazonaws.com/intercom-take-home-test/customers.txt';
const DUBLIN_OFFICE_LATITUDE = 53.339428 ;
const DUBLIN_OFFICE_LONGITUDE = -6.257664;

$httpReader = new HttpReader(new SimpleHttpClient(), CUSTOMERS_URLS);
$inputArr = (new Parser())->parse($httpReader);
$customerBuilder = new UserArrayBuilder($inputArr);
$customers = $customerBuilder->build(new CustomerValidator);

if (!empty($customerBuilder->getErrors())) {

    Debug::printToScreen($customerBuilder->getErrors());
    return 1;
}

$filteredCustomers = (new CustomerInviter())->filterCustomers($customers, new Coordinate(DUBLIN_OFFICE_LATITUDE, DUBLIN_OFFICE_LONGITUDE));

header('Content-Type: application/json');
echo json_encode($filteredCustomers);
//Debug::printToScreen($filteredCustomers);



