<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ManageParts extends Application
{
	public function index()
	{
        // build the list of parts, to pass on to our view
		$source = $this->parts->all();

		$parts = array();
		foreach ($source as $record)
		{
		    $model = $record->partCode[0];
            $line  = $this->getLine($model);

		    $parts[] = array ('id' => $record->id, 'partCode' => $record->partCode, 'model' => strtoupper($model), 'line' => $line);
		}

		// send the data to the view 
		$this->data['parts'] = $parts;
        $this->data['error'] = $this->session->userdata('error');
        $this->data['message'] = $this->session->userdata('message');

		$this->data['pagetitle'] = 'Parts';
		$this->data['pagebody'] = 'parts'; // the view file 

		$this->render();
        $this->session->set_userdata('error', "");
        $this->session->set_userdata('message', "");
    }

    //for drilldown details of the part
    public function details($id) {
        $part = $this->parts->get($id);
        $model = $part->partCode[0];
        $line  = $this->getLine($model);

        //cd code, part code, amount, plant

        $this->data['id'] = $part->id;
        $this->data['caCode'] = $part->caCode;
        $this->data['partCode'] = $part->partCode;
        $this->data['plant'] = $part->plant;
        $this->data['amount'] = $part->amount;
        $this->data['model'] = strtoupper($model);
        $this->data['line'] = $line;

		$this->data['pagetitle'] = 'Part Details';
		$this->data['pagebody'] = 'partDetails'; // the view file
        $this->render();
    }

    //Returns the line for the robot part
    public function getLine($letter) {
        if (preg_match("/^[a-l]$/", $letter)) {
            return "Household";
        } else if(preg_match("/^[m-v]$/", $letter)) {
            return "Butler";
        } else {
            return "Companion";
        }
    }

    //makes api call to umbrella to get parts, store part in database and update history table
    public function build() {
        $apikey = $this->properties->getApiKey();

        $response = file_get_contents('https://umbrella.jlparry.com//work/mybuilds?key=' . $apikey);

        $parts = json_decode($response);
        $transactionType = "Built";

        $this->handleParts($parts, $transactionType, "Part");
    }

    //makes api call to umbrella to buy parts, store part in database and update history table
    public function buy() {
        $apikey = $this->properties->getApiKey();

        $response = file_get_contents('https://umbrella.jlparry.com//work/buybox?key=' . $apikey);

        if(substr($response, 0, 4) == "Oops") {
            $this->session->set_userdata('error', $response);
            redirect('/manageparts');
        }

        $parts = json_decode($response);
        $transactionType = "Purchase";
        //assuming $10 per part since total cost is $100 for box of 10 parts
        $amount = 10.00;

        $this->handleParts($parts, $transactionType, "Box of Parts", $amount);
    }

    public function handleParts($parts, $transactionType, $item, $amount = 0.00) {
        //if there are no parts return to page
        if($parts == null) {
            echo $parts;
            return;
        }

        $quantity = 0;
        $totalAmount = 0;

        foreach($parts as $part) {
            $quantity++;

            //adding part to parts table
            $data = array(
                'caCode' => $part->id,
                'partCode' => $part->model . $part->piece,
                'amount' => 10.00,
                'plant' => $part->plant,
                'timestamp' => $part->stamp
            );

            $this->parts->add($data);

            $timestamp = $part->stamp;

            //adding part to history table
            $data = array(
                'timestamp' => $timestamp,
                'transactionType' => $transactionType,
                'Item' => $item,
                'fromPlant' => 'PRC',
                'toPlant' => 'kiwi',
                'cost' => $amount,
                'line' => $this->getLine($part->model),
                'model' => strtoupper($part->model),
                'piece' => $this->getPiece($part->piece)
            );

            $this->history->add($data);
        }

        if($transactionType == "Purchase") {
            $this->session->set_userdata('message', "A box of 10 parts was purchased from PRC for $100.00");
        } else {
            $this->session->set_userdata('message', $quantity . " parts were built.");
        }

        redirect('/manageparts');
    }

    public function getPiece($piece) {
        switch ($piece) {
            case 1: return "Top";
            break;
            case 2: return "Torso";
            break;
            case 3: return "Bottom";
            default: return "Error";
        }
    }
}