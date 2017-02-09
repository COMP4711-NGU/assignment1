<?php

/**
 * This is a "CMS" model for parts, but with bogus hard-coded data,
 * so that we don't have to worry about any database setup.
 * This would be considered a "mock database" model.
 *
 * @author Maks
 */

class Parts extends CI_Model {

    // note: having parts for a complete robot is going to be rare in the next iteration. 
    var $data = array(
        array('id' => '1', 'partCode' => 'a1', 'creationPlant' => 'HeadOffice', 'caCode' => 'b7c247',
            'creationDateTime' => '2017/02/08/06/30', 'image' => 'a1.jpeg'),
        array('id' => '2', 'partCode' => 'a2', 'creationPlant' => 'HeadOffice', 'caCode' => 'fb853c',
            'creationDateTime' => '2017/02/07/12/00', 'image' => 'a2.jpeg'),
        array('id' => '3', 'partCode' => 'a3', 'creationPlant' => 'HeadOffice', 'caCode' => '7e1b6a',
            'creationDateTime' => '2017/02/05/11/30', 'image' => 'a3.jpeg'),
        array('id' => '6', 'partCode' => 'b3', 'creationPlant' => 'HeadOffice', 'caCode' => 'fb8656',
            'creationDateTime' => '2017/01/02/10/00', 'image' => 'b3.jpeg'),
        array('id' => '11', 'partCode' => 'm2', 'creationPlant' => 'HeadOffice', 'caCode' => '5e5a0f',
            'creationDateTime' => '2017/01/02/10/00', 'image' => 'm2.jpeg')

        );

    // Constructor
    public function __construct()
    {
        parent::__construct();
    }

    // retrieve a single part given the id 
    public function get($which)
    {
        // iterate over the data until we find the one we want
        foreach ($this->data as $record)
            if ($record['id'] == $which)
                return $record;
        return null;
    }

    // retrieve all of the parts
    public function all()
    {
        return $this->data;
    }
    
    // retrieves total number of parts in inventory
    public function totalParts() {
        return sizeof($this->data);
    }
}