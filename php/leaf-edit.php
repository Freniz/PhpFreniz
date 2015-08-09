<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once "org_netbeans_saas_facebook/FacebookSocialNetworkingService.php";
try {
    $format = "text";
    $flid = '100003299236100';

    $result = FacebookSocialNetworkingService::friendsGet($format, $flid);
    echo $result->getResponseBody();
} catch (Exception $e) {
    echo "Exception occured: " . $e;
}


?>
