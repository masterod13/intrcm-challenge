<?php


namespace Model;

use Model\Reader\ReaderInterface;

class Parser
{

    /**
     * @param ReaderInterface $reader
     * @return array $customers
     * @throws Reader\ReadException
     */
    public function parse(ReaderInterface $reader): array
    {
        $customers = [];
        $readerStr = $reader->read();
        $customerRows = explode("\n", $readerStr);

        foreach ($customerRows as $customerRow) {
            $customer = json_decode($customerRow, true);
            if(!empty($customer)) {
                $customers[] = $customer;
            }
        }

        return $customers;
    }

}