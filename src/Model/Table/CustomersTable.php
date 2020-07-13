<?php
// src/Model/Table/CustomersTable.php
namespace App\Model\Table;

// uses the Helper Class Table from C:\wampserver\www\wamp_projects\composer_cakephptut\vendor\cakephp\cakephp\src\ORM
use Cake\ORM\Table;

// extends Table Class and its methods 
class CustomersTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');

        // 1 customer can have many orders, each order only 1 customer  
        $this->hasMany('Orders') 
            ->setForeignKey('customer_id');
        
    }
}

