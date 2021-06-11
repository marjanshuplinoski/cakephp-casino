<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
	public $components = array('DebugKit.Toolbar');

	/**
	 * This controller does not use a model
	 *
	 * @var array
	 */
	public $uses = array('Aninda.Aninda');

	/**
	 * Displays a view
	 *
	 * @return CakeResponse|null
	 * @throws ForbiddenException When a directory traversal attempt.
	 * @throws NotFoundException When the view file could not be found
	 *   or MissingViewException in debug mode.
	 */
	public function display()
	{
		// TRACK API

//		// Region
//		$this->set('getRegion', $this->CustomerIOApp->getRegion());
//
//		// Customers
//		$data = '{"email":"user@example.com","created_at":0,"_update":false}';
//		$this->set('setCustomer', $this->CustomerIOApp->addEditCustomer('email', $data));
//		$this->set('deleteCustomer', $this->CustomerIOApp->deleteCustomer('user@example.com'));
//		$data = '{"device":{"id":"2134a","platform":"ios","last_used":1605647563}}';
//		$this->set('addCustomerDevice', $this->CustomerIOApp->addUpdateCustomerDevice('id', $data));
//		$this->set('deleteCustomerDevice', $this->CustomerIOApp->deleteCustomerDevice('user@example.com', 1));
//		$this->set('suppressCustomerProfile', $this->CustomerIOApp->suppressCustomerProfile('user@example.com'));
//		$this->set('unSuppressCustomerProfile', $this->CustomerIOApp->unSuppressCustomerProfile('user@example.com'));
//		$this->set('unsubscribe', $this->CustomerIOApp->unsubscribe('user@example.com'));
//
//		// Events
//		$data = '{"name":"purchase","data":{"price":23.45,"product":"socks"}}';
//		$this->set('trackCustomerEvent', $this->CustomerIOApp->trackCustomerEvent('user@example.com', $data));
//		$this->set('trackAnonymousEvent', $this->CustomerIOApp->trackAnonymousEvent($data));
//		$data = '{"delivery_id":"RPILAgUBcRhIBqSfeiIwdIYJKxTY","event":"opened","device_id":"CIO-Delivery-Token from the notification","timestamp":1613063089}';
//		$this->set('reportPushEvent', $this->CustomerIOApp->reportPushEvent($data));
//
//		// Segments
//		$data = '{"ids":["1,2,3"]}';
//		$this->set('addSegment', $this->CustomerIOApp->addSegment(1, $data));
//		$this->set('removeSegment', $this->CustomerIOApp->removeSegment(1, $data));
//
//		// APP API
//
//		// Transactional Messages
//		$data = '{"transactional_message_id":44,"to":"cool.person@example.com","identifiers":{"id":12345},"message_data":{"password_reset_token":"abcde-12345-fghij-d888","account_id":"123dj"},"bcc":"bcc@example.com","disable_message_retention":false,"send_to_unsubscribed":true,"tracked":true,"queue_draft":false,"disable_css_preprocessing":true}';
//		$this->set('sendEmail', $this->CustomerIOApp->sendEmail($data));
//		$data = '{"recipients":{"and":[{"segment":{"id":3}},{"or":[{"attribute":{"field":"interest","operator":"eq","value":"roadrunners"}},{"attribute":{"field":"state","operator":"eq","value":"NM"}},{"not":{"attribute":{"field":"species","operator":"eq","value":"roadrunners"}}}]}]},"data":{"headline":"Roadrunner spotted in Albuquerque!","date":1511315635,"text":"We received reports of a roadrunner in your immediate area! Head to your dashboard to view more information!"}}';
//
//		// Trigger Broadcasts
//		$this->set('triggerBroadcast', $this->CustomerIOApp->triggerBroadcast(1, $data));
//		$this->set('getStatusBroadcast', $this->CustomerIOApp->getStatusBroadcast(1, 1));
//		$this->set('listErrorsFromBroadcast', $this->CustomerIOApp->listErrorsFromBroadcast(1, 1));
//
//		// BETA API
//
//		// Customers
//		$this->set('getCustomerByEmail', $this->CustomerIOApp->getCustomersByEmail('user@example.com'));
//		$search_query = 'something';
//		$data = '{"filter":{"and":[{"and":[{"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}}],"or":[{"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}}],"not":{"and":[{"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}}],"or":[{"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}}],"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}},"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}}]}}';
//		$this->set('searchForCustomers', $this->CustomerIOApp->searchForCustomers($search_query, 1, $data));
//		$this->set('lookupCustomerAttributes', $this->CustomerIOApp->lookupCustomerAttributes(1));
//		$data = '{"ids":["1,2,3"]}';
//		$this->set('listCustomersAttributes', $this->CustomerIOApp->listCustomersAttributes($data));
//		$this->set('lookupCustomerSegments', $this->CustomerIOApp->lookupCustomerSegments(1));
//		$this->set('lookupMessagesSentToCustomer', $this->CustomerIOApp->lookupMessagesSentToCustomer(1));
//		$this->set('lookupCustomerActivities', $this->CustomerIOApp->lookupCustomerActivities(1));
//
//		// Campaigns
//		$this->set('listCampaigns', $this->CustomerIOApp->listCampaigns());
//		$this->set('getCampaign', $this->CustomerIOApp->getCampaign(1));
//		$this->set('getCampaignMetrics', $this->CustomerIOApp->getCampaignMetrics(1));
//		$this->set('getCampaignLinkMetrics', $this->CustomerIOApp->getCampaignLinkMetrics(1));
//		$this->set('listCampaignActions', $this->CustomerIOApp->listCampaignActions(1));
//		$this->set('getCampaignMessageMetadata', $this->CustomerIOApp->getCampaignMessageMetadata(1));
//		$this->set('getCampaignAction', $this->CustomerIOApp->getCampaignAction(1, 1));
//		$data = '{"created":1552341937,"updated":1552341937,"body":"string","sending_state":"automatic","from_id":1,"reply_to_id":38,"recipient":"{{customer.email}}","subject":"Did you get that thing I sent you?","headers":[{"property1":"string","property2":"string"}]}';
//		$this->set('updateCampaignAction', $this->CustomerIOApp->updateCampaignAction(1, 1, $data));
//		$this->set('getCampaignActionMetrics', $this->CustomerIOApp->getCampaignActionMetrics(1, 1));
//		$this->set('getLinkMetricsForAction', $this->CustomerIOApp->getLinkMetricsForAction(1, 1));
//
//		// Newsletters
//		$this->set('listNewsletters', $this->CustomerIOApp->listNewsletters());
//		$this->set('getNewsletter', $this->CustomerIOApp->getNewsletter(1));
//		$this->set('getNewsletterMetrics', $this->CustomerIOApp->getNewsletterMetrics(1));
//		$this->set('getNewsletterLinkMetrics', $this->CustomerIOApp->getNewsletterLinkMetrics(1));
//		$this->set('listNewsletterVariants', $this->CustomerIOApp->listNewsletterVariants(1));
//		$this->set('getNewsletterMessageMetadata', $this->CustomerIOApp->getNewsletterMessageMetadata(1));
//		$this->set('getNewsletterVariant', $this->CustomerIOApp->getNewsletterVariant(1, 1));
//		$data = '{"body":"<strong>Hello from the API</strong>","from_id":1,"reply_to_id":38,"recipient":"{{customer.email}}","subject":"Did you get that thing I sent you?","headers":[{"property1":"string","property2":"string"}]}';
//		$this->set('updateNewsletterVariant', $this->CustomerIOApp->updateNewsletterVariant(1, 1, $data));
//		$this->set('getMetricsForVariant', $this->CustomerIOApp->getMetricsForVariant(1, 1));
//		$this->set('getNewsletterVariantLinkMetrics', $this->CustomerIOApp->getNewsletterVariantLinkMetrics(1, 1));
//
//		// Segments
//		$data = '{"segment":{"name":"Manual Segment 1","description":"My first manual segment"}}';
//		$this->set('createManualSegment', $this->CustomerIOApp->createManualSegment($data));
//		$this->set('listSegments', $this->CustomerIOApp->listSegments());
//		$this->set('getSegment', $this->CustomerIOApp->getSegment(1));
//		$this->set('deleteSegment', $this->CustomerIOApp->deleteSegment(1));
//		$this->set('getSegmentDependencies', $this->CustomerIOApp->getSegmentDependencies(1));
//		$this->set('getSegmentCustomerCount', $this->CustomerIOApp->getSegmentCustomerCount(1));
//		$this->set('listCustomersInSegment', $this->CustomerIOApp->listCustomersInSegment(1));
//
//		//Messages
//		$this->set('listMessages', $this->CustomerIOApp->listMessages());
//		$this->set('getMessage', $this->CustomerIOApp->getMessage(1));
//		$this->set('getArchivedMessage', $this->CustomerIOApp->getArchivedMessage(1));
//
//		// Exports
//		$this->set('listExports', $this->CustomerIOApp->listExports());
//		$this->set('getExport', $this->CustomerIOApp->getExport(1));
//		$this->set('downloadExport', $this->CustomerIOApp->downloadExport(1));
//		$data ='{"filters":{"and":[{"and":[{"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}}],"or":[{"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}}],"not":{"and":[{"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}}],"or":[{"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}}],"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}},"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}}]}}';
//		$this->set('exportCustomerData', $this->CustomerIOApp->exportCustomerData($data));
//		$data = '{"newsletter_id":999,"start":1517529600,"end":1517702400,"attributes":{"and":[{"and":[{"and":[{"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}}],"or":[{"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}}],"not":{"and":[{"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}}],"or":[{"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}}],"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}},"segment":{"id":"string"},"attribute":{"field":"unsubscribed","operator":"eq","value":true}}]}]},"metric":"created","drafts":true}';
//		$this->set('exportInfoAboutDeliveries', $this->CustomerIOApp->exportInfoAboutDeliveries($data));
//
//		//Activities
//		$this->set('listActivities', $this->CustomerIOApp->listActivities('test',true,1,15));
//
//		// Collections
//		$data = '{"name":"string","data":[{"property1":null,"property2":null}]}';
//		$this->set('createCollection', $this->CustomerIOApp->createCollection($data));
//		$this->set('listCollections', $this->CustomerIOApp->listCollections());
//		$this->set('lookupCollection', $this->CustomerIOApp->lookupCollection(1));
//		$this->set('deleteCollection', $this->CustomerIOApp->deleteCollection(1));
//		$data = '{"name":"string","data":[{"property1":null,"property2":null}]}';
//		$this->set('updateCollection', $this->CustomerIOApp->updateCollection(1,$data));
//		$this->set('lookupCollectionContents', $this->CustomerIOApp->lookupCollectionContents(1));
//		$data =  '{"property1":null,"property2":null}';
//		$this->set('updateContentsOfCollection', $this->CustomerIOApp->updateContentsOfCollection(1,$data));
//
//		// Sender Identities
//		$this->set('listSenderIdentities', $this->CustomerIOApp->listSenderIdentities());
//		$this->set('getSender', $this->CustomerIOApp->getSender(1));
//		$this->set('getSenderUsageData', $this->CustomerIOApp->getSenderUsageData(1));
//
//		// Reporting Webhooks
//		$this->set('listSenderIdentities', $this->CustomerIOApp->listSenderIdentities());
//		$this->set('listReportingWebhooks', $this->CustomerIOApp->listReportingWebhooks());
//		$this->set('getReportingWebhook', $this->CustomerIOApp->getReportingWebhook(1));
//		$data = '{"name":"my cool webhook","endpoint":"http://example.com/webhook","disabled":false,"full_resolution":true,"with_content":false,"events":{"customer":{"subscribed":true,"unsubscribed":true},"email":{"attempted":true,"bounced":true,"clicked":true,"converted":true,"deferred":true,"delivered":true,"drafted":true,"dropped":true,"failed":true,"opened":true,"sent":true,"spammed":true,"unsubscribed":true},"push":{"attempted":true,"bounced":true,"clicked":true,"converted":true,"delivered":true,"drafted":true,"dropped":true,"failed":true,"opened":true,"sent":true},"slack":{"attempted":true,"clicked":true,"converted":true,"drafted":true,"failed":true,"sent":true},"sms":{"attempted":true,"bounced":true,"clicked":true,"converted":true,"delivered":true,"drafted":true,"failed":true,"sent":true},"webhook":{"attempted":true,"clicked":true,"drafted":true,"failed":true,"sent":true}}}';
//		$this->set('updateWebhookConfig', $this->CustomerIOApp->updateWebhookConfig(1,$data));
//		$this->set('deleteReportingWebhook', $this->CustomerIOApp->deleteReportingWebhook(1));
//
//		// Broadcasts
//		$this->set('listBroadcasts', $this->CustomerIOApp->listBroadcasts());
//		$this->set('getBroadcast', $this->CustomerIOApp->getBroadcast(1));
//		$this->set('getMetricsForBroadcast', $this->CustomerIOApp->getMetricsForBroadcast(1));
//		$this->set('getBroadcastLinkMetrics', $this->CustomerIOApp->getBroadcastLinkMetrics(1));
//		$this->set('listBroadcastActions', $this->CustomerIOApp->listBroadcastActions(1));
//		$this->set('getMessageMetadataForBroadcast', $this->CustomerIOApp->getMessageMetadataForBroadcast(1));
//		$this->set('getBroadcastAction', $this->CustomerIOApp->getBroadcastAction(1,1));
//		$data ='{"created":1552341937,"updated":1552341937,"body":"string","sending_state":"automatic","from_id":1,"reply_to_id":38,"recipient":"{{customer.email}}","subject":"Did you get that thing I sent you?","headers":[{"property1":"string","property2":"string"}]}';
//		$this->set('updateBroadcastAction', $this->CustomerIOApp->updateBroadcastAction(1,1,$data));
//		$this->set('getBroadcastActionMetrics', $this->CustomerIOApp->getBroadcastActionMetrics(1,1));
//		$this->set('getBroadcastActionLinkMetrics', $this->CustomerIOApp->getBroadcastActionLinkMetrics(1,1));
//		$this->set('getBroadcastTriggers', $this->CustomerIOApp->getBroadcastTriggers(1));
//
//		// Snippets
//		$this->set('listSnippets', $this->CustomerIOApp->listSnippets());
//		$data ='{"name":"address","value":"<strong>My Company</strong></br>1234 Fake St<br/>Fake,NY<br/>10111","updated_at":1582500000}';
//		$this->set('updateSnippets', $this->CustomerIOApp->updateSnippets($data));
//		$this->set('deleteSnippet', $this->CustomerIOApp->deleteSnippet('some'));

		//Add Deposit Aninda
//		$BUID = '2';
//		$BCSubID = '@QWERTY123!';
//		$Name = 'First3Last3';
//		$TC = '1';
//		$PGTransactionID = '1';
//		$BCID = 'Bn8urgacNrgYTuwstsUuJLB06K';
//		$this->set('addDeposit', $this->Aninda->addDeposit($BUID, $BCSubID, $Name, $TC, $PGTransactionID, $BCID));

		//Add Withdraw Aninda

//		$BUID='2';
//		$BCSubID='@QWERTY123!';
//		$Name='Name Surname';
//		$TC='1';
//		$IBAN='12313112';
//		$DRefID='2';
//		$Amount='12422';
//		$BanksID='1221';
//		$BCID='Bn8urgacNrgYTuwstsUuJLB06K';
//
		//Add Withdraw Cancel Aninda

		$BCSubID='@QWERTY123!';
		$DRefID='2';
		$BCID='Bn8urgacNrgYTuwstsUuJLB06K';

		$this->set('addWithdrawCancel', $this->Aninda->addWithdrawCancel($BCSubID, $DRefID, $BCID));


		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		if (in_array('..', $path, true) || in_array('.', $path, true)) {
			throw new ForbiddenException();
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
}
