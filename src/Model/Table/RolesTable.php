<?php
// src/Model/Table/RolesTable.php
namespace App\Model\Table;

// uses the Helper Class Table from C:\wampserver\www\wamp_projects\composer_cakephptut\vendor\cakephp\cakephp\src\ORM
use Cake\ORM\Table;

// extends Table Class and its methods 
class RolesTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');

    }
}

