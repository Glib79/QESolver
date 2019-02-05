<?php
// src/Model/Table/OutputdataTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class OutputdataTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
}
