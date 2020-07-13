<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;

// uses the Helper Class Table from C:\wampserver\www\wamp_projects\composer_cakephptut\vendor\cakephp\cakephp\src\ORM
use Cake\ORM\Table;

// extends Table Class and its methods 
class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');

        // need to be defined to be able to do contain in get/ find methods
        $this->hasMany('Orders');

    }
}

