<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Properties extends CI_Model  {

    // Constructor
    public function __construct()
    {
        parent::__construct();
    }

    // retrieve api key
    public function getApiKey()
    {
        $query = $this->db->get('properties');
        $ret = $query->row();
        return $ret->apikey;
    }

    //add api key into the database
    public function add($key) {
        $this->db->insert('properties', $key);
    }

    //deletes all rows from table
    public function deleteAll() {
        $this->db->empty_table('properties');
    }
}
