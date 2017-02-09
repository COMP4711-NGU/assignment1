<?php

/**
 * This is a "CMS" model for full robots, but with bogus hard-coded data,
 * so that we don't have to worry about any database setup.
 * This would be considered a "mock database" model.
 *
 */
class Robots extends CI_Model {

	var $data = array(
            
		array('id' => '1', 'parts' => array(1,2,3), 'img' => 'a.jpg', 'where' => '/a',
			'what' => 'Robot A'),
		array('id' => '2', 'parts' => array(4,5,6), 'img' => 'b.jpg', 'where' => '/b',
			'what' => 'Robot B'),
		array('id' => '3', 'parts' => array(6,7,8), 'img' => 'c.jpg', 'where' => '/c',
			'what' => 'Robot C'),
		array('id' => '4', 'parts' => array(9,10,11), 'img' => 'm.jpg', 'where' => '/m',
			'what' => 'Robot M'),
		array('id' => '5', 'parts' => array(12,13,14), 'img' => 'r.jpg', 'where' => '/r',
			'what' => 'Robot R'),
		array('id' => '6', 'parts' => array(15,16,17), 'mug' => 'w.jpg', 'where' => '/w',
			'what' => 'Robot W')
	);

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}

	// retrieve a single robot
	public function get($which)
	{
		// iterate over the data until we find the one we want
		foreach ($this->data as $record)
			if ($record['id'] == $which)
				return $record;
		return null;
	}

	// retrieve all of the robots
	public function all()
	{
		return $this->data;
	}
        // retrieves total number of bots in inventory
	public function totalBots() {
	    return sizeof($this->data);
    }

}
