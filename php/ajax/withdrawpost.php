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
    if(isset($_SESSION['userid'])&& isset($_REQUEST['postid']))
    {
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select vote from status where statusid='".$_REQUEST['postid']."'");
        while($row=  mysql_fetch_assoc($result))
        {
            $votes=unserialize($row['vote']);
            if(in_array($_SESSION['userid'], $votes))
            {
                $votes=array_diff($votes, array($_SESSION['userid']));
                mysql_query("update status set vote='".serialize($votes)."' where statusid='".$_REQUEST['postid']."'");
                mysql_query("delete from activity where userid='".$_SESSION['userid']."' and contentid='".$_REQUEST['postid']."' and contenttype='post' and title='voted on'");
                $output=$json->encode(array("status"=>"you have withdrawn vote from this post"));
            }
            
        else
            $output=$json->encode(array("status"=> "you havent voted to this post"));
        }
        mysql_close();
    }
    else
        $output=$json->encode(array("status"=> "you don't have permission to this operation"));
   echo $output;
   
?>
