<?php
// src/Controller/ClientController.php

namespace App\Controller;

use App\Form\ClientForm;
use Cake\Routing\Router;
use Cake\Http\Client;

class ClientController extends AppController
{
    public function index()
    {
        $client_form = new ClientForm();
        if ($this->request->is('post')) 
        {
            if ($client_form->execute($this->request->getData())) 
            {
                $data = array(
                    'a' => $this->request->getData('var_a'),
                    'b' => $this->request->getData('var_b'),
                    'c' => $this->request->getData('var_c'),
                    'token' => sha1($this->request->getData('var_a').$this->request->getData('var_b').$this->request->getData('var_c'))
                );
 
                $http = new Client();
                $response = $http->post(Router::url(['controller' => 'Api', 'action' => 'index'], true),   $data);
                $json = $response->json;
                if($json['Status'] == -1)
                {
                    return $this->redirect(['action' => 'error', $json['Message']]);
                } elseif ($json['X1'] === null and $json['X2'] === null)
                {
                    return $this->redirect(['action' => 'noSolution']);
                } elseif ($json['X2'] === null)
                {
                    return $this->redirect(['action' => 'singleSolution', $json['X1']]);
                } else
                {
                    return $this->redirect(['action' => 'twoSolutions', $json['X1'], $json['X2']]);
                }             
            }
        }
        $this->set('client_form', $client_form);
    }

    public function error($message)
    {
        $this->set('message', $message);
    }

    public function noSolution()
    {
    }

    public function singleSolution($x1)
    {
        $this->set('x1', $x1);
    }

    public function twoSolutions($x1, $x2)
    {
        $data = array('x1' => $x1, 'x2' => $x2);
        $this->set($data);
    }

}
