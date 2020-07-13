<?php
// src/Model/Table/ArticlecatsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class ArticlecatsTable extends Table
{
    public function initialize(array $config): void {
        
        $this->addBehavior('Timestamp');

        $this->hasMany('Articles');
        
    }
}

