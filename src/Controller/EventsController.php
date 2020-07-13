<?php
// src/Controller/EventsController.php

namespace App\Controller;

// you will use this Helper Class and its methods 
use Cake\Validation\Validator;
use Cake\Utility\Xml;

// all controllers extend AppController class, which extends Controller class 
// define functions that can later be used in view files 
class EventsController extends AppController {

    public $paginate = [
        'limit' => 10,
        'order' => [
            'Events.title' => 'asc'
        ]
    ];    

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Paginator');
        
        // get information about HTTP requests that are made in your application 
        // also sets the correct status codes
        $this->loadComponent('RequestHandler');  
        
    }        
    
    // should have separate actions 
    public function index(){
        
        // get events out db & set in into variable 
        $all_events = $this->Events->find();
        
        // no automatic view, only data returned
        $this->autoRender = false;
        
        // call is made and reaches the endpoint, CORS header block..
        // need to check this again to set up security 
        $this->response = $this->response->cors($this->request)
            ->allowOrigin(['*'])
            ->allowMethods(['GET', 'POST'])
            ->allowHeaders(['*'])
            ->allowCredentials()
            ->exposeHeaders(['Link'])
            ->maxAge(300)
            ->build();      
        
        return $this->response
        ->withType('application/json')
        ->withStringBody(json_encode($all_events)); 
        return $this->response->send();
        
    }   
    
    public function cakeapitest(){
        
        
    }
    
    public function view($id){

        // find all query  
        $event = $this->Events->get($id);
        
        // this part changes in case of REST setup 
        $this->set([
            'event' => $event,
            '_serialize' => ['event']
        ]);
    
    }       

    public function delete($id){

        $event = $this->Events->get($id);

        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The {0} event has been deleted.', $event->title));
            return $this->redirect(['action' => 'index']);
        }
    }    

    public function edit($id){

        $event = $this->Events->get($id);
        
        // if you are not just landing on page but making the save 
        if ($this->request->is(['post', 'put'])) {
            
            // disable entity creation, not entirely sure what this does.. 
            $this->Events->patchEntity($event, $this->request->getData());

            // Set the user_id from the session.
            $event->user_id = $this->Auth->user('id');
        
            if ($this->Events->save($event)) {
            
                $this->Flash->success(__('Your event has been updated.'));
                return $this->redirect(['action' => 'index']);

            } else {

                $this->Flash->error(__('Unable to update your event.'));

            }
        }
        
        $this->set('event_pass', $event);    

    }



    public function add(){

        // create a new entity in data model 
        $event = $this->Events->newEntity();

        // if not first time on page, but save made
        if ($this -> request -> is('post')) {

            // patch data given in form inputs in new entity 
            $event = $this->Events->patchEntity($event, $this->request->getData());

            // Set the user_id from the session.
            $event->user_id = $this->Auth->user('id');

            if ($this->Events->save($event)) {

                $this->Flash->success(__('The Event has been saved'));
                $this -> redirect(array('action' => 'index'));

            } else {

                $this->Flash->error(__('The Event could not be saved. Please, try again.'));

            }
        }

        $this->set('event', $event);

    }
}

