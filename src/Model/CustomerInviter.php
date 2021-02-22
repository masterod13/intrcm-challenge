<?php


namespace Model;


class CustomerInviter
{
    /**
     * @param User[] $customers
     * @param Coordinate $dublinOffice
     * @return User[]
     */
    public function filterCustomers(array $customers, Coordinate $dublinOffice): array
    {
        $maxDistance = 100000;
        $filteredCustomers = [];
        if (empty($customers)) {
            return [];
        }

        foreach ($customers as $customer) {
            if ($dublinOffice->calculateDistance($customer->getCoordinates()) <= $maxDistance) {
                $filteredCustomers[] = ['user_id' => $customer->getId(), 'name' => $customer->getName()];
            }
        }

        if (empty($filteredCustomers)) {
            return [];
        }

        usort($filteredCustomers, function($a, $b){
           return $a['user_id'] <=> $b['user_id'];
        });

        return $filteredCustomers;
    }


}