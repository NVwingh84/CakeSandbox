<?php
// src/Model/Table/EventsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class EventsTable extends Table
{
    public function initialize(array $config): void {
        
        $this->addBehavior('Timestamp');

        $this->HasMany('Races');           
        
    }


    public function validatedates($value,$context){

        return $context['data']['end_date'] >= $context['data']['start_date'];

    }

    // validation function for all interactions with EventsTable in MySQL 
    public function validationDefault(Validator $validator){

        // validator for add method of Articles 
        $validator
        ->requirePresence('title', 'city')    
        ->notEmpty('title', 'Title Required')
        ->notEmpty('city', 'City Required') 
        // ->lengthBetween('title', [5, 40])
        ->add('title', [
            'minLength' => [
                'rule' => ['minLength', 5],
                'last' => true,
                'message' => 'Min 5 Characters.'
            ],
            'maxLength' => [
                'rule' => ['maxLength', 40],
                'message' => 'Max 40 Characters.'
            ]])
        ->add('city', [
            'minLength' => [
                'rule' => ['minLength', 5],
                'last' => true,
                'message' => 'Min 5 Characters.'
            ],
            'maxLength' => [
                'rule' => ['maxLength', 20],
                'message' => 'Max 20 Characters.'
            ]])
        ->add('start_date', [
            "custom" => [
                'rule' => [$this, "validatedates"],
                'message' => 'start date > end date'
            ]])
        ->add('end_date', [
            "custom" => [
                'rule' => [$this, "validatedates"],
                'message' => 'start date > end date'
            ]
        ]);

        return $validator;

    }    
}

