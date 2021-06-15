<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

	// CustomerIO
	// Customers
	Router::connect('/CustomerIO/Customers/addUpdateCustomer', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Customers', 'action' => 'addUpdateCustomer'));
	Router::connect('/CustomerIO/Customers/deleteCustomer', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Customers', 'action' => 'deleteCustomer'));
	Router::connect('/CustomerIO/Customers/addUpdateCustomerDevice', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Customers', 'action' => 'addUpdateCustomerDevice'));
	Router::connect('/CustomerIO/Customers/deleteCustomerDevice', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Customers', 'action' => 'deleteCustomerDevice'));
	Router::connect('/CustomerIO/Customers/suppressCustomerProfile', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Customers', 'action' => 'suppressCustomerProfile'));
	Router::connect('/CustomerIO/Customers/unSuppressCustomerProfile', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Customers', 'action' => 'unSuppressCustomerProfile'));
	Router::connect('/CustomerIO/Customers/customerUnsubscribeHandling', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Customers', 'action' => 'customerUnsubscribeHandling'));
	Router::connect('/CustomerIO/Customers/getCustomersByEmail', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Customers', 'action' => 'getCustomersByEmail'));
	Router::connect('/CustomerIO/Customers/searchForCustomers', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Customers', 'action' => 'searchForCustomers'));
	Router::connect('/CustomerIO/Customers/lookupCustomerAttributes', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Customers', 'action' => 'lookupCustomerAttributes'));
	Router::connect('/CustomerIO/Customers/listCustomersAndAttributes', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Customers', 'action' => 'listCustomersAndAttributes'));
	Router::connect('/CustomerIO/Customers/lookupMessagesSentToCustomer', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Customers', 'action' => 'lookupMessagesSentToCustomer'));
	Router::connect('/CustomerIO/Customers/lookupCustomerSegments', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Customers', 'action' => 'lookupCustomerSegments'));
	//
	//


/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
