<?php

/**
 * This is a "CMS" model for full robots, but with bogus hard-coded data,
 * so that we don't have to worry about any database setup.
 * This would be considered a "mock database" model.
 *
 */
class Robots extends CI_Model {
    
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}

	// retrieve a single robot
	public function get($which)
	{
		// iterate over the data until we find the one we want
		foreach ($this->all() as $record)
			if ($record->id == $which)
				return $record;
		return null;
	}

    //add a robot into the database
    public function add($robot) {
        $this->db->insert('robots', $robot);
    }

	// retrieve all of the robots
	public function all()
	{
        $query = $this->db->get('robots');
        return $query->result();
	}
        // retrieves total number of bots in inventory
	public function totalBots() {
	    return sizeof($this->all());
    }

}
