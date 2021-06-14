<?php

App::uses('AppModel', 'Model');
App::uses('HttpSocket', 'Network/Http');

class Segment extends CustomerIOAppModel {

    /**
     * Model name
     * @var string
     */
    public $name = 'Segment';
    public $useTable = false;

    //TRACK API START
    /*
     * Add people to a manual segment
     * Add people to a manual segment by ID. If you send customer IDs that don’t exist yet,
     * we automatically create customer profiles for the new customer IDs. You are limited to
     * 1000 customer IDs per request.
     */

    public function addSegment($segment_id, $data) {
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

    public function removeSegment($segment_id, $data) {
        $url = $this->config['Config']['US']['TRACK_API_URL'] . 'segments/' . $segment_id . '/remove_customers';

        $header = array(
            'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY']),
            'content-type: application/json'
        );

        $request = json_decode($this->cURLPost($url, $header, $data));
        return $request;
    }

    //TRACK API END
    //BETA API START
    /*
     * Create a manual segment
     * Create a manual segment with a name and a description. This request creates an empty segment.
     */

    public function createManualSegment($data) {
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

    public function listSegments() {
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

    public function getSegment($segment_id) {
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

    public function deleteSegment($segment_id) {
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

    public function getSegmentDependencies($segment_id) {
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

    public function getSegmentCustomerCount($segment_id) {
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

    public function listCustomersInSegment($segment_id) {
        $url = $this->config['Config']['US']['BETA_API_URL'] . 'segments/' . $segment_id . '/membership';

        $header = array(
            'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
        );

        $request = json_decode($this->cURLGet($url, $header));
        return $request;
    }

    //BETA API END
}
