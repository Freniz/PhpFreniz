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
    if( isset($_REQUEST['fname']) && isset($_REQUEST['lname']) && isset($_REQUEST['bdm']) && isset($_REQUEST['bdd']) && isset($_REQUEST['bdy']) && isset($_REQUEST['sex']) && isset($_REQUEST['religious']) && isset($_REQUEST['status']) && isset($_REQUEST['ccity']) && isset($_REQUEST['htown']) && isset($_SESSION['userid'])){
        $dob=$_REQUEST['bdy']."-".$_REQUEST['bdm']."-".$_REQUEST['bdd'];
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");
        if(mysql_query("update user_info set hometown='".$_REQUEST['htown']."',currentcity='".$_REQUEST['ccity']."', fname='".$_REQUEST['fname']."',lname='".$_REQUEST['lname']."',sex='".$_REQUEST['sex']."',rstatus='".$_REQUEST['status']."',religion='".$_REQUEST['religious']."',dob='".$dob."' where userid='".$_SESSION['userid']."'"))
        {
            mysql_query("delete from activity where userid='".$_SESSION['userid']."' and ruserid='".$_SESSION['userid']."' and contenttype='basic info' and contenturl='basicinfo.php'");
            mysql_query("insert into activity (userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$_SESSION['userid']."','".$_SESSION['userid']."','update basic info','basic info','basicinfo.php',now())");
            if(validate($_SESSION['userid'], $_SESSION['password'])!="false")
                $output=json_encode(array("status"=> "your basic info updated successfully"));
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