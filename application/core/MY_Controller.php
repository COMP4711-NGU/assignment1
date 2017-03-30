<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		JLP
 * @copyright           2010-2016, James L. Parry
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller
{

	/**
	 * Constructor.
	 * Establish view parameters & load common helpers
	 */

	function __construct() {
		parent::__construct();

		//  Set basic view parameters
		$this->data = array ();
		$this->data['pagetitle'] = 'Assignment 1';
		$this->data['ci_version'] = (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>'.CI_VERSION.'</strong>' : '';
	}

	/**
	 * Render this page
	 */
	function render($template = 'template') {
		$this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);

        //making navigation links visible depending on role
        $role = $this->session->userdata('userrole');
        switch($role) {
            case "Worker": $this->data['nav'] = $this->getWorkerNav();
                break;
            case "Supervisor": $this->data['nav'] = $this->getSupervisorNav();
                break;
            case "Boss": $this->data['nav'] = $this->getBossNav();
                break;
            default: $this->data['nav'] = $this->getGuestNav();
        }

		$this->parser->parse('template', $this->data);
	}

	//links for worker role
	function getWorkerNav() {
	    return '<li><a href="/">Home</a></li>
                <li><a href="/manageparts">Parts</a></li>';
    }

    //links for guest role
    function getGuestNav() {
        return '<li><a href="/">Home</a></li>';
    }

    //links for boss role
    function getBossNav() {
        return '<li><a href="/">Home</a></li>
                <li><a href="/manage">Manage</a></li>
                <li><a href="/viewhistory">History</a></li>';
    }

    //links for supervisor role
    function getSupervisorNav() {
        return '<li><a href="/">Home</a></li>
                <li><a href="/assembly">Assembly</a></li>';
    }

}
