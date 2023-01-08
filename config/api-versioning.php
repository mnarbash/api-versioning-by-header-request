<?php

return [
    /*
     * tell the package to check the api version
     */
    'check_app_version_support' => true,

    /*
     * tell the package to check the app version support
     */
    'api_versioning_enabled' => true,

    /*
     * You can set the default version here to be used when the client does not send the API-VERSION header
     *
     * Set the default api version
     */
    'default_api_version' => 'v1',


    /*
     * You can disable change controller name when version is set
     *
     * Set the default app version
     */
    'not_do_anything_when_version_is_not_set' => true,


    /*
     * You can set the default version here to be used when the client does not send the APP-VERSION header
     * Set the default app version
     */
    'default_app_version' => '0',

    /*
     * Set the minimum supported app version
     */
    'min_supported_app_version' => '0',

    /*
     * Set the minimum supported app version
     */
    'min_supported_api_version' => 'v0',

    /*
     * Set Return Update Url Data For Update App
     * You can customize the response to be returned when the client app version is not supported to add update buttons
     */
    'update_urls' => [
        // Add Anything you want to return
//        'android' => [
//            'url' => 'https://play.google.com/store/apps/details?id=com.example.app',
//            'version' => '1.0.0',
//        ],
//        'ios' => [
//            'url' => 'https://itunes.apple.com/us/app/apple-store/id123456789',
//            'version' => '1.0.0',
//        ],
    ],

    /*
     * Set Not Support Response Status Code When App Version Not Supported
     */
    'not_support_response_status_code' => 422,

];
