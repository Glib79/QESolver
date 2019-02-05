<?php
// src/Form/ClientForm.php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class ClientForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('var_a', 'string')
            ->addField('var_b', 'string')
            ->addField('var_c', 'string');
    }

    protected function _buildValidator(Validator $validator)
    {
        $validator
            ->notEmpty('var_a', 'Field can not be empty.')
            ->integer('var_a', 'Value must be an integer.')
            ->notEquals('var_a', 0, 'Value can not be 0.')
            ->notEmpty('var_b', 'Field can not be empty.')
            ->integer('var_b', 'Value must be an integer.')
            ->notEmpty('var_c', 'Field can not be empty.')
            ->integer('var_c', 'Value must be an integer.');

        return $validator;
    }

    protected function _execute(array $data)
    {
        return true;
    }
}
