<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

        public $components = array(
                'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'quotes', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'quotes', 'action' =>  'index'),
            'authorize' => array('Controller')
        )
        );

        function beforeFilter() {
                if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
                        $this->layout = 'admin';
                } 

                $this->Auth->allow('index','view');

                if ($this->Auth->loggedIn()) {
                	$this->set('me',$this->Auth->user());
                }
                else{
                	$this->set('me',array('id'=>0,'username'=>'visiteur'));
                }

        }

/**
* isAuthorized
*
* @autho gaspard
*
*/

	public function isAuthorized($user){

		if(isset($user['group_id']) && $user['group_id']==1){
			return true;
		}

		return false;
	}



}
