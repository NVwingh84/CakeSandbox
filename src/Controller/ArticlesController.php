<?php
// src/Controller/ArticlesController.php
// http://wampprojects/composer_cakephptut/articles

// Helper functions 
// C:\wampserver\www\wamp_projects\composer_cakephptut\vendor\cakephp\cakephp\src

namespace App\Controller;

class ArticlesController extends AppController {

    public function initialize(){

        parent::initialize();
        $this->loadModel('Articlecats');      
        // check how you can open another endpoint than index 

    }
    
    // should have separate actions 
    public function vuearticlessandbox(){

        $all_articles = $this->Articles->find('all', ['contain' => ['Articlecats']]);
        
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
        ->withStringBody(json_encode($all_articles)); 
        return $this->response->send();
        
    }       
    
    
    public function editcategory(){ 

        $category_id = $this->request->getData('category'); 
        $articlecat_data = $this->Articlecats->get($category_id);
        $this->set('articlecat_pass', $articlecat_data);

        $csrfToken = $this->request->getParam('_csrfToken');
        $this->set('csrf_token', $csrfToken);

        $this->render('element/articlecatcreate', 'ajax'); 

    }

    public function index(){

        $all_articles = $this->Articles->find('all', ['contain' => ['Articlecats']]);
        $this->set('first_article', $all_articles);

    }   
    
    public function edit($id){

        // population of the select widget for categories 
        $article_categories = $this->Articles->Articlecats->find('list');
        $this->set('article_categories', $article_categories);

        $article = $this->Articles->get($id);     
        
        // if you are not just landing on page but making the save 
        if ($this->request->is(['post', 'put'])) {

            // disable entity creation, not entirely sure what this does.. 
            $this->Articles->patchEntity($article, $this->request->getData());

            // Set the user_id from the session.
            $article->user_id = $this->Auth->user('id');
        
            if ($this->Articles->save($article)) {
            
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);

            } else {

                // check if there are errors in editing and print them
                if ($article->getErrors()){

                    // Entity failed validation 
                    // print_r($article->getErrors());
                    $this->Flash->error(__('Please correct values and try again.'));                

                } else {

                    $this->Flash->error(__('Unable to update your article.'));

                }
            }
        }
        
        $this->set('article_pass', $article);    

    }

    public function delete($id){

        $article = $this->Articles->get($id);

        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The {0} article has been deleted.', $article->title));
            return $this->redirect(['action' => 'index']);
        }
    }

    // FORM VALIDATION CAN BE DONE BOTH ON THE ADD CONTROLLER AND IN THE ARTICLESTABLE
    // BETTER OFF DOING IT ON THE TABLE, SINCE YOU GET BETTER ERROR HANDLING AND ONLY NEED TO DO THIS ONCE 
    public function add(){

        // get all article categories to populate select box         
        // Method 1: load foreign model initialize function
        $art_categories = $this->Articlecats->find('list');
        $this->set('art_cats', $art_categories);      
        
        // Method 2: reach through primary model 
        $article_categories = $this->Articles->Articlecats->find('list');
        $this->set('article_categories', $article_categories);

        // create a new entity in data model 
        $article = $this->Articles->newEntity();

        // if not first time on page, but save made
        if ($this -> request -> is('post')) {


            $this->request = $this->Security->generateToken($this->request);

            debug($this->request->data);
            die();


            if ($article->getErrors()){

                // Entity failed validation 
                // print_r($article->getErrors());
                $this->Flash->error(__('Please correct values and try again.'));                

            } else {

                // patch data given in form inputs in new entity 
                $article = $this->Articles->patchEntity($article, $this->request->getData());

                // Set the user_id from the session.
                $article->user_id = $this->Auth->user('id');

                if ($this->Articles->save($article)) {

                    $this->Flash->success(__('The Article has been saved'));
                    $this -> redirect(array('action' => 'index'));

                } else {

                    $this->Flash->error(__('The Article could not be saved. Please, try again.'));

                }
            } 
        }

        $this->set('article', $article);

    }


    public function view($id){

        $article = $this->Articles->get($id);

        $this->set('article', $article);

    }
}

