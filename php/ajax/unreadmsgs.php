<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>

<?php
    $output;
    if(isset($_SESSION['userid']))
        {
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
           mysql_select_db("fztest1") or die ("coudnt find database");
           $result=mysql_query("select count(messageid) as count from message where read1='0' and ruserid='".$_SESSION['userid']."'");
           if($row=  mysql_fetch_assoc($result))
               $output=json_encode(array("count"=>$row['count'],"session"=>"true"));
           else
               $output=json_encode(array("count"=>0,"session"=>"true"));
       }
       else
           $output=json_encode(array("count"=>0,"session"=>"false"));
       echo $output;
?>