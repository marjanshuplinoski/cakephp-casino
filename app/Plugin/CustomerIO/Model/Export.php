<?php

App::uses('AppModel', 'Model');
App::uses('HttpSocket', 'Network/Http');

class Export extends CustomerIOAppModel {

    /**
     * Model name
     * @var string
     */
    public $name = 'Export';
    public $useTable = false;

//BETA API START

    /* List exports
     * Return a list of your exports. Exports are point-in-time people or campaign metrics.
     */

    public function listExports() {
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

    public function getExport($export_id) {
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

    public function downloadExport($export_id) {
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

    public function exportCustomerData($data) {
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

    public function exportInfoAboutDeliveries($data) {
        $url = $this->config['Config']['US']['BETA_API_URL'] . 'exports/deliveries';

        $header = array(
            'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY'],
            'content-type: application/json'
        );

        $request = json_decode($this->cURLPost($url, $header, $data));
        return $request;
    }

    //BETA API END
}
