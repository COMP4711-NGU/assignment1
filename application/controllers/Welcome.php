<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/
	 * 	- or -
	 * 		http://example.com/welcome/index
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $totalSpent = $this->history->totalSpent();
        $totalEarned = $this->history->totalEarned();
        $totalParts = $this->parts->totalParts();
        $totalBots = $this->robots->totalBots();

        $this->data['pagetitle'] = 'Dashboard';
        $this->data['pagebody'] = 'welcome';
        $this->data['totalSpent'] = $totalSpent;
        $this->data['totalEarned'] = $totalEarned;
        $this->data['totalBots'] = $totalBots;
        $this->data['totalParts'] = $totalParts;
        $this->render();
    }
}
