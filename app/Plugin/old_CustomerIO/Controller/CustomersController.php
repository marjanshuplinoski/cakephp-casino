<?php

App::uses('AppController', 'Controller');

class CustomersController extends CustomerIOAppController {

    /**
     * Controller name
     * @var $name string
     */
    public $name = 'Customers';

    /**
     * Paginate
     * @var array
     */
    public $paginate = array();

    /**
     * Models
     * @var array
     */
    public $uses = array('old_CustomerIO.Customer');

    /**
     * Called before the controller action.
     */
    public function beforeFilter() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->Auth->allow('addOrUpdateCustomer');
        parent::beforeFilter();
    }

    public function addOrUpdateCustomer($identifier) {


    }

}
