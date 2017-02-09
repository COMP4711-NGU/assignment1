<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PartsController extends Application
{
	public function index()
	{
        // build the list of parts, to pass on to our view
		$source = $this->parts->all();

		$parts = array();
		foreach ($source as $record)
		{
			$parts[] = array ('id' => $record['id'], 'partCode' => $record['partCode'], 
				'creationPlant' => $record['creationPlant'], 'caCode' => $record['caCode'],
				'creationDateTime' => $record['creationDateTime']);
		}

		// send the data to the view 
		$this->data['parts'] = $parts;

		$this->data['pagetitle'] = 'Parts';
		$this->data['pagebody'] = 'parts'; // the view file 

		$this->render();
    }
}