<?php

App::uses('AppModel', 'Model');
App::uses('HttpSocket', 'Network/Http');

class Event extends CustomerIOAppModel {

    /**
     * Model name
     * @var string
     */
    public $name = 'Event';
    public $useTable = false;

    //TRACK API START
    /*
     * Track a customer event
     * Send an event associated with a person, referenced by the identifier in the path.
     * Use this endpoint to track events outside of a browser or directly from your server-side code.
     */

    public function trackCustomerEvent($identifier, $data) {
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

    public function trackAnonymousEvent($data) {
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

    public function reportPushEvent($data) {
        $url = $this->config['Config']['US']['GENERAL_API_URL'] . 'push/events';

        $header = array(
            'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY']),
            'content-type: application/json'
        );

        $request = json_decode($this->cURLPost($url, $header, $data));
        return $request;
    }
    
      //TRACK API END

}
