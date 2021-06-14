<?php

App::uses('AppModel', 'Model');
App::uses('HttpSocket', 'Network/Http');

class Collection extends CustomerIOAppModel {

    /**
     * Model name
     * @var string
     */
    public $name = 'Collection';
    public $useTable = false;

    //BETA API START

    /*
     * Create a collection
     * Create a new collection and provide the data that you'll access from the collection or the url that you'll download the data from.
     */

    public function createCollection($data) {
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

    public function listCollections() {
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

    public function lookupCollection($collection_id) {
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

    public function deleteCollection($collection_id) {
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

    public function updateCollection($collection_id, $data) {
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

    public function lookupCollectionContents($collection_id) {
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

    public function updateContentsOfCollection($collection_id, $data) {
        $url = $this->config['Config']['US']['BETA_API_URL'] . 'collections/' . $collection_id . '/content';

        $header = array(
            'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
        );

        $request = json_decode($this->cURLPut($url, $header, $data));
        return $request;
    }

    //BETA API END
}
