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
    public $uses = array('CustomerIO.Customer');

    /**
     * Called before the controller action.
     */
    public function beforeFilter() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->Auth->allow('*');
        parent::beforeFilter();
    }

    public function addUpdateCustomer() {
        //test data
        $user_id = 887;
        $email = "player16@mail.com";
        $update = false;
        $attributes = array(
            "first_name" => "John",
            "last_name" => "Doe"
        );
        $response = $this->Customer->addUpdateCustomer($user_id, $email, $update, $attributes);
        return $response;
    }

}
