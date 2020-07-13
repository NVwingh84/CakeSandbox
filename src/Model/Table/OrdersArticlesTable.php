<?php
// src/Model/Table/OrdersArticlesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class OrdersArticlesTable extends Table
{
    public function initialize(array $config): void {
        
        $this->addBehavior('Timestamp');
        $this->belongsTo = array('Articles','Orders');

    }
}

