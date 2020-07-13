<?php
// src/Controller/RolesController.php

namespace App\Controller;

// all controllers extend AppController class, which extends Controller class 
// define functions that can later be used in view files 
class RolesController extends AppController {

    public function initialize(){

        parent::initialize();

        // addition to the public actions in AppController, so && 
        $this->Auth->allow(['edit', 'add']);         

    }    

    public function index(){

        // find all query  
        $all_roles = $this->Roles->find();

        // still need to set variable that can be used in the view class 
        $this->set('roles', $all_roles);

    }   

    public function delete($id){

        $role = $this->Roles->get($id);

        if ($this->Roles->delete($role)) {
            $this->Flash->success(__('The {0} role has been deleted.', $role->title));
            return $this->redirect(['action' => 'index']);
        }
    }    

    public function edit($id){

        $role = $this->Roles->get($id);
        
        // if you are not just landing on page but making the save 
        if ($this->request->is(['post', 'put'])) {
            
            // disable entity creation, not entirely sure what this does.. 
            $this->Roles->patchEntity($role, $this->request->getData());
        
            if ($this->Roles->save($role)) {
            
                $this->Flash->success(__('Your role has been updated.'));
                return $this->redirect(['action' => 'index']);

            }

        $this->Flash->error(__('Unable to update your role.'));
        
        }
        
        $this->set('role_pass', $role);    

    }



    public function add(){

        // create a new entity in data model 
        $role = $this->Roles->newEntity();

        // if not first time on page, but save made
        if ($this -> request -> is('post')) {

            // patch data given in form inputs in new entity 
            $role = $this->Roles->patchEntity($role, $this->request->getData());

            if ($this->Roles->save($role)) {

                $this->Flash->success(__('The Role has been saved'));
                $this -> redirect(array('action' => 'index'));

            } else {

                $this->Flash->error(__('The Role could not be saved. Please, try again.'));

            }
        } 

        $this->set('role', $role);

    }
}

