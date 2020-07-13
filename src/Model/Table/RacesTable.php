<?php
// src/Model/Table/RacesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class RacesTable extends Table
{
    public function initialize(array $config): void {
        
        $this->addBehavior('Timestamp');

        $this->BelongsTo('Events');  
        
        $this->belongsToMany('Athletes', [
            'through' => 'AthletesRaces',
            'joinTable' => 'athletes_races',
            'foreignKey' => 'athlete_id']);          
        
    }
}

