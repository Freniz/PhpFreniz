<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>
<?php
    $output;
    if(isset($_SESSION['userid']) && isset($_REQUEST['mood']) ){
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");
        if(mysql_query("update user_info set mood='".$_REQUEST['mood']."' where userid='".$_SESSION['userid']."'")){
            mysql_query("delete from activity where userid='".$_SESSION['userid']."' and ruserid='".$_SESSION['userid']."' and contenttype='mood'");
            mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values ('".$_SESSION['userid']."','".$_SESSION['userid']."','".$_SESSION['userid']."','update mood','mood','mood.php',now())");
            $output=json_encode(array("status"=> "your mood has been updated"));
        }
        else
            $output=json_encode(array("status"=> "error occured please try again"));
    }
    else
        $output=json_encode(array("status"=> "please give valid information"));
    echo $output;

?>