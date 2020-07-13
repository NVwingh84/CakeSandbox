<?php
// src/Controller/OrdersController.php
// http://wampprojects/composer_cakephptut/orders

// Helper functions 
// C:\wampserver\www\wamp_projects\composer_cakephptut\vendor\cakephp\cakephp\src

namespace App\Controller;

use Cake\Http\Client;
use Cake\Mailer\Email;
use CakePdf\Pdf\CakePdf;
use Cake\Core\Configure;

// all controllers extend AppController class, which extends Controller class 
// define functions that can later be used in view files 
class OrdersController extends AppController {


    public function initialize(){

        parent::initialize();
        $this->Auth->allow(['checkout']); 

    }

    public function checkout(){

        $payment_data = $this->request->getData();  
        $redirect_url = "http://wampprojects/composer_cakephptut/orders";
        
        // make API call to Mollie
        // https://github.com/mollie/mollie-api-php
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey("test_E2EaqWK98bFbTPQrJHBH8GwWgUqK4g");

        // internal server error : SSL certificate problem : security.. 
        $payment = $mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => "10.00"
            ],
            "description" => "Check API Payment",
            "redirectUrl" => $redirect_url,
            // on this url you receive information about when a customer paid you 
            "webhookUrl"  => $redirect_url,
        ]);

        $this->response->body($redirect_url);
        return $this->response;        

    }


    public function index(){

        $all_orders = $this->Orders->find('all', array('recursive' => 2));
        
        foreach ($all_orders as $order):
            
            debug($order);
            
        endforeach;
        
        
        $this->set('present_orders', $all_orders);

    }   

    public function mail(){

        $email = new Email('gmail');

        try {
            
            $email
            ->template('testtemplate')
            ->from(['me@example.com' => 'My Site'])
            ->to('nielsvanwingh@yahoo.com')
            ->subject('Cake Mail Test')
            ->send('My message');

        } catch (\Cake\Network\Exception\SocketException $exception) {
            
            // sending/queing failed
            // the last response is available when using the Smtp transport
            $lastResponse = $email->transport()->getLastResponse();
            $this->Flash->error(__('Mail Could not be Sent.'));

        }

        $this->Flash->success(__('Mail Sent.'));
        return $this->redirect(['action' => 'index']);

    }


    public function edit($id){

        $order = $this->Orders->get($id);

        // statement checking the type of request 
        if ($this->request->is(['post','put'])){

            // disable entity creation, not entirely sure what this does.. 
            $this->Orders->patchEntity($order, $this->request->getData());

            // Set the user_id from the session.
            debug($this->Auth->user('id'));
            // die(); 
            $article->user_id = $this->Auth->user('id');            
                        
            if ($this->Orders->save($order)) {

                $this->Flash->success(__('Your order has been updated.'));
                return $this->redirect(['action' => 'index']);

            }

            $this->Flash->error(__('Unable to update your order.'));            

        }

        $this->set('order_editing', $order);

    }


    public function add(){

        $order = $this->Orders->newEntity();

        // load customer data into the select 
        $list_customers = $this->Orders->Customers->find('list');
        $this->set('customers', $list_customers);

        // load article categories into the select 
        $this->loadModel('Articlecats');
        $article_categories = $this->Articlecats->find('list');
        // set an empty option first 
        $this->set('art_categories', $article_categories);

        // categories still to populate, text before population 
        $select_category = ["select category first"];
        $this->set('article_basetext', $select_category);


        if($this->request->is(['post', 'put'])){

            // patch data given in form inputs in new entity 
            // variable in the control widgets is variable looked for in the table 
            $order = $this->Orders->patchEntity($order, $this->request->getData());

            // Set the user_id from the session.
            $order->user_id = $this->Auth->user('id');

            if($this->Orders->save($order)){

                debug($this->request->data);
                //  die();

                $order_id_use = $order->id;

                // for each selected item you need the key and to perform a save 
                // this is a list of keys of the selected articles 
                foreach ($order['article_id'] as $article):

                    $new_order = $this->Orders->OrdersArticles->newEntity();

                    // this is the id of the newly created order
                    $new_order->order_id = $order_id_use;
                    $new_order->price = 15; 
                    $new_order->quantity = 2;
                    $new_order->article_id = $article;

                    $this->Orders->OrdersArticles->save($new_order);

                endforeach;

                $this->Flash->success(__('Your order has been created.'));
                return $this->redirect(['action' => 'index']);

            }else{

                $this->Flash->error(__('Unable to create your order. Please try again.'));                

            }
        }

        // you need to pass the new empty entity to add view 
        $this->set('order_creating', $order);

    }


    // if an order is deleted, do you want all associated order_articles to be deleted? yes
    // if an article is deleted, do you want all associated order_articles to be deleted? no 
    // still need to set dependent property the right way
    public function delete($id){

        $order_delete = $this->Orders->get($id);

        if ($this->Orders->delete($order_delete)) {
            $this->Flash->success(__('The {0} order has been deleted.', $order_delete->title));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function view($id){

        $order = $this->Orders->get($id, ['contain' => ['Articles']]);

        // additional configuration of the pdf file 
        // omit filename if you want to do 'view pdf'
        $this->viewBuilder()->options([
            'pdfConfig' => [
                //'download' => true, // force the file to be downloaded.. 
                'orientation' => 'portrait',
                'title' => 'Supported Cameras',
                'filename' => 'Ordernlscustom_' . $id . ".pdf"
            ]
        ]);

        $this->set('order_view', $order);  
        
    }

    public function viewUserdata($id){

        $this->loadModel('Users');
        
        $order = $this->Orders->get($id, ['contain' => ['Articles']]);
        $user = $this->Users->get($order['user_id']);

        $this->set('order', $order);
        $this->set('user', $user);

    }

    public function dynamicArticleload(){
        
        debug($this->request->getData('number'));
        $number = $this->request->getData('number');

        $returnvar = "test returnvariable";

        $this->response->body(json_encode($number));

        return $this->response;

    }

    public function weatherData(){

        $http = new Client();
        
        $key = Configure::read('openweathmapappID');
        
        $response = $http->get('http://api.openweathermap.org/data/2.5/weather?q=London&APPID=' . $key);
        $json = $response->getJson();

        debug($json);
        
        $this->response->body(json_encode($json));

        return $this->response;        

    }

    public function categorySelect(){

        $this->loadModel('Articles');

        $category_id = $this->request->getData('category');    
        $articles_cat = $this->Articles->find('list', ['conditions' => ['Articles.articlecat_id' => $category_id]]);
        $this->response->body(json_encode($articles_cat));

        return $this->response;             

    }
    
    public function motiontest(){
        
        // test
    }
    
    public function googlemaps(){
        
    }
    
    public function googleplace(){

        $city = $this->request->getData('place');   
        
        $api_key = Configure::read('googleplaceapikey');
                
        $http = new Client();
        $response = $http->get('https://maps.googleapis.com/maps/api/staticmap?center=Berkeley,CA&zoom=14&size=400x400&key=' . $api_key);
        
        debug($response);       
        
        $json = $response->getJson();        

        $this->response->body(json_encode($json));
        return $this->response;      

    }     
    
    
}

