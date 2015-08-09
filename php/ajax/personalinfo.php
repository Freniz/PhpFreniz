<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once ('dovalidation.php');
?>
<?php
    $ouput;
    if(isset($_SESSION['userid'])){
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select personalinfo from user_info where userid='".$_SESSION['userid']."'");
        $personalinfo=array();
        while($row=mysql_fetch_assoc($result)){
            $personalinfo=unserialize($row['personalinfo']);
        }
        if(isset($_REQUEST['body'])){
            $personalinfo['body']=$_REQUEST['body'];
        }
        if(isset($_REQUEST['look'])){
            $personalinfo['look']=$_REQUEST['look'];
        }
        if(isset($_REQUEST['smoke'])){
            $personalinfo['smoke']=$_REQUEST['smoke'];
        }
        if(isset($_REQUEST['drink'])){
            $personalinfo['drink']=$_REQUEST['drink'];
        }
        if(isset($_REQUEST['pets'])){
            $personalinfo['pets']=$_REQUEST['pets'];
        }
        if(isset($_REQUEST['passion'])){
            $personalinfo['passion']=$_REQUEST['passion'];
        }
        if(isset($_REQUEST['ethnicity'])){
            $personalinfo['ethnicity']=$_REQUEST['ethnicity'];
        }
        if(isset($_REQUEST['humor'])){
            $personalinfo['humor']=$_REQUEST['humor'];
        }
        if(isset($_REQUEST['sexual'])){
            $personalinfo['sexual']=$_REQUEST['sexual'];
        }
        if(mysql_query("update user_info set personalinfo='".serialize($personalinfo)."' where userid='".$_SESSION['userid']."'"))
        {
            mysql_query("delete from activity where userid='".$_SESSION['userid']."' and ruserid='".$_SESSION['userid']."' and contenttype='personal info' and contenturl='personalnfo.php'");
            mysql_query("insert into activity (userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$_SESSION['userid']."','".$_SESSION['userid']."','update personal info','personal info','personalinfo.php',now())");
            if(validate($_SESSION['userid'], $_SESSION['password'])!="false")
                $output=json_encode(array("status"=> "your personal info has been updated successfully"));
            else
                $output=json_encode(array("status"=> "error occured please try again")); 
        }
        else
            $output=json_encode(array("status"=> "error occured please try again")); 
        
    }
    else
        $output=json_encode(array("status"=>"plese give the valid information"));
    echo $output;
?>