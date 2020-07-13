<?php
// src/Controller/UsersController.php 

namespace App\Controller;

// all controllers extend AppController class, which extends Controller class 
// define functions that can later be used in view files 
class UsersController extends AppController {

    // Add the 'register' & 'logout' action to the allowed actions list.
    // You do not need to be explicitly logged in to perform these actions. 
    // The initially allowed list is in the AppController. 
    public function initialize(): void {
    
        parent::initialize();
    
        $this->Auth->allow(['logout', 'register', 'logindialog', 'login']);
    
    }

    public function index(){

        $all_users = $this->Users->find();

        $this->set('present_users', $all_users);        
        
    }   

    // loginaction needs to be the same, is defined in AppController 
    public function login(){

        if ($this->request->is('post')) {

            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }

            $this->Flash->error(__('Invalid username or password, try again'));
            
        }
    }

    // check how you will use this in the view.. 
    public function logout(){

        $this->Flash->success('You are now logged out.');

        $this->Auth->logout();

        $this->redirect($this->referer());        
        
    }

    // registering a new user for the application 
    public function register(){

        // set user role array for redirect 
        $user_role = array( "atleet" => "athlete", "evenement" => "event");
        $this->set('user_role', $user_role);

        $user = $this->Users->newEntity();

        // if not first time on page, but save made
        if ($this -> request -> is('post')) {

            // patch data given in form inputs in new entity 
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {

                // immediately logging the newly registered user in 
                // without this line of code you would still need to log in 
                $this->Auth->setUser($user);
                // role-based redirect, you could send event owners to another place in app than athletes 
                if($this->Auth->user('user_role') === "administrator"){

                    $this -> redirect(array('action' => 'index'));
                    $this->Flash->success('Admin login..');

                } else if($this->Auth->user('user_role') === "atleet"){

                    $this -> redirect(array('controller' => 'Articles' ,'action' => 'index'));                    
                    $this->Flash->success('Welcome Athlete');

                } else if($this->Auth->user('user_role') === "evenement"){

                    $this -> redirect(array('controller' => 'Events' ,'action' => 'index'));                    
                    $this->Flash->success('Welcome Event Organizer');

                };

            } else {

                $this->Flash->error(__('The User could not be saved. Please, try again.'));

        }
    }

    $this->set('user', $user);
    
    }

    // could split this function up for athletes and events 
    // will need different view files, most probably 
    public function edit($id){



    }

    public function view($id){

        // if you want to do contain, need to set hasmany/ belongtomany in the Table Model 
        $user = $this->Users->get($id, ['contain' => ['Orders']]);

        // debug($user);

        $this->set('user', $user);

    }
}

