<?php

App::uses('AppController', 'Controller');

class AnindaAppController extends AppController {
/**
     * Controller name
     * @var $name string
     */
    public $name = 'AnindaApp';

    /**
     * Paginate
     * @var array
     */
    public $paginate = array();

    /**
     * Models
     * @var array
     */
    public $uses = array('AnindaAppModel');

    /**
     * Called before the controller action.
     */
    public function beforeFilter() {
        parent::beforeFilter();
    }
}
