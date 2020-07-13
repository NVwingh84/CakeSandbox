<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        /*
         * Enable the following component for recommended CakePHP security settings.
         * From Reading Docs: should disable Security Component for Ajax.. 
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        If (!$this->request->is('ajax')) {

            $this->loadComponent('Security');

        }

        // more info about requests and selective handling 
        $this->loadComponent('RequestHandler', ['enableBeforeRedirect' => false]);
        
        // you can use and configure flash messages through this component
        $this->loadComponent('Flash');

        // authentication component 
        $this->loadComponent('Auth', 
        
            // authentication component load 
            ['authenticate' => [
                    // email from table is used as username, password as password 
                    'Form' => ['fields' => ['username' => 'email', 'password' => 'password']]],
                // where the user is sent when trying to go to a protected url
                'loginAction' => [
                    'controller' => 'Users',
                    'action' => 'login'
                ],
                'authError' => 'Did you really think you are allowed to see that?',
                // If unauthorized, return them to page they were just on
                'unauthorizedRedirect' => $this->referer()

            ]);

        // these are functions allowed to be performed by anyone unless otherwise defined 
        $this->Auth->allow(['display', 'view', 'index', 'add', 'edit', 'apitest']);   
        
        // load your configuration.. 
        Configure::load('app', 'default', false);    

    }        

    function beforeFilter(Event $event)
    { 
  
    }    
}

