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
    if(isset($_SESSION['userid'])&& $_SESSION['type']=='user' && isset($_REQUEST['leafid']))
    {
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select vote from pages where pageid='".$_REQUEST['leafid']."'");
        while($row=  mysql_fetch_assoc($result))
        {
            $votes=unserialize($row['vote']);
            if(!in_array($_SESSION['userid'], $votes))
            {
                array_push($votes, $_SESSION['userid']);
                array_push($_SESSION['voted'], $_REQUEST['userid']);
                mysql_query("update pages set vote='".serialize($votes)."' where pageid='".$_REQUEST['leafid']."'");
                mysql_query("update friends_vote set voted='".serialize($_SESSION['voted'])."' where userid='".$_SESSION['userid']."'");
                mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$_REQUEST['leafid']."','".$_REQUEST['leafid']."','voted on','leaf','leaf.php?leafid=".$_REQUEST['leafid']."',now())");
                $output=$json->encode(array("status"=>"you have voted to this user"));
            }
            
        else
            $output=$json->encode(array("status"=> "you are already voted to this leaf"));
        }
        mysql_close();
    }
    else
        $output=$json->encode(array("status"=> "you don't have permission to vote this leaf"));
   echo $output;
?>