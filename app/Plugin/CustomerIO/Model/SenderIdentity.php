<?php

App::uses('AppModel', 'Model');
App::uses('HttpSocket', 'Network/Http');

class SenderIdentity extends CustomerIOAppModel {

    /**
     * Model name
     * @var string
     */
    public $name = 'SenderIdentity';
    public $useTable = false;

    //BETA API START

    /*
     * List sender identities
     * Returns a list of senders in your workspace. Senders are who your messages are "from".
     */

    public function listSenderIdentities() {
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

    public function getSender($sender_id) {
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

    public function getSenderUsageData($sender_id) {
        $url = $this->config['Config']['US']['BETA_API_URL'] . 'sender_identities/' . $sender_id . '/used_by';

        $header = array(
            'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
        );

        $request = json_decode($this->cURLGet($url, $header));
        return $request;
    }

    //BETA API END
}
