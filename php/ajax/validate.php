<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>

<?php
    require_once ('json/JSON.php');
    require_once ('dovalidation.php');
$json = new Services_JSON();
if(isset($_REQUEST['userid'])){
    $output;
    $password;
    if(isset($_REQUEST['password']) && !isset ($_SESSION['password']))
            $password=$_REQUEST['password'];
           else if(!isset($_REQUEST['password']) && isset ($_SESSION['password']))
               $password=$_SESSION['password'];
           else if(isset($_REQUEST['password']))
               $password=$_REQUEST['password'];
           $result=validate($_REQUEST['userid'], $password);
           $output=$json->encode(array("userid"=>$_REQUEST['userid'],"status"=> $result  ));
           echo $output;
    
}
else
{
    $output=$json->encode(array("userid"=>$_REQUEST['userid'],"status"=>"false"));
     echo $output;
}
?>