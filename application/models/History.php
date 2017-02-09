<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class History extends CI_Model {

    var $data = array(
        array('purchaseId' => '1', 'transactionId' => '6C7890123D', 'transactionType' => 'purchase', 'AssembliesCode' => 'A236B83JD1',
                'date' => '2017-02-07', 'time' => '10:00' , 'money' => 500),
        array('purchaseId' => '2', 'transactionId' => '9A7430123F', 'transactionType' => 'purchase', 'AssembliesCode' => 'B232G83JD1',
                'date' => '2017-02-08', 'time' => '13:00' , 'money' => 300),
        array('purchaseId' => '3', 'transactionId' => '1W7830109D', 'transactionType' => 'return', 'AssembliesCode' => 'C237B83JD1',
                'date' => '2017-02-09', 'time' => '12:00' , 'money' => 100),
        array('purchaseId' => '4', 'transactionId' => '3T7876123K', 'transactionType' => 'sold', 'AssembliesCode' => 'D238X83JD1',
                'date' => '2017-02-10', 'time' => '15:00' , 'money' => 800),
        array('purchaseId' => '5', 'transactionId' => '0P7520128R', 'transactionType' => 'sold', 'AssembliesCode' => 'E239I83JD1',
                'date' => '2017-02-11', 'time' => '14:30' , 'money' => 1000),
    );

    // Constructor
    public function __construct()
    {
            parent::__construct();
    }

    // retrieve a single transaction history
    public function get($which)
    {
        // iterate over the data until we find the one we want
        foreach ($this->data as $record)
                if ($record['purchaseId'] == $which)
                        return $record;
        return null;
    }

    // retrieve all of the transaction history entries
    public function all()
    {
        return $this->data;
    }


    // retrieves total amount spent
    public function totalSpent() {
        $total = 0;

        foreach ($this->data as $record)
            if ($record['transactionType'] == 'purchase')
                $total += $record['money'];

        return $total;
    }

    // retrieves total amount earned
    public function totalEarned() {
        $total = 0;

        foreach ($this->data as $record)
            if ($record['transactionType'] == 'sold' || $record['transactionType'] == 'sold')
                $total += $record['money'];

        return $total;
    }
}
