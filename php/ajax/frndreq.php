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
    if(isset($_SESSION['userid']) && isset($_REQUEST['userid']) && isset($_REQUEST['songurl']) && isset($_REQUEST['text']) && isset($_REQUEST['imageurl'])){
    if(in_array($_REQUEST['userid'], $_SESSION['friends']))
        {
            $output=$json->encode(array("status"=> "already friend"));
        }
    else if(in_array($_REQUEST['userid'], $_SESSION['sentrequest']))
        {
        $output=$json->encode(array("status"=>"requsted already"));
        }
    else if(in_array($_REQUEST['userid'], $_SESSION['bendingrequest']))
        {
        $output=$json->encode(array("status"=>"request got already"));
        }
    else
        {
            array_push($_SESSION['sentrequest'], $_REQUEST['userid']);
            mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
            mysql_select_db("fztest1") or die ("coudnt find database");
            mysql_query("update friends_vote set sentrequest='".serialize($_SESSION['sentrequest'])."' where userid='".$_SESSION['userid']."'");
            $result=mysql_query("select incomingrequest from friends_vote where userid='".$_REQUEST['userid']."'");
            while($row=  mysql_fetch_assoc($result))
            {
                $bu=unserialize($row['incomingrequest']);
                array_push($bu, $_SESSION['userid']);
                mysql_query("update friends_vote set incomingrequest='".serialize($bu)."' where userid='".$_REQUEST['userid']."'");
            }
            mysql_query("insert into invites (suserid,ruserid,text,songurl,imageurl) values ('".$_SESSION['userid']."','".$_REQUEST['userid']."','".htmlspecialchars($_REQUEST['text'])."','".$_REQUEST['songurl']."','".$_REQUEST['imageurl']."')");
            $output=$json->encode(array("status"=>"success"));
            mysql_close();
        }
    }
        echo $output;
?>