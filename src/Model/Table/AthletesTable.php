<?php
// src/Model/Table/AthletesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AthletesTable extends Table
{
    public function initialize(array $config): void {
        
        $this->addBehavior('Timestamp');
        $this->belongsToMany('Races', [
            'through' => 'AthletesRaces',
            'joinTable' => 'athletes_races',
            'foreignKey' => 'race_id']);       
        
    }
}

