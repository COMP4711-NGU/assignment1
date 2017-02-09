<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AssemblyController extends Application
{

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		// build the list of parts, to pass on to our view
		$source = $this->parts->all();
		$parts = array ();
		foreach ($source as $record)
		{
			$parts[] = array ('partCode' => $record['partCode'], 'image' => $record['image']);
		}
		$this->data['parts'] = $parts;
                $this->data['pagetitle'] = 'Assembly';
                $this->data['pagebody'] = 'assembly';
		$this->render();
	}

}
