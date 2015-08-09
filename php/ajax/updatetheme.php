<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>
<?php
    $output;
    if(isset($_SESSION['userid']) && isset($_REQUEST['theme']) ){
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");
        if(mysql_query("update user_info set style='".$_REQUEST['theme']."' where userid='".$_SESSION['userid']."'")){
            mysql_query("delete from activity where userid='".$_SESSION['userid']."' and ruserid='".$_SESSION['userid']."' and contenttype='theme'");
            mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values ('".$_SESSION['userid']."','".$_SESSION['userid']."','".$_SESSION['userid']."','update theme','theme','theme.php',now())");
            $output=json_encode(array("status"=> "your theme has been updated"));
        }
        else
            $output=json_encode(array("status"=> "error occured please try again"));
    }
    else
        $output=json_encode(array("status"=> "please give valid information"));
    echo $output;

?>