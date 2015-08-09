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
    if(isset($_SESSION['userid'])&& $_SESSION['type']=='user' && isset($_REQUEST['userid']))
    {
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select vote from friends_vote where userid='".$_REQUEST['userid']."'");
        while($row=  mysql_fetch_assoc($result))
        {
            $votes=unserialize($row['vote']);
            if(!in_array($_SESSION['userid'], $votes))
            {
                array_push($votes, $_SESSION['userid']);
                array_push($_SESSION['voted'], $_REQUEST['userid']);
                mysql_query("update friends_vote set vote='".serialize($votes)."' where userid='".$_REQUEST['userid']."'");
                mysql_query("update friends_vote set voted='".serialize($_SESSION['voted'])."' where userid='".$_SESSION['userid']."'");
                mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".$_REQUEST['userid']."','voted on','user','profile.php?userid=".$_REQUEST['userid']."',now())");
                $output=$json->encode(array("status"=>"you have voted to this user"));
            }
            
        else
            $output=$json->encode(array("status"=> "you are already voted to this user"));
        }
        mysql_close();
    }
    else
        $output=$json->encode(array("status"=> "you don't have permission to vote this user"));
   echo $output;
?>