<?php

/**
 * Live credentials
 */
$config = array(
    'CustomerIO.Config' => array(
        'Config' => array(
            'US' => array(
                'TRACK_API_URL' => 'https://track.customer.io/api/v1/',
                'APP_API_URL' => 'https://api.customer.io/v1/',
                'BETA_API_URL' => 'https://beta-api.customer.io/v1/api/',
				'UNSUBSCRIBE_API_URL' => 'https://track.customer.io/unsubscribe/',
            ),
            'EU' => array(
                'TRACK_API_URL' => 'https://track-eu.customer.io/api/v1/',
                'APP_API_URL' => 'https://api-eu.customer.io/v1/',
                'BETA_API_URL' => 'https://beta-api-eu.customer.io/v1/api/',
            ),
            'API_KEY' => 'ea609ce44ad3bf6bee36',
            'SITE_ID' => 'b14225e2364bd5601593',
        )
    )
);

/*
 * Stage credentials
 */
//$config = array(
//    'CustomerIO.Config' => array(
//        'Config' => array(
//            ['US'] => array(
//                'TRACK_API_URL' => 'https://track.customer.io/api/v1/',
//                'APP_API_URL' => 'https://api.customer.io/v1/',
//                'BETA_API_URL' => 'https://beta-api.customer.io/v1/api',
//            ),
//            ['EU'] => array(
//                'TRACK_API_URL' => 'https://track-eu.customer.io/api/v1/',
//                'APP_API_URL' => 'https://api-eu.customer.io/v1/',
//                'BETA_API_URL' => 'https://beta-api-eu.customer.io/v1/api/',
//            ),
//            'API_KEY' => '',
//            'SITE_ID' => '',
//        )
//    )
//);
