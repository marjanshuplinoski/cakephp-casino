<?php

App::uses('AppModel', 'Model');
App::uses('HttpSocket', 'Network/Http');

class Webhook extends CustomerIOAppModel {

    /**
     * Model name
     * @var string
     */
    public $name = 'Webhook';
    public $useTable = false;

    //BETA API START

    /*
     * Create a reporting webhook
     * Create a new webhook configuration.
     */

    public function reportingWebhook($data) {
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

    public function listReportingWebhooks() {
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

    public function getReportingWebhook($webhook_id) {
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

    public function updateWebhookConfig($webhook_id, $data) {
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

    public function deleteReportingWebhook($webhook_id) {
        $url = $this->config['Config']['US']['BETA_API_URL'] . 'reporting_webhooks/' . $webhook_id;

        $header = array(
            'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
        );

        $request = json_decode($this->cURLDelete($url, $header));
        return $request;
    }

    //BETA API END
}
