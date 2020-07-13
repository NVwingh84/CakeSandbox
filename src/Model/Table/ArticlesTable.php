<?php
// src/Model/Table/ArticlesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ArticlesTable extends Table
{
    public function initialize(array $config): void {
        
        $this->addBehavior('Timestamp');
        $this->belongsToMany('Orders', [
            'through' => 'OrdersArticles',
            'joinTable' => 'orders_articles',
            'foreignKey' => 'article_id']);

        $this->BelongsTo('Articlecats');
        
    }

    // validation function for all interactions with ArticlesTable in MySQL 
    public function validationDefault(Validator $validator){

        // validator for add method of Articles 
        $validator
        ->requirePresence('title')
        ->notEmpty('title', 'Please fill in Title Field')
        ->notEmpty('body', 'Please fill in Body Field')
        // this is only taken into account if former rules are adhered to 
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
        ->add('body', [
            'minLength' => [
                'rule' => ['minLength', 10],
                'last' => true,
                'message' => 'Min 10 Characters.'
            ],
            'maxLength' => [
                'rule' => ['maxLength', 250],
                'message' => 'Max 250 Characters.'
            ]
            /*,'email' => [
                'rule' => array('email'),
                'message' => 'Enter valid mail address'
            ]*/]);        

        return $validator;

    }
}

