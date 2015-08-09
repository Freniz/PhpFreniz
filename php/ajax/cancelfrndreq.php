<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>
<?php
    require_once ('json/JSON.php');
    $json = new Services_JSON();
    $output;
    if(isset($_REQUEST['userid']) && isset($_SESSION['userid'])){
    $sentrequest=$_SESSION["sentrequest"];
    if(in_array($_REQUEST['userid'], $sentrequest)){
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        mysql_query("delete from invites where suserid='".$_SESSION['userid']."' and ruserid='".$_REQUEST['userid']."'");
        $result=mysql_query("select incomingrequest from friends_vote where userid='".$_REQUEST['userid']."'");
        $bendingrequest;
        while($row=  mysql_fetch_assoc($result))
        {
            $bendingrequest=unserialize($row['incomingrequest']);
        }
        
        $sentrequest=array_diff($sentrequest,array($_REQUEST['userid']));
        $bendingrequest=array_diff($bendingrequest,array($_SESSION['userid']));
        $_SESSION['sentrequest']=$sentrequest;
        mysql_query("update friends_vote set sentrequest='".serialize($sentrequest)."' where userid='".$_SESSION['userid']."'");
        mysql_query("update friends_vote set incomingrequest='".serialize($bendingrequest)."' where userid='".$_REQUEST['userid']."'");
        $output=$json->encode(array("status"=>"friend request cancelled"));
         mysql_close();
    }
       else
           $output=$json->encode (array("status"=>"error occured"));
   
    }
    echo $output;
    ?>