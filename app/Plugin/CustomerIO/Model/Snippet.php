<?php

App::uses('AppModel', 'Model');
App::uses('HttpSocket', 'Network/Http');

class Snippet extends CustomerIOAppModel {

    /**
     * Model name
     * @var string
     */
    public $name = 'Snippet';
    public $useTable = false;

    //BETA API START
    /*
     * List snippets
     * Returns a list of snippets in your workspace. Snippets are pieces of reusable content, like a common footer for your emails.
     */

    public function listSnippets() {
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

    public function updateSnippets($data) {
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

    public function deleteSnippet($snippet_name) {
        $url = $this->config['Config']['US']['BETA_API_URL'] . 'snippets/' . $snippet_name;

        $header = array(
            'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
        );

        $request = json_decode($this->cURLDelete($url, $header));
        return $request;
    }

    //BETA API END
}
