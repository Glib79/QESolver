<?php
// src/Model/Table/InputdataTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class InputdataTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('var_a', 'Missing "a" param.')
            ->integer('var_a', 'Param "a" must be an integer.')
            ->notEquals('var_a', 0, 'Param "a" can not be 0.')
            ->notEmpty('var_b', 'Missing "b" param.')
            ->integer('var_b', 'Param "b" must be an integer.')
            ->notEmpty('var_c', 'Missing "c" param.')
            ->integer('var_c', 'Param "c" must be an integer.')
            ->notEmpty('token', 'Missing token.')
            ->add('token', 'custom', [
                'rule' => function ($value, $context){
                    return ($value == sha1($context['data']['var_a'].$context['data']['var_b'].$context['data']['var_c']));
                },
                'message' => 'Wrong token.'
            ]);

	return $validator;
    }
}
