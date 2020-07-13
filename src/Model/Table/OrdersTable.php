<?php
// src/Model/Table/OrdersTable.php
namespace App\Model\Table;

// uses the Helper Class Table from C:\wampserver\www\wamp_projects\composer_cakephptut\vendor\cakephp\cakephp\src\ORM
use Cake\ORM\Table;

// extends Table Class and its methods 
class OrdersTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');

        // classname used to be able to use Articles Table > 1 time 
        $this->belongsToMany('Articles', [
            'through' => 'OrdersArticles',
            'joinTable' => 'orders_articles',
            'foreignKey' => 'order_id']);

        $this->hasMany('OrdersArticles');

        // 1 Order has only 1 Customer, Customer can have multiple Orders 
        $this->BelongsTo('Customers');
        
    }
}

