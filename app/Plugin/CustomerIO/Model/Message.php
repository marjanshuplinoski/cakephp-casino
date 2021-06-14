<?php

App::uses('AppModel', 'Model');
App::uses('HttpSocket', 'Network/Http');

class Message extends CustomerIOAppModel {

    /**
     * Model name
     * @var string
     */
    public $name = 'Message';
    public $useTable = false;

    //APP API START

    /*
     * Send a transactional email
     * Send a transactional email. You can send a with a template using a transactional_message_id or send your own body, subject, and from values at send time.
     */

    public function sendTransactionalEmail($data) {
        $url = $this->config['Config']['US']['APP_API_URL'] . 'send/email';

        $header = array(
            'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY'],
            'content-type: application/json'
        );

        $request = json_decode($this->cURLPost($url, $header, $data));
        return $request;
    }

    //APP API END
    //BETA API START
    /*
     * List messages
     * Return a list of deliveries, including metrics for each delivery, for messages in your workspace.
     * The request body contains filters determining the deliveries you want to return information about.
     */

    public function listMessages() {
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

    public function getMessage($message_id) {
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

    public function getArchivedMessage($message_id) {
        $url = $this->config['Config']['US']['BETA_API_URL'] . 'messages/' . $message_id . '/archived_message';

        $header = array(
            'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
        );

        $request = json_decode($this->cURLGet($url, $header));
        return $request;
    }

//BETA API END
}
