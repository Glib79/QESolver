<?php
// src/Controller/ApiController.php

namespace App\Controller;

use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class ApiController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function index()
    {
        if ($this->request->is('post')) 
        { // receive data
            $req = $this->request->getData();
            $data_tym = array(
                'var_a' => $req['a'],
                'var_b' => $req['b'],
                'var_c' => $req['c'],
                'token' => $req['token']
            );
            $inputdataTable = TableRegistry::get('Inputdata');
            // check data
            $inputdata_new = $inputdataTable->newEntity($data_tym);
            if ($inputdata_new->errors())
            { // if something is wrong
		$message = "";
                foreach($inputdata_new->errors() as $field)
                {
                     foreach($field as $mes)
                     {
                         $message .= $mes." ";
                     }
                }
                $data = array('Status' => -1, 'Message' => trim($message));
            }else
            { // if data is ok
                $outputdataTable = TableRegistry::get('Outputdata');
                // check if token exist in db
                $inputdata = $inputdataTable->findByToken($req['token'])->first();
                if($inputdata)
                { //increase number of received requests
                    $inputdata->received_req += 1;
                    $inputdataTable->save($inputdata);
                    
                    //get data from db
                    $outputdata = $outputdataTable->findByInputdataId($inputdata->id)->first();

                    $data = array('Status' => 200, 'Message' => $outputdata->message, 'X1' => $outputdata->var_x1, 'X2' => $outputdata->var_x2);
                }else
                { // create new record
                    $inputdata = $inputdata_new;
                    $inputdata->received_req = 1;
                    $inputdataTable->save($inputdata);
                    // find solution
                    $solutions = $this->quadratic_equation($req['a'], $req['b'], $req['c']);
                    // put solution to db
                    $outputdata = $outputdataTable->newEntity($solutions);
                    $outputdata->inputdata_id = $inputdata->id;
                    $outputdataTable->save($outputdata);                    

                    $data = array('Status' => 200, 'Message' => $outputdata->message, 'X1' => $outputdata->var_x1, 'X2' => $outputdata->var_x2);
                }
            }
        }else
        {
            $data = array('Status' => -1, 'Message' => 'Only POST requests are acceptable.');
        }
        $this->viewBuilder()->setClassName('Json');
        $this->set('data', $data);
        $this->set('_serialize', 'data');
    }

    /**
    * Method solving quadratic equation ax2+bx+c
    * @param $a int param a
    * @param $b int param b
    * @param $c int param c
    * @return array with solutions var_x1, var_x2 and message
    */
    private function quadratic_equation($a, $b, $c)
    {
        $d = $b*$b - 4*$a*$c;
        $solutions = array('var_x1' => null, 'var_x2' => null, 'message' => 'No real solutions');

        if($d > 0) 
        {
            $solutions['var_x1'] = ((-$b + sqrt($d)) / (2*$a));
            $solutions['var_x2'] = ((-$b - sqrt($d)) / (2*$a));
            $solutions['message'] = 'Two solutions';
        } elseif($d == 0) 
        {
            $solutions['var_x1'] = (-$b / 2*$a);
            $solutions['message'] = 'One solution';
        }

        return $solutions;
    }
}
