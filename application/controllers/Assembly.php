<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Assembly extends Application
{

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		// build the list of robots, to pass on to our view
		$source = $this->robots->all();
        // check if robots are empty 
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
        // build the list of parts, to pass on to our view
        $source = $this->parts->all();

        $parts = array();
        // check for null
        foreach ($source as $record)
        {
            $model = $record->partCode[0];
            $piece = $record->partCode[1];
            $line  = $this->getLine($model);

            if($piece == 1) {
                //if top piece
                $topParts[] = array(
                    'id' => $record->id, 
                    'partCode' => $record->partCode, 
                    'model' => strtoupper($model), 
                    'line' => $line);
            } else if ($piece == 2) {
                //if torso piece
                $torsoParts[] = array(
                    'id' => $record->id, 
                    'partCode' => $record->partCode, 
                    'model' => strtoupper($model), 
                    'line' => $line);
            } else if ($piece == 3) {
                //if bottom piece
                $bottomParts[] = array(
                    'id' => $record->id, 
                    'partCode' => $record->partCode, 
                    'model' => strtoupper($model), 
                    'line' => $line);
            }
        }        

        // send the data to the view if a part exists
        // else the parts are empty 
        if (isSet($topParts)){
            $this->data['topParts'] = $topParts;
        } else {
            $topParts[] = array(
                    'id' => "none", 
                    'partCode' => "none", 
                    'model' => "No Top Parts", 
                    'line' => "No Top Parts");
            $this->data['topParts'] = $topParts;
        }
        if (isSet($torsoParts)){
            $this->data['torsoParts'] = $torsoParts;
        } else {
            $torsoParts[] = array(
                    'id' => "none", 
                    'partCode' => "none", 
                    'model' => "No Torso Parts", 
                    'line' => "No Torso Parts");
            $this->data['torsoParts'] = $torsoParts;
        }
        if (isSet($bottomParts)){
            $this->data['bottomParts'] = $bottomParts;
        } else {
            $bottomParts[] = array(
                    'id' => "none", 
                    'partCode' => "none", 
                    'model' => "No Bottom Parts", 
                    'line' => "No Bottom Parts");
            $this->data['bottomParts'] = $bottomParts;
        }
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
		
        $this->data['error'] = $this->session->userdata('error');
        $this->data['message'] = $this->session->userdata('message');
        $this->data['pagetitle'] = 'Assembly';
        $this->data['pagebody'] = 'assembly';

		$this->render();
        $this->session->set_userdata('error', "");
        $this->session->set_userdata('message', "");
	}

	public function handle() {
	    $type = $this->input->post('submitType');

        if($type == "Assemble") {
            $this->assemble();
        } else if($type == "Return") {
            $this->returnPart();
        }
    }

	public function assemble() {
        $top = $this->input->post('top');
        $torso = $this->input->post('torso');
        $bottom = $this->input->post('bottom');

        if($top == null || $torso == null || $bottom == null) {
            $this->session->set_userdata('error', 
                "You must select a top piece, torso piece, and bottom piece to assemble a robot!");
            redirect('/assembly');
        }
        if($top == "none" || $torso == "none" || $bottom == "none") {
            $this->session->set_userdata('error', 
                "You cannot select an empty top piece, torso piece, or bottom piece to assemble a robot!");
            redirect('/assembly');
        }

        $this->assembleRobot($top, $torso, $bottom);
        $this->removeParts($top, $torso, $bottom);

        redirect('/assembly');
    }

    //removes parts that made the robot from the database
    public function removeParts($top, $torso, $bottom) {
        $topPart = $this->parts->get($top)->id;
        $torsoPart = $this->parts->get($torso)->id;
        $bottomPart = $this->parts->get($bottom)->id;

        $this->parts->remove($topPart);
        $this->parts->remove($torsoPart);
        $this->parts->remove($bottomPart);
    }

    //creates a robot and inserts it into the database
    public function assembleRobot($top, $torso, $bottom) {
        $amount = 0;

        $topPartCode = $this->parts->get($top)->partCode;
        $topCaCode = $this->parts->get($top)->caCode;
        $amount += $this->parts->get($top)->amount;

        $torsoPartCode = $this->parts->get($torso)->partCode;
        $torsoCaCode = $this->parts->get($torso)->caCode;
        $amount += $this->parts->get($torso)->amount;

        $bottomPartCode = $this->parts->get($bottom)->partCode;
        $bottomCaCode = $this->parts->get($bottom)->caCode;
        $amount += $this->parts->get($bottom)->amount;

        $data = array(
            'partCodes' => $topPartCode . "," . $torsoPartCode . "," . $bottomPartCode,
            'caCodes' => $topCaCode . "," . $torsoCaCode . "," . $bottomCaCode,
            'amount' => $amount
        );

        $robotId = $this->robots->add($data);

        $robot = $this->robots->get($robotId);

        //add assembly into history table
        $data = array(
            'timestamp' => date('Y-m-d H:i:s'),
            'transactionType' => "Built",
            'Item' => "Assembled Robot",
            'fromPlant' => 'kiwi',
            'toPlant' => 'kiwi',
            'cost' => 0.00,
            'line' => $this->getRobotLine($robot->partCodes),
            'model' => $this->getRobotModel($robot->partCodes)
        );

        $this->history->add($data);
        $this->session->set_userdata('message', "Robot assembled!");
    }

    //this is for next time?
    public function returnPart() {
        redirect('/assembly');
    }

    //this is for next time?
    public function ship() {
        redirect('/assembly');
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

    //Returns the line for the robot
    public function getRobotLine($partCodes) {
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


    public function getRobotModel($partCodes)
    {
        $household = 0;
        $butler = 0;
        $companion = 0;

        foreach ($partCodes as $partCode) {
            $partCode = $partCode[0];
            if (preg_match("/^[a-l]$/", $partCode)) {
                $model = strtoupper($partCode);
                $household++;
            } else if (preg_match("/^[m-v]$/", $partCode)) {
                $model = strtoupper($partCode);
                $butler++;
            } else {
                $model = strtoupper($partCode);
                $companion++;
            }
        }

        if ($household == 3 || $butler == 3 || $companion == 3) {
            return $model;
        } else {
            return "";
        }
    }

}
