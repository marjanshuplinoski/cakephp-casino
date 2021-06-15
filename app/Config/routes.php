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
	//Activities
	Router::connect('/CustomerIO/Activities/listActivities', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Activities', 'action' => 'listActivities'));
	//Broacasts
	Router::connect('/CustomerIO/Broadcasts/triggerBroadcast', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Broadcasts', 'action' => 'triggerBroadcast'));
	Router::connect('/CustomerIO/Broadcasts/getStatusBroadcast', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Broadcasts', 'action' => 'getStatusBroadcast'));
	Router::connect('/CustomerIO/Broadcasts/listErrorsFromBroadcast', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Broadcasts', 'action' => 'listErrorsFromBroadcast'));
	Router::connect('/CustomerIO/Broadcasts/listBroadcasts', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Broadcasts', 'action' => 'listBroadcasts'));
	Router::connect('/CustomerIO/Broadcasts/getBroadcast', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Broadcasts', 'action' => 'getBroadcast'));
	Router::connect('/CustomerIO/Broadcasts/getMetricsForBroadcast', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Broadcasts', 'action' => 'getMetricsForBroadcast'));
	Router::connect('/CustomerIO/Broadcasts/getBroadcastLinkMetrics', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Broadcasts', 'action' => 'getBroadcastLinkMetrics'));
	Router::connect('/CustomerIO/Broadcasts/listBroadcastActions', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Broadcasts', 'action' => 'listBroadcastActions'));
	Router::connect('/CustomerIO/Broadcasts/getMessageMetadataForBroadcast', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Broadcasts', 'action' => 'getMessageMetadataForBroadcast'));
	Router::connect('/CustomerIO/Broadcasts/getBroadcastAction', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Broadcasts', 'action' => 'getBroadcastAction'));
	Router::connect('/CustomerIO/Broadcasts/updateBroadcastAction', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Broadcasts', 'action' => 'updateBroadcastAction'));
	Router::connect('/CustomerIO/Broadcasts/getBroadcastActionMetrics', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Broadcasts', 'action' => 'getBroadcastActionMetrics'));
	Router::connect('/CustomerIO/Broadcasts/getBroadcastActionLinkMetrics', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Broadcasts', 'action' => 'getBroadcastActionLinkMetrics'));
	Router::connect('/CustomerIO/Broadcasts/getBroadcastTriggers', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Broadcasts', 'action' => 'getBroadcastTriggers'));
	//Campaigns
	Router::connect('/CustomerIO/Campaigns/listCampaigns', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Campaigns', 'action' => 'listCampaigns'));
	Router::connect('/CustomerIO/Campaigns/getCampaign', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Campaigns', 'action' => 'getCampaign'));
	Router::connect('/CustomerIO/Campaigns/getCampaignMetrics', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Campaigns', 'action' => 'getCampaignMetrics'));
	Router::connect('/CustomerIO/Campaigns/getCampaignLinkMetrics', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Campaigns', 'action' => 'getCampaignLinkMetrics'));
	Router::connect('/CustomerIO/Campaigns/listCampaignActions', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Campaigns', 'action' => 'listCampaignActions'));
	Router::connect('/CustomerIO/Campaigns/getCampaignMessageMetadata', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Campaigns', 'action' => 'getCampaignMessageMetadata'));
	Router::connect('/CustomerIO/Campaigns/getCampaignAction', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Campaigns', 'action' => 'getCampaignAction'));
	Router::connect('/CustomerIO/Campaigns/updateCampaignAction', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Campaigns', 'action' => 'updateCampaignAction'));
	Router::connect('/CustomerIO/Campaigns/getCampaignActionMetrics', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Campaigns', 'action' => 'getCampaignActionMetrics'));
	Router::connect('/CustomerIO/Campaigns/getLinkMetricsForAction', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Campaigns', 'action' => 'getLinkMetricsForAction'));


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
