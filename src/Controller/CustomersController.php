<?php
// src/Controller/CustomersController.php
// http://wampprojects/composer_cakephptut/orders

// Helper functions 
// C:\wampserver\www\wamp_projects\composer_cakephptut\vendor\cakephp\cakephp\src

namespace App\Controller;


// all controllers extend AppController class, which extends Controller class 
// define functions that can later be used in view files 
class CustomersController extends AppController {

    public function index(){

        $all_customers = $this->Customers->find();

        $this->set('present_customers', $all_customers);

    }   

    public function add(){
        
        $customer = $this->Customers->newEntity();

        if($this->request->is(['post', 'put'])){

            // patch data given in form inputs in new entity 
            // variable in the control widgets is variable looked for in the table 
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());

            if($this->Customers->save($customer)){
                
                $this->Flash->success(__('Your customer has been created.'));
                return $this->redirect(['action' => 'index']);

            }else{

                $this->Flash->error(__('Unable to create your customer. Please try again.'));                

            }
        }

        $this->set('customer_creating', $customer);
    }

    public function delete($id){

        $customer = $this->Customers->get($id);

        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('The {0} customer has been deleted.', $customer->name));
            return $this->redirect(['action' => 'index']);
        }
    }    

    public function edit($id){

        $customer = $this->Customers->get($id);
        
        // if you are not just landing on page but making the save 
        if ($this->request->is(['post', 'put'])) {
            
            // create a new customer entity with the data from the form 
            $this->Customers->patchEntity($customer, $this->request->getData());

            if ($this->Customers->save($customer)) {
            
                $this->Flash->success(__('Your customer has been updated.'));
                return $this->redirect(['action' => 'index']);

            }else{

                $this->Flash->error(__('Unable to update your customer.'));

            }        
        }
        
        $this->set('customer', $customer);    

    }

    public function reacttest(){
        
        $all_customers = $this->Customers->find();
        $this->set('present_customers', $all_customers);        
        
    }
    
    public function vuetest(){
        
        $all_customers = $this->Customers->find();
        $this->set('present_customers', $all_customers);        
        
    }   
    
    public function whiteboardtest(){
        
        
        
    }
    
    public function artest(){
        
        
        
    }
}

