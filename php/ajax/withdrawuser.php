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
            if(in_array($_SESSION['userid'], $votes))
            {
                $votes=array_diff($votes, array($_SESSION['userid']));
                mysql_query("update friends_vote set vote='".serialize($votes)."' where userid='".$_REQUEST['userid']."'");
                mysql_query("delete from activity where userid='".$_SESSION['userid']."' and contentid='".$_REQUEST['userid']."' and contenttype='user' and title='voted on'");
                $output=$json->encode(array("status"=>"you have withdrawn vote from this user"));
            }
            
        else
            $output=$json->encode(array("status"=> "you havent voted to this user"));
        }
       mysql_close(); 
    }
    else
        $output=$json->encode(array("status"=> "you don't have permission to this operation"));
   echo $output;
   
?>
