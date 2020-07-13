<?php
// src/Model/Table/AthletesRacesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class AthletesRacesTable extends Table
{
    public function initialize(array $config): void {
        
        $this->addBehavior('Timestamp');
        $this->belongsTo = array('Athletes','Races');        
        
    }
}

