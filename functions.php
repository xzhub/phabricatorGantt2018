<?php
/*
//for debug
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/

require_once './libphutil/src/__phutil_library_init__.php';
$api_token = ""; // insert the bot user apitoken here
$server_url = ""; //insert the server root url, for exampel https://phabricator.webfuns.net

function getTasks() {
    global $api_token, $server_url;
    $api_parameters = array(); //array("limit"=> 10,); //for debug, set a limit here

    // init the phabricator connection
    // for help, go to https://<phabricator_server>/conduit/, for example: https://phabricator.webfuns.net/conduit/
    $client = new ConduitClient($server_url);
    $client->setConduitToken($api_token);

    // call api to get all tasks
    $response = $client->callMethodSynchronous('maniphest.query',$api_parameters);

    // for those tasks that have no start-day and estimated-days, give them a default value
    foreach ($response as $key => &$value) {
        if ($value['auxiliary']['std:maniphest:start-day'] < $value['dateCreated']) {
            $value['auxiliary']['std:maniphest:start-day'] = $value['dateCreated']; //here I use dateCreated as task start date
            $value['auxiliary']['std:maniphest:estimated-days'] = 2; //set the number you prefer
        }
    }

    return $response;
}


function getUsers() {
    global $api_token, $server_url;
    $api_parameters = array();

    $client = new ConduitClient($server_url);
    $client->setConduitToken($api_token);

    $response = $client->callMethodSynchronous('user.query',$api_parameters);
    return $response;
}
?>
