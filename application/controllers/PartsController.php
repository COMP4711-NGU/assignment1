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
		    $model = $record->partCode[0];
            $line  = $this->getLine($model);

		    $parts[] = array ('id' => $record->id, 'partCode' => $record->partCode, 'model' => strtoupper($model), 'line' => $line);
		}

		// send the data to the view 
		$this->data['parts'] = $parts;

		$this->data['pagetitle'] = 'Parts';
		$this->data['pagebody'] = 'parts'; // the view file 

		$this->render();
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
        $apikey = file_get_contents('../' . base_url() . 'data/apikey.txt');

        $response = file_get_contents('https://umbrella.jlparry.com//work/mybuilds?key=' . $apikey);

        $parts = json_decode($response);
        $transactionType = "Built";

        $this->handleParts($parts, $transactionType);
    }

    //makes api call to umbrella to buy parts, store part in database and update history table
    public function buy() {
        $apikey = file_get_contents('../' . base_url() . 'data/apikey.txt');

        $response = file_get_contents('https://umbrella.jlparry.com//work/buybox?key=' . $apikey);

        $parts = json_decode($response);
        $transactionType = "Purchase";
        //assuming $10 per part since total cost is $100 for box of 10 parts
        $amount = 10.00;

        $this->handleParts($parts, $transactionType, $amount);
    }

    public function handleParts($parts, $transactionType, $amount = 0.00) {
        //if there are no parts return to page
        if($parts == null) {
            echo $parts;
        }

        $quantity = 0;
        $totalAmount = 0;

        foreach($parts as $part) {
            $data = array(
                'caCode' => $part->id,
                'partCode' => $part->model . $part->piece,
                'amount' => 0.00,
                'plant' => $part->plant,
                'timestamp' => $part->stamp
            );

            $this->parts->add($data);

            $timestamp = $part->stamp;
            $plant = $part->plant;
            $quantity++;
            $totalAmount += $amount;
        }

        $data = array(
            'transactionType' => $transactionType,
            'quantity' => $quantity,
            'amount' => $totalAmount,
            'timestamp' => $timestamp,
            'plant' => $plant
        );

        $this->history->add($data);

        redirect('/parts');
    }
}