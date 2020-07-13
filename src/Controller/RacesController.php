<?php
// src/Controller/RacesController.php

namespace App\Controller;

// you will use this Helper Class and its methods 
use Cake\Validation\Validator;


class RacesController extends AppController {

    public $paginate = [
        'limit' => 5,
        'order' => [
            'Races.title' => 'asc'
        ]
    ];

    public function initialize() {

        parent::initialize();
        $this->loadComponent('Paginator');

    }    

    public function index(){
           
        $all_races = $this->Races->find('all', ['contain' => ['Events']]);
        $this->set('races', $this->paginate($all_races));   
        
    }   

    public function delete($id){

        $race = $this->Races->get($id);

        if ($this->Races->delete($race)) {
            $this->Flash->success(__('The {0} race has been deleted.', $race->title));
            return $this->redirect(['action' => 'index']);
        } 
    }    

    public function edit($id){

        $race = $this->Races->get($id);
        
        // if you are not just landing on page but making the save 
        if ($this->request->is(['post', 'put'])) {
            
            // disable entity creation, not entirely sure what this does.. 
            $this->Races->patchEntity($race, $this->request->getData());

            // Set the user_id from the session.
            // $race->user_id = $this->Auth->user('id');
        
            if ($this->Races->save($race)) {
            
                $this->Flash->success(__('Your race has been updated.'));
                return $this->redirect(['action' => 'index']);

            }

        $this->Flash->error(__('Unable to update your race.'));
        
        }
        
        $this->set('race_pass', $race);  

    }



    public function add(){

        $this->loadModel('Events');           

        // I want to load all events in select for which the user responsible is the same as the user creating this race.. 
        $events = $this->Events->find('list');
        $this->set('events', $events);

        // create a new entity in data model 
        $race = $this->Races->newEntity();

        // if not first time on page, but save made
        if ($this -> request -> is('post')) {

                // patch data given in form inputs in new entity 
                $race = $this->Races->patchEntity($race, $this->request->getData());

                // Set the user_id from the session.
                // $event->user_id = $this->Auth->user('id');

                if ($this->Races->save($race)) {

                    $this->Flash->success(__('The Race has been saved'));
                    $this -> redirect(array('action' => 'index'));

                } else {

                    $this->Flash->error(__('The Race could not be saved. Please, try again.'));

                }
            } 

        $this->set('race', $race);

    }

    public function view(){

        

    }
}

