<?php
// src/Controller/ArticlecatsController.php

namespace App\Controller;

// all controllers extend AppController class, which extends Controller class 
// define functions that can later be used in view files 
class ArticlecatsController extends AppController {

    public function index(){

        // find all query  
        $all_cats = $this->Articlecats->find();

        // still need to set variable that can be used in the view class 
        $this->set('categories', $all_cats);

    }   

    public function delete($id){

        $category = $this->Articlecats->get($id);

        if ($this->Articlecats->delete($category)) {
            $this->Flash->success(__('The {0} category has been deleted.', $category->title));
            return $this->redirect(['action' => 'index']);
        }
    }    

    public function edit($id){

        $category = $this->Articlecats->get($id);
        
        // if you are not just landing on page but making the save 
        if ($this->request->is(['post', 'put'])) {
            
            // disable entity creation, not entirely sure what this does.. 
            $this->Articlecats->patchEntity($category, $this->request->getData());

            // Set the user_id from the session.
            $category->user_id = $this->Auth->user('id');
        
            if ($this->Articlecats->save($category)) {
            
                $this->Flash->success(__('Your category has been updated.'));
                return $this->redirect(['action' => 'index']);

            }

        $this->Flash->error(__('Unable to update your category.'));
        
        }
        
        $this->set('category_pass', $category);    

    }

    public function add(){

        // create a new entity in data model 
        $category = $this->Articlecats->newEntity();

        // if not first time on page, but save made
        if ($this -> request -> is('post')) {

            if ($category->getErrors()){

                // Entity failed validation 
                // print_r($event->getErrors());
                $this->Flash->error(__('Please correct values and try again.'));                

            } else {

                // patch data given in form inputs in new entity 
                $category = $this->Articlecats->patchEntity($category, $this->request->getData());

                // Set the user_id from the session.
                $category->user_id = $this->Auth->user('id');

                if ($this->Articlecats->save($category)) {

                    $this->Flash->success(__('The Category has been saved'));
                    $this -> redirect(array('action' => 'index'));

                } else {

                    $this->Flash->error(__('The Category could not be saved. Please, try again.'));

                }
            } 
        }

        $this->set('category', $category);

    }

    public function addTest(){

        $athletes_save = $this->request->getData();    
        
        $category = $this->Articlecats->newEntity();

        $cat_title = $this->request->getData('athletes_save');
        $category->title = $cat_title[0]['title'];
        $category->user_id = $cat_title[0]['user_id'];

        $this->Articlecats->save($category);


        $this->response->body(json_encode($cat_title));
        return $this->response;
    }
}

