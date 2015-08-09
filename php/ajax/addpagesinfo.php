<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'getminiprofile.php';
$output=json_encode(array("status"=>"please provide valide informations"));
if(isset($_REQUEST['pageid']) && isset($_SESSION['userid']) && isset($_REQUEST['category']) && isset($_REQUEST['subcategory']))
    {
 mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
 mysql_select_db("fztest1") or die ("coudnt find database");
 $info=array();
 foreach($_REQUEST as $key=>$value)
 {
     if($key!='category' && $key!='subcategory' && $key!='pageid' && strlen(trim($value))>0){
         $info[$key]=$value;
     }
 }
 print_r($info);
 $page=getminipro($_REQUEST['pageid']);

 if(in_array($_SESSION['userid'], $page['admins']) || $_SESSION['userid']==$page['creator'] || $_SESSION['userid']==$page['userid']){
     mysql_query("update pages set category='".$_REQUEST['category']."',subcategory='".$_REQUEST['subcategory']."' where pageid='".$_REQUEST['pageid']."'");
     mysql_query("update pages_info set info='".serialize($info)."' where pageid='".$page['userid']."'");     
     $output=json_encode(array("status"=>"pages info updated successfully"));
 }
 else
     $output=json_encode(array("status"=>"you dont have permissions to do this operation"));
 mysql_close();
}
echo $output;
?>
