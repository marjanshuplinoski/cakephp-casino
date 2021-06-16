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
	//Collections
	Router::connect('/CustomerIO/Collections/createCollection', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Collections','action'=>'createCollection'));
	Router::connect('/CustomerIO/Collections/listCollections', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Collections','action'=>'listCollections'));
	Router::connect('/CustomerIO/Collections/lookupCollection', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Collections','action'=>'lookupCollection'));
	Router::connect('/CustomerIO/Collections/deleteCollection', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Collections','action'=>'deleteCollection'));
	Router::connect('/CustomerIO/Collections/updateCollection', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Collections','action'=>'updateCollection'));
	Router::connect('/CustomerIO/Collections/lookupCollectionContents', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Collections','action'=>'lookupCollectionContents'));
	Router::connect('/CustomerIO/Collections/updateContentsOfCollection', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Collections','action'=>'updateContentsOfCollection'));
	//Events
	Router::connect('/CustomerIO/Events/trackCustomerEvent', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Events','action'=>'trackCustomerEvent'));
	Router::connect('/CustomerIO/Events/trackAnonymousEvent', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Events','action'=>'trackAnonymousEvent'));
	Router::connect('/CustomerIO/Events/reportPushEvent', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Events','action'=>'reportPushEvent'));
	//Exports
	Router::connect('/CustomerIO/Exports/listExports', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Exports','action'=>'listExports'));
	Router::connect('/CustomerIO/Exports/getExport', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Exports','action'=>'getExport'));
	Router::connect('/CustomerIO/Exports/downloadExport', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Exports','action'=>'downloadExport'));
	Router::connect('/CustomerIO/Exports/exportCustomerData', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Exports','action'=>'exportCustomerData'));
	Router::connect('/CustomerIO/Exports/exportInfoAboutDeliveries', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Exports','action'=>'exportInfoAboutDeliveries'));
	//Messages
	Router::connect('/CustomerIO/Messages/sendTransactionalEmail', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Messages','action'=>'sendTransactionalEmail'));
	Router::connect('/CustomerIO/Messages/listMessages', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Messages','action'=>'listMessages'));
	Router::connect('/CustomerIO/Messages/getMessage', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Messages','action'=>'getMessage'));
	Router::connect('/CustomerIO/Messages/getArchivedMessage', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Messages','action'=>'getArchivedMessage'));
	//Newsletters
	Router::connect('/CustomerIO/Newsletters/listNewsletters', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Newsletters','action'=>'listNewsletters'));
	Router::connect('/CustomerIO/Newsletters/getNewsletter', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Newsletters','action'=>'getNewsletter'));
	Router::connect('/CustomerIO/Newsletters/getNewsletterMetrics', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Newsletters','action'=>'getNewsletterMetrics'));
	Router::connect('/CustomerIO/Newsletters/getNewsletterLinkMetrics', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Newsletters','action'=>'getNewsletterLinkMetrics'));
	Router::connect('/CustomerIO/Newsletters/listNewsletterVariants', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Newsletters','action'=>'listNewsletterVariants'));
	Router::connect('/CustomerIO/Newsletters/getNewsletterMessageMetadata', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Newsletters','action'=>'getNewsletterMessageMetadata'));
	Router::connect('/CustomerIO/Newsletters/getNewsletterVariant', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Newsletters','action'=>'getNewsletterVariant'));
	Router::connect('/CustomerIO/Newsletters/updateNewsletterVariant', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Newsletters','action'=>'updateNewsletterVariant'));
	Router::connect('/CustomerIO/Newsletters/getMetricsForVariant', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Newsletters','action'=>'getMetricsForVariant'));
	Router::connect('/CustomerIO/Newsletters/getNewsletterVariantLinkMetrics', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Newsletters','action'=>'getNewsletterVariantLinkMetrics'));
	//Segments
	Router::connect('/CustomerIO/Segments/addSegment', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Segments','action'=>'addSegment'));
	Router::connect('/CustomerIO/Segments/removeSegment', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Segments','action'=>'removeSegment'));
	Router::connect('/CustomerIO/Segments/createManualSegment', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Segments','action'=>'createManualSegment'));
	Router::connect('/CustomerIO/Segments/listSegments', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Segments','action'=>'listSegments'));
	Router::connect('/CustomerIO/Segments/getSegment', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Segments','action'=>'getSegment'));
	Router::connect('/CustomerIO/Segments/deleteSegment', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Segments','action'=>'deleteSegment'));
	Router::connect('/CustomerIO/Segments/getSegmentDependencies', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Segments','action'=>'getSegmentDependencies'));
	Router::connect('/CustomerIO/Segments/getSegmentCustomerCount', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Segments','action'=>'getSegmentCustomerCount'));
	Router::connect('/CustomerIO/Segments/listCustomersInSegment', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Segments','action'=>'listCustomersInSegment'));
	//SenderIdentities
	Router::connect('/CustomerIO/SenderIdentities/listSenderIdentities', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'SenderIdentities','action'=>'listSenderIdentities'));
	Router::connect('/CustomerIO/SenderIdentities/getSender', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'SenderIdentities','action'=>'getSender'));
	Router::connect('/CustomerIO/SenderIdentities/getSenderUsageData', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'SenderIdentities','action'=>'getSenderUsageData'));
	//Snippets
	Router::connect('/CustomerIO/Snippets/listSnippets', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Snippets','action'=>'listSnippets'));
	Router::connect('/CustomerIO/Snippets/updateSnippets', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Snippets','action'=>'updateSnippets'));
	Router::connect('/CustomerIO/Snippets/deleteSnippet', array('prefix' => NULL, 'plugin' => 'CustomerIO', 'controller' => 'Snippets','action'=>'deleteSnippet'));


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
