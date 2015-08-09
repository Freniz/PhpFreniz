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
    if(isset($_SESSION['userid'])&& isset($_REQUEST['blogid']))
    {
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select vote from blog where blogid='".$_REQUEST['blogid']."'");
        while($row=  mysql_fetch_assoc($result))
        {
            $votes=unserialize($row['vote']);
            if(in_array($_SESSION['userid'], $votes))
            {
                $votes=array_diff($votes, array($_SESSION['userid']));
                mysql_query("update blog set vote='".serialize($votes)."' where blogid='".$_REQUEST['blogid']."'");
                mysql_query("delete from activity where userid='".$_SESSION['userid']."' and contentid='".$_REQUEST['blogid']."' and contenttype='blog' and title='voted on'");
                $output=$json->encode(array("status"=>"you have withdrawn vote from this blog"));
            }
            
        else
            $output=$json->encode(array("status"=> "you havent voted to this blog"));
        }
        mysql_close();
    }
    else
        $output=$json->encode(array("status"=> "you don't have permission to this operation"));
   echo $output;
   
?>
