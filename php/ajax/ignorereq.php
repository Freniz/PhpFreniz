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
    $bendingrequest=$_SESSION['bendingrequest'];
    mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
    mysql_select_db("fztest1") or die ("coudnt find database");
    mysql_query("delete from invites where ruserid='".$_SESSION['userid']."' and suserid='".$_REQUEST['userid']."'");
    $result=mysql_query("select sentrequest from friends_vote where userid='".$_REQUEST['userid']."'");
    $sentrequest;
    while($row=  mysql_fetch_assoc($result))
    {
        $sentrequest=unserialize($row['sentrequest']);
    }
    $bendingrequest=array_diff($bendingrequest, array($_REQUEST['userid']));
    $_SESSION['bendingrequest']=$bendingrequest;
    $sentrequest=array_diff($sentrequest, array($_SESSION['userid']));
    mysql_query("update friends_vote set incomingrequest='".serialize($bendingrequest)."' where userid='".$_SESSION['userid']."'");
    mysql_query("update friends_vote set sentrequest='".serialize($sentrequest)."' where userid='".$_REQUEST['userid']."'");
    $output=$json->encode(array("status"=> "success"));
    mysql_close();
    }
    echo $output;
    
?>