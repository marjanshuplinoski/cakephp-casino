<?php

App::uses('AppModel', 'Model');

class CustomerIOAppModel extends AppModel
{

	public function __construct($id = false, $table = null, $ds = null)
	{
		parent::__construct($id, $table, $ds);
		Configure::load('old_CustomerIO.old_CustomerIO');

		if (Configure::read('old_CustomerIO.Config') == 0)
			throw new Exception('Config not found', 500);

		$this->config = Configure::read('old_CustomerIO.Config');
	}

	// TRACK API

	/*
	 *  Account Region
	 * 	Determine whether your account and data are hosted in the US or EU data center using your Track API Key.
	 * 	This endpoint returns the appropriate region and URL for your Track API credentials.
	 * 	Use it to determine the URLs you should use to successfully complete other requests.
	 * 	You can perform this operation against either of the track API regional URLs; it returns your region in either case.
	 * 	This endpoint also returns an environment_id, which represents the workspace the credentials are valid for.
	*/


	public function getRegion()
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'accounts/region';
		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY'])
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	// Customers

	/*
	 * Add or update a customer
	 * If the identifier in the path and identifiers in the request body belong to different people,
	 * your request will produce an Attribute Update Failure. If your workspace uses email as an identifier,
	 * we treat person@example.com and PERSON@example.com as duplicates; these addresses represent the same person.
	 */

	public function addEditCustomer($identifier, $data)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier;

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY']),
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPut($url, $header, $data));
		return $request;
	}

	/*
	 * Delete a customer
	 * Deleting a customer removes them, and all of their information, from Customer.io.
	 */

	public function deleteCustomer($identifier)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier;

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY'])
		);

		$request = json_decode($this->cURLDelete($url, $header));
		return $request;
	}

	/*
	 * Add or update a customer device
	 * Customers can have more than one device. Use this method to add iOS and Android devices to,
	 *  or update devices for, a customer profile.
	 */

	public function addUpdateCustomerDevice($identifier, $data)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier . '/devices';

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY']),
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPut($url, $header, $data));
		return $request;
	}

	/*
	 * Delete a customer device
	 * Remove a device from a customer profile. If you continue sending data about a device to Customer.io,
	 * you may inadvertently re-add the device to the customer profile.
	 */

	public function deleteCustomerDevice($identifier, $device_id)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier . '/devices/' . $device_id;

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY'])
		);

		$request = json_decode($this->cURLDelete($url, $header));
		return $request;
	}

	/*
	 * Suppress a customer profile
	 * Delete a customer profile and prevent the ID from being re-added to your workspace.
	 * Any future API calls or operations referencing the specified ID are ignored.
	 */

	public function suppressCustomerProfile($identifier)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier . '/suppress';

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY'])
		);

		$request = json_decode($this->cURLPost($url, $header));
		return $request;
	}

	/*
	 * Unsuppress a customer profile
	 * Unsuppressing a profile ID allows you to add the customer back to Customer.io.
	 * Unsuppressing a profile does not recreate the profile that you previously suppressed.
	 * Rather, it just makes the identifier available again. Identifying a person after unsuppressing
	 * them creates a new profile, with none of the history of the previously suppressed ID.
	 */

	public function unSuppressCustomerProfile($identifier)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier . '/unsuppress';

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY'])
		);

		$request = json_decode($this->cURLPost($url, $header));
		return $request;
	}

	/*
	 * Custom unsubscribe handling
	 * If you use custom unsubscribe links, you can host a custom unsubscribe page and use this API to send unsubscribe data,
	 * associated with a particular delivery, to Customer.io. This endpoint does not require an Authorization header.
	 * Your request sets a person's unsubscribed attribute to true, attributes their unsubscribe request to the individual
	 * email/delivery that they they unsubscribed from, and lets you segment your audience based on email_unsubscribed events
	 * when you use a custom subscription center.
	 */

	public function unsubscribe($delivery_id)
	{
		$url = $this->config['Config']['US']['GENERAL_API_URL'] . 'unsubscribe' . $delivery_id;

		$header = array(
			'content-type: application/json'
		);

		$data = '{"unsubscribe":true}';
		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}


	// Events

	/*
	 * Track a customer event
	 * Send an event associated with a person, referenced by the identifier in the path.
	 * Use this endpoint to track events outside of a browser or directly from your server-side code.
	 */

	public function trackCustomerEvent($identifier, $data)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier . '/events';

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY']),
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}

	/*
	 * Track an anonymous event
	 * Anonymous events can also be sent to Customer.io by way of a POST to the events resource
	 * directly without a customer ID. For example, this might be something you do if you want to
	 * send invitation emails to people who aren't yet in your workspace.
	 */

	public function trackAnonymousEvent($data)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'events';

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY']),
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}

	/*
	 * Report push metrics
	 * Use this endpoint to report device-side push metrics—opened, converted, and delivered—back to Customer.io,
	 * so you can track the effectiveness of your push notifications. Customer.io has no way of knowing about these metrics,
	 * or associating metrics with a specific message, unless you report them back to us.
	 */

	public function reportPushEvent($data)
	{
		$url = $this->config['Config']['US']['GENERAL_API_URL'] . 'push/events';

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY']),
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}

	/*
	 * Add people to a manual segment
	 * Add people to a manual segment by ID. If you send customer IDs that don’t exist yet,
	 * we automatically create customer profiles for the new customer IDs. You are limited to
	 * 1000 customer IDs per request.
	 */

	public function addSegment($segment_id, $data)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'segments/' . $segment_id . '/add_customers';

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY']),
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}

	/*
	 * Remove people from a manual segment
	 * You can remove users from a manual segment by ID. You are limited to 1000 customer IDs per request.
	 */

	public function removeSegment($segment_id, $data)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'segments/' . $segment_id . '/remove_customers';

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY']),
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}






	/*
	 * ==============================================================
	 * ==============================================================
	 */

	// APP API

	/*
	 * Send a transactional email
	 * Send a transactional email. You can send a with a template using a transactional_message_id or send your own body, subject, and from values at send time.
	 */

	public function sendEmail($data)
	{
		$url = $this->config['Config']['US']['APP_API_URL'] . 'send/email';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY'],
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}

	/*
	 * Trigger a broadcast
	 * Manually trigger a broadcast, and provide data to populate messages in your trigger.
	 * The shape of the request changes based on the type of audience you broadcast to: a segment,
	 * a list of emails, a list of customer IDs, a map of users, or a data file. You can reference
	 * properties in the data object from this request using liquid—{{trigger.<property_in_data_obj>}}.
	 */

	public function triggerBroadcast($broadcast_id, $data)
	{
		$url = $this->config['Config']['US']['APP_API_URL'] . '/campaigns/' . $broadcast_id . '/triggers';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY'],
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}

	/*
	 * Get the status of a broadcast
	 * After triggering a broadcast you can retrieve the status of that broadcast using a GET of the trigger_id resource.
	 */

	public function getStatusBroadcast($broadcast_id, $trigger_id)
	{
		$url = $this->config['Config']['US']['APP_API_URL'] . 'campaigns/' . $broadcast_id . '/triggers/' . $trigger_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 *List errors from a broadcast
	 * After triggering a broadcast you can retrieve a list of errors from your broadcast.
	 * Typically errors represent issues in your broadcast audience and associated data.
	 */

	public function listErrorsFromBroadcast($broadcast_id, $trigger_id)
	{
		$url = $this->config['Config']['US']['APP_API_URL'] . 'campaigns/' . $broadcast_id . '/triggers/' . $trigger_id . '/errors';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}


	/*
	 * ==============================================================
	 * ==============================================================
	 */

	// BETA API

	/*
	 * Get customers by email
	 * Return a list of people in your workspace matching an email address.
	 */

	public function getCustomersByEmail($email)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'customers?email=' . $email;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Search for customers
	 * Provide a filter to search for people in your workspace. You can return up to 1000 people per request.
	 * If you want to return a larger set of people in a single request, you may want to use the /exports API instead.
	 */

	public function searchForCustomers($search_query, $limit, $data)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'customers?start=' . $search_query . '&limit=' . $limit;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY'],
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}

	/*
	 * Lookup a customer's attributes
	 * Return a list of attributes for a customer profile. You can use attributes to fashion segments or as liquid merge fields in your messages.
	 */

	public function lookupCustomerAttributes($customer_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'customers/' . $customer_id . '/attributes';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * List customers and attributes
	 * Return attributes for up to 100 customers by ID. If an ID in the request does not exist, the response omits it.
	 */

	public function listCustomersAttributes($data)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'customers/attributes';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY'],
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}

	/*
	 * Lookup a customer's segments
	 * Returns a list of segments that a customer profile belongs to.
	 */

	public function lookupCustomerSegments($customer_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'customers/' . $customer_id . '/segments';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Lookup messages sent to a customer
	 * Return metadata for the messages sent to a customer profile.
	 */

	public function lookupMessagesSentToCustomer($customer_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'customers/' . $customer_id . '/messages';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Lookup a customer's activities
	 * Return a list of activities performed by, or for, a customer. Activities are things like attribute changes and message sends.
	 */

	public function lookupCustomerActivities($customer_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'customers/' . $customer_id . '/activities';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	// Campaigns

	/*
	 * List campaigns
	 * Returns a list of your campaigns and associated metadata.
	 */

	public function listCampaigns()
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'campaigns';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get a campaign
	 * Returns metadata for an individual campaign.
	 */

	public function getCampaign($campaign_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'campaigns/' . $campaign_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get campaign metrics
	 * Returns a list of metrics for an individual campaign both in total and in steps (days, weeks, etc).
	 * Stepped series metrics return from oldest to newest (i.e. the 0-index for any result is the oldest step/period).
	 */

	public function getCampaignMetrics($campaign_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'campaigns/' . $campaign_id . '/metrics';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get campaign link metrics
	 * Returns metrics for link clicks within a campaign, both in total and in series periods (days, weeks, etc).
	 * series metrics are ordered oldest to newest (i.e. the 0-index for any result is the oldest step/period).
	 */

	public function getCampaignLinkMetrics($campaign_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'campaigns/' . $campaign_id . '/metrics/links';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * List campaign actions
	 * Returns the operations in a campaign workflow. Each object in the response represents a 'tile' in the campaign builder.
	 */

	public function listCampaignActions($campaign_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'campaigns/' . $campaign_id . '/actions';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}


	/*
	 * Get campaign message metadata
	 * Returns metadata for the messages in a campaign. Provide query parameters to refine the metrics you want to return.
	 */

	public function getCampaignMessageMetadata($campaign_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'campaigns/' . $campaign_id . '/messages';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get a campaign action
	 * Returns information about a specific action in a campaign.
	 */

	public function getCampaignAction($campaign_id, $action_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'campaigns/' . $campaign_id . '/actions/' . $action_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Update a campaign action
	 * Update the contents of a campaign action, including the body of messages and HTTP requests.
	 */

	public function updateCampaignAction($campaign_id, $action_id, $data)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'campaigns/' . $campaign_id . '/actions/' . $action_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY'],
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPut($url, $header, $data));
		return $request;
	}

	/*
	 * Get campaign action metrics
	 * Returns a list of metrics for an individual action both in total and in steps (days, weeks, etc) over a period of time.
	 * Stepped series metrics return from oldest to newest (i.e. the 0-index for any result is the oldest step/period).
	 */

	public function getCampaignActionMetrics($campaign_id, $action_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'campaigns/' . $campaign_id . '/actions/' . $action_id . '/metrics';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get link metrics for an action
	 * Returns link click metrics for an individual action. Unless you specify otherwise, the response contains data for the maximum period by days (45 days).
	 */

	public function getLinkMetricsForAction($campaign_id, $action_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'campaigns/' . $campaign_id . '/actions/' . $action_id . '/metrics/links';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}


	// Newsletters

	/*
	 * List newsletters
	 * Returns a list of your newsletters and associated metadata.
	 */

	public function listNewsletters()
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'newsletters';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get a newsletter
	 * Returns metadata for an individual newsletter.
	 */

	public function getNewsletter($newsletter_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'newsletters/' . $newsletter_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get newsletter metrics
	 * Returns a list of metrics for an individual newsletter both in total and in steps (days, weeks, etc).
	 * Stepped series metrics return from oldest to newest (i.e. the 0-index for any result is the oldest step/period).
	 */
	public function getNewsletterMetrics($newsletter_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'newsletters/' . $newsletter_id . '/metrics';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get newsletter link metrics
	 * Returns metrics for link clicks within a newsletter, both in total and in series periods (days, weeks, etc). series metrics are ordered oldest to newest
	 *  (i.e. the 0-index for any result is the oldest step/period).
	 */

	public function getNewsletterLinkMetrics($newsletter_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'newsletters/' . $newsletter_id . '/metrics/links';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * List newsletter variants
	 * Returns the content variants of a newsletter.
	 */

	public function listNewsletterVariants($newsletter_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'newsletters/' . $newsletter_id . '/contents';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get newsletter message metadata
	 * Returns metadata for the message(s) sent by newsletter. Provide query parameters to refine the metrics you want to return.
	 */

	public function getNewsletterMessageMetadata($newsletter_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'newsletters/' . $newsletter_id . '/messages';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get a newsletter variant
	 * Returns information about a specific variant of a newsletter.
	 */

	public function getNewsletterVariant($newsletter_id, $contents_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'newsletters/' . $newsletter_id . '/contents/' . $contents_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Update a newsletter variant
	 * Update the contents of a newsletter variant, including the body of a newsletter.
	 */

	public function updateNewsletterVariant($newsletter_id, $contents_id, $data)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'newsletters/' . $newsletter_id . '/contents/' . $contents_id;

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY']),
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPut($url, $header, $data));
		return $request;
	}

	/*
	 * Get metrics for a variant
	 * Returns a metrics for an individual newsletter variant, both in total and in steps (days, weeks, etc) over a period of time.
	 * Stepped series metrics are arranged from oldest to newest (i.e. the 0-index for any result is the oldest period/step).
	 */

	public function getMetricsForVariant($newsletter_id, $contents_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'newsletters/' . $newsletter_id . '/contents/' . $contents_id . '/metrics';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get newsletter variant link metrics
	 * Returns link click metrics for an individual newsletter variant. Unless you specify otherwise, the response contains data for the maximum period by days (45 days).
	 */

	public function getNewsletterVariantLinkMetrics($newsletter_id, $contents_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'newsletters/' . $newsletter_id . '/contents/' . $contents_id . '/metrics/links';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}


	// Segments

	/*
	 * Create a manual segment
	 * Create a manual segment with a name and a description. This request creates an empty segment.
	 */

	public function createManualSegment($data)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'segments';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}

	/*
	 * List segments
	 * Retrieve a list of all of your segments.
	 */

	public function listSegments()
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'segments';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get a segment
	 * Return information about a segment.
	 */

	public function getSegment($segment_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'segments';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Delete a segment
	 * Delete a manual segment.
	 */

	public function deleteSegment($segment_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'segments/' . $segment_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLDelete($url, $header));
		return $request;

	}

	/*
	 * Get a segment's dependencies
	 * Use this endpoint to find out which campaigns and newsletters use a segment.
	 */

	public function getSegmentDependencies($segment_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'segments/' . $segment_id . '/used_by';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get a segment customer count
	 * Returns the membership count for a segment.
	 */

	public function getSegmentCustomerCount($segment_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'segments/' . $segment_id . '/customer_count';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * List customers in a segment
	 * Returns the IDs of customers in a segment.
	 */

	public function listCustomersInSegment($segment_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'segments/' . $segment_id . '/membership';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	// Messages

	/*
	 * List messages
	 * Return a list of deliveries, including metrics for each delivery, for messages in your workspace.
	 * The request body contains filters determining the deliveries you want to return information about.
	 */

	public function listMessages()
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'messages';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get a message
	 * Return a information about, and metrics for, a delivery—the instance of a message intended for an individual recipient person.
	 */

	public function getMessage($message_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'messages/' . $message_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get an archived message
	 * Returns the archived copy of a delivery, including the message body, recipient, and metrics.
	 * This endpoint is limited to 100 requests per day. Contact win@customer.io if you need to exceed this limit.
	 */

	public function getArchivedMessage($message_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'messages/' . $message_id . '/archived_message';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	//Exports

	/*
	 * List exports
	 * Return a list of your exports. Exports are point-in-time people or campaign metrics.
	 */

	public function listExports()
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'exports';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get an export
	 * Return information about a specific export.
	 */

	public function getExport($export_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'exports/' . $export_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Download an export
	 * This endpoint returns a signed link to download an export. The link expires after 15 minutes.
	 */

	public function downloadExport($export_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'exports/' . $export_id . '/download';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Export customer data
	 * Provide filters and attributes describing the customers you want to export. This endpoint returns export metadata; use the /exports/{export_id}/endpoint to download your export.
	 */

	public function exportCustomerData($data)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'exports/customers';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY'],
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}

	/*
	 * Export information about deliveries
	 * Provide filters for the newsletter, campaign, or action you want to return delivery information from.
	 * This endpoint returns information about an export; use the /exports/{export_id} endpoint to download your export.
	 */

	public function exportInfoAboutDeliveries($data)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'exports/deliveries';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY'],
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}

	// Activities

	/*
	 * List activities
	 * This endpoint returns a list of activities in your workspace.
	 */

	public function listActivities($start_string, $deleted, $customer_id, $limit)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'activities?start=' . $start_string . '&type=sent_email&name=something_happened&deleted=' . $deleted . '&customer_id=' . $customer_id . '&limit=' . $limit;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	//Collections

	/*
	 * Create a collection
	 * Create a new collection and provide the data that you'll access from the collection or the url that you'll download the data from.
	 */

	public function createCollection($data)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'collections';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY'],
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}

	/*
	 * List your collections
	 * Returns a list of all of your collections, including the name and schema for each collection.
	 */

	public function listCollections()
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'collections';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Lookup a collection
	 * Retrieves details about a collection, including the schema and name. This request does not include the content
	 * of the collection (the values associated with keys in the schema).
	 */

	public function lookupCollection($collection_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'collections/' . $collection_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Delete a collection
	 * Remove a collection and associated contents. Before you delete a collection, make sure that you aren't
	 * referencing it in active campaign messages or broadcasts; references to a deleted collection will appear
	 * empty and may prevent your messages from making sense to your audience.
	 */

	public function deleteCollection($collection_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'collections/' . $collection_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLDelete($url, $header));
		return $request;
	}

	/*
	 * Update a collection
	 * Update the name or contents of a collection. Updating the data or url for your collection fully replaces the contents of the collection.
	 */

	public function updateCollection($collection_id, $data)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'collections/' . $collection_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY'],
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}

	/*
	 * Lookup collection contents
	 * Retrieve the contents of a collection (the data from when you created or updated a collection).
	 * Each row in the collection is represented as a JSON blob in the response.
	 */

	public function lookupCollectionContents($collection_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'collections/' . $collection_id . '/content';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Update the contents of a collection
	 * Replace the contents of a collection (the data from when you created or updated a collection).
	 * The request is a free-form object containing the keys you want to reference from the collection and the
	 * corresponding values. This request replaces the current contents of the collection entirely.
	 */

	public function updateContentsOfCollection($collection_id, $data)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'collections/' . $collection_id . '/content';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLPut($url, $header, $data));
		return $request;
	}

	// Sender Identities

	/*
	 * List sender identities
	 * Returns a list of senders in your workspace. Senders are who your messages are "from".
	 */

	public function listSenderIdentities()
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'sender_identities';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get a sender
	 * Returns information about a specific sender.
	 */

	public function getSender($sender_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'sender_identities/' . $sender_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get sender usage data
	 * Returns lists of the campaigns and newsletters that use a sender.
	 */

	public function getSenderUsageData($sender_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'sender_identities/' . $sender_id . '/used_by';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	// Reporting Webhoooks

	/*
	 * Create a reporting webhook
	 * Create a new webhook configuration.
	 */

	public function reportingWebhook($data)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'reporting_webhooks';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY'],
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}

	/*
	 * List reporting webhooks
	 * Return a list of all of your reporting webhooks
	 */

	public function listReportingWebhooks()
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'reporting_webhooks';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get a reporting webhook
	 * Returns information about a specific reporting webhook.
	 */

	public function getReportingWebhook($webhook_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'reporting_webhooks/' . $webhook_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Update a webhook configuration
	 * Update the configuration of a reporting webhook. Turn events on or off, change the webhook URL, etc.
	 */

	public function updateWebhookConfig($webhook_id, $data)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'reporting_webhooks/' . $webhook_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLPut($url, $header, $data));
		return $request;
	}

	/*
	 * Delete a reporting webhook
	 * Delete a reporting webhook's configuration.
	 */

	public function deleteReportingWebhook($webhook_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'reporting_webhooks/' . $webhook_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLDelete($url, $header));
		return $request;
	}

	// Broadcasts

	/*
	 * List broadcasts
	 * Returns a list of your broadcasts and associated metadata.
	 */

	public function listBroadcasts()
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'broadcasts';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get a broadcast
	 * Returns metadata for an individual broadcast.
	 */

	public function getBroadcast($broadcast_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'broadcasts/' . $broadcast_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get metrics for a broadcast
	 * Returns a list of metrics for an individual broadcast both in total and in steps (days, weeks, etc).
	 * Stepped series metrics return from oldest to newest (i.e. the 0-index for any result is the oldest step/period).
	 */

	public function getMetricsForBroadcast($broadcast_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'broadcasts/' . $broadcast_id . '/metrics';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get broadcast link metrics
	 * Returns metrics for link clicks within a broadcast, both in total and in series periods (days, weeks, etc).
	 * series metrics are ordered oldest to newest (i.e. the 0-index for any result is the oldest step/period).
	 */

	public function getBroadcastLinkMetrics($broadcast_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'broadcasts/' . $broadcast_id . '/metrics/links';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * List broadcast actions
	 * Returns the actions that occur as a part of a broadcast.
	 */

	public function listBroadcastActions($broadcast_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'broadcasts/' . $broadcast_id . '/actions';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get message metadata for a broadcast
	 * Returns metadata for the messages sent by broadcast. Provide query parameters to refine the metrics you want to return.
	 */

	public function getMessageMetadataForBroadcast($broadcast_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'broadcasts/' . $broadcast_id . '/messages';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get a broadcast action
	 * Returns information about a specific action within a broadcast.
	 */

	public function getBroadcastAction($broadcast_id, $action_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'broadcasts/' . $broadcast_id . '/actions/' . $action_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Update a broadcast action
	 * Update the contents of a broadcast action, including the body of messages or HTTP requests.
	 */

	public function updateBroadcastAction($broadcast_id, $action_id, $data)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'broadcasts/' . $broadcast_id . '/actions/' . $action_id;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY'],
			'content-type: application/json'

		);

		$request = json_decode($this->cURLPut($url, $header, $data));
		return $request;
	}

	/*
	 * Get broadcast action metrics
	 * Returns a list of metrics for an individual action both in total and in steps (days, weeks, etc) over a
	 * period of time. Stepped series metrics return from oldest to newest (i.e. the 0-index for any result is the
	 * oldest step/period).
	 */

	public function getBroadcastActionMetrics($broadcast_id, $action_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'broadcasts/' . $broadcast_id . '/actions/' . $action_id . '/metrics';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get broadcast action link metrics
	 * Returns link click metrics for an individual broadcast action. Unless you specify otherwise,
	 * the response contains data for the maximum period by days (45 days).
	 */

	public function getBroadcastActionLinkMetrics($broadcast_id, $action_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'broadcasts/' . $broadcast_id . '/actions/' . $action_id . '/metrics/links';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get broadcast triggers
	 * Returns a list of the triggers for a broadcast.
	 */

	public function getBroadcastTriggers($broadcast_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'broadcasts/' . $broadcast_id . '/triggers';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	// Snippets

	/*
	 * List snippets
	 * Returns a list of snippets in your workspace. Snippets are pieces of reusable content, like a common footer for your emails.
	 */

	public function listSnippets()
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'snippets';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Update snippets
	 * Update the name or value of a snippet.
	 */

	public function updateSnippets($data)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'snippets';

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY'],
			'content-type: application/json'

		);

		$request = json_decode($this->cURLPut($url, $header, $data));
		return $request;

	}

	/*
	 * Delete a snippet
	 * Remove a snippet.
	 */

	public function deleteSnippet($snippet_name)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'snippets/' . $snippet_name;

		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);

		$request = json_decode($this->cURLDelete($url, $header));
		return $request;
	}

	public function cURLGet($URL, $header)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

		if (!empty($header))
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		if (curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);
		return $response;
	}

	public function cURLPost($URL, $header = null, $data = null)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_POST, 1);

		if (!empty($data))
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		if (!empty($header))
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}

	public function cURLPut($URL, $header = null, $data)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		if (!empty($header))
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}

	public function cURLDelete($URL, $header = null)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

		if (!empty($header))
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}


}
