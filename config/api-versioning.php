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
     * You can set the folder name where the versioned controllers are located
     *
     * Keep it empty if you want to put the versioned controllers in the same folder as the original controllers
     */
    'folder' => '',

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

];
