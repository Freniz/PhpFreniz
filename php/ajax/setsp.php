<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$output;
if(isset($_SESSION['userid']) && isset($_REQUEST['imageid']) && isset($_REQUEST['sp']))
{
    mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
    mysql_select_db("fztest1") or die ("coudnt find database");
    if(mysql_query("update user_info set ".$_REQUEST['sp']."='".$_REQUEST['imageid']."' where userid='".$_SESSION['userid']."'"))
        echo json_encode(array("status"=>"Secondary Profile pic updated successfully"));
    else
        echo json_encode(array("status"=>"Error occured while updating Secondary Profile pic"));
}
else
    echo json_encode(array("status"=>"Please provide valid informations"));

?>