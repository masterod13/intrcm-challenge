<?php

use Helper\SimpleHttpClient;
use Model\Coordinate;
use Model\CustomerInviter;
use Model\Parser;
use Model\Reader\HttpReader;
use Model\Validation\CustomerValidator;
use Model\Validation\UserArrayBuilder;
use Model\Writer\ScreenJsonWriter;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

const CUSTOMERS_URLS = 'https://s3.amazonaws.com/intercom-take-home-test/customers.txt';
const DUBLIN_OFFICE_LATITUDE = 53.339428;
const DUBLIN_OFFICE_LONGITUDE = -6.257664;
const ERROR_MESSAGE = 'There was an error';

$log = new Logger('stderrLogger');
$log->pushHandler(new ErrorLogHandler());

$httpReader = new HttpReader(new SimpleHttpClient(), CUSTOMERS_URLS);

try {
    $inputArr = (new Parser())->parse($httpReader);
    $customerBuilder = new UserArrayBuilder($inputArr);
    $customers = $customerBuilder->build(new CustomerValidator);

    if (!empty($customerBuilder->getErrors())) {
        $output = $customerBuilder->getErrors();
    } else {
        $dublinOfficeCoordinates = new Coordinate(DUBLIN_OFFICE_LATITUDE, DUBLIN_OFFICE_LONGITUDE);
        $output = (new CustomerInviter())->filterCustomers($customers, $dublinOfficeCoordinates);
    }
} catch (\Exception $e) {
    $output = [ERROR_MESSAGE];
    $log->error(ERROR_MESSAGE, ['Exception_msg' => $e->getMessage(), 'stacktrace' => $e->getTrace()]);
}

(new ScreenJsonWriter($output))->write();

