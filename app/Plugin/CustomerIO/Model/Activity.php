<?php

App::uses('AppModel', 'Model');
App::uses('HttpSocket', 'Network/Http');

class Activity extends CustomerIOAppModel {

    /**
     * Model name
     * @var string
     */
    public $name = 'Activity';
    public $useTable = false;

    //BETA API START

    /* List activities
     * This endpoint returns a list of activities in your workspace.
     */

    public function listActivities($start_string, $deleted, $customer_id, $limit) {
        $url = $this->config['Config']['US']['BETA_API_URL'] . 'activities?start=' . $start_string . '&type=sent_email&name=something_happened&deleted=' . $deleted . '&customer_id=' . $customer_id . '&limit=' . $limit;

        $header = array(
            'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
        );

        $request = json_decode($this->cURLGet($url, $header));
        return $request;
    }

    //BETA API END
}
