<?php

App::uses('AppController', 'Controller');

class AnindaController extends AnindaAppController {

    /**
     * Controller name
     * @var $name string
     */
    public $name = 'Aninda';

    /**
     * Paginate
     * @var array
     */
    public $paginate = array();

    /**
     * Models
     * @var array
     */
    public $uses = array();

    public function beforeFilter() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->Auth->allow();
        parent::beforeFilter();
    }


}
