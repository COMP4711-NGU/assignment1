<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends Application
{
    public function index() {
        // build the list of robots, to pass on to our view
        $source = $this->robots->all();

        foreach ($source as $record)
        {
            $parts = explode(',', $record->partCodes);

            $image1 = $parts[0];
            $image2 = $parts[1];
            $image3 = $parts[2];

            $robots[] = array (
                'id' => $record->id, 
                'amount' => $record->amount, 
                'image1' => $image1,
                'image2' => $image2,
                'image3' => $image3
                );
        }

        $this->data['pagetitle'] = 'Manage'; //title
        $this->data['pagebody'] = 'manage'; //view file
        $this->data['error'] = $this->session->userdata('error');
        $this->data['message'] = $this->session->userdata('message');
        if (isSet($robots)){
            $this->data['robots'] = $robots;
        } else {
            $robots[] = array (
                'id' => "none", 
                'amount' => 0, 
                'image1' => "none1", 
                'image2' => "none2", 
                'image3' => "none3"
                );
            $this->data['robots'] = $robots;
        }

        $response = file_get_contents('https://umbrella.jlparry.com/info/scoop/kiwi');
        $scoop = json_decode($response);

        $this->data['balance'] = $scoop->balance;
        $this->data['boxes_bought'] = $scoop->boxes_bought;
        $this->data['parts_returned'] = $scoop->parts_returned;
        $this->data['parts_made'] = $scoop->parts_made;
        $this->data['bots_built'] = $scoop->bots_built;
        $this->data['making'] = $scoop->making;
        $this->data['last_made'] = $scoop->last_made;


        $this->render();
        $this->session->set_userdata('error', "");
        $this->session->set_userdata('message', "");
    }

    public function reboot() {
        $apikey = $this->properties->getApiKey();

        $response = file_get_contents('https://umbrella.jlparry.com/work/rebootme?key=' . $apikey);

        if($response == "Ok") {
            //ok to reboot
            $this->parts->deleteAll();
            $this->history->deleteAll();
            $this->robots->deleteAll();

            //set session to flag api key needed
            $this->session->set_userdata('message', "Successfully rebooted plant.");
        } else {
            //error
            $this->session->set_userdata('error', $response);
        }
        redirect('/manage');
    }

    public function register() {
        $token = $this->input->post('token');

        $response = file_get_contents('https://umbrella.jlparry.com/work/registerme/' . PLANT_NAME . '/' . $token);

        if(substr($response, 0, 2) == "Ok") {
            //success
            $this->session->set_userdata('message', "Kiwi Plant is registered with PRC.");

            $apikey = substr($response, 3);

            //store api key into database
            $data = array(
                'apikey' => $apikey
            );

            $this->properties->deleteAll();
            $this->properties->add($data);
        } else {
            //failure
            $this->session->set_userdata('error', "Unable to register, check your token.");
        }

        redirect('/manage');
    }

    public function sell() {
        $robotId = $this->input->post('robot');

        if($robotId == "none") {
            
            redirect('/manage');
        }

        $robot = $this->robots->get($robotId);

        $caCodes = explode(',', $robot->caCodes);

        $apikey = $this->properties->getApiKey();

        $response = file_get_contents('https://umbrella.jlparry.com/work/buymybot/' .
                                        $caCodes[0] . '/' . $caCodes[1] . '/' . $caCodes[2] .
                                        '?key=' . $apikey);

        if(substr($response, 0,2) == "Ok") {
            //successfully sold
            //remove robot from database
            $this->robots->remove($robotId);

            //add transaction in history table
            //adding part to history table
            $data = array(
                'timestamp' => date('Y-m-d H:i:s'),
                'transactionType' => "Sold",
                'Item' => "Assembled Robot",
                'fromPlant' => 'kiwi',
                'toPlant' => 'PRC',
                'cost' => substr($response, 2),
                'line' => $this->getLine($robot->partCodes),
                'model' => $this->getModel($robot->partCodes)
            );

            $this->history->add($data);

            //display message to user on success
            $this->session->set_userdata('message', "Robot successfully sold to PRC!");
        } else {
            //error
            $this->session->set_userdata('error', $response);
        }
        redirect('/manage');
    }

    //Returns the line for the robot
    public function getLine($partCodes) {
        $household = 0;
        $butler = 0;
        $companion = 0;

        foreach($partCodes as $partCode) {
            $partCode = $partCode[0];
            if (preg_match("/^[a-l]$/", $partCode)) {
                $household++;
            } else if(preg_match("/^[m-v]$/", $partCode)) {
                $butler++;
            } else {
                $companion++;
            }
        }

        if($household == 3) {
            return "Household";
        } else if($butler == 3) {
            return "Butler";
        } else if ($companion == 3) {
            return "Companion";
        } else {
            return "Motely";
        }
    }


    public function getModel($partCodes) {
        $household = 0;
        $butler = 0;
        $companion = 0;

        foreach($partCodes as $partCode) {
            $partCode = $partCode[0];
            if (preg_match("/^[a-l]$/", $partCode)) {
                $model = strtoupper($partCode);
                $household++;
            } else if(preg_match("/^[m-v]$/", $partCode)) {
                $model = strtoupper($partCode);
                $butler++;
            } else {
                $model = strtoupper($partCode);
                $companion++;
            }
        }

        if($household == 3 || $butler == 3 || $companion == 3) {
            return $model;
        } else {
            return "";
        }
    }
}