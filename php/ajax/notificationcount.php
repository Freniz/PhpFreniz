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
           $result=mysql_query("select count(contenturl) as count from notification where read1='1' and userid='".$_SESSION['userid']."'");
           if($row=  mysql_fetch_assoc($result))
               $output=json_encode(array("count"=>$row['count']));
           else
               $output=json_encode(array("count"=>0));
       }
       else
           $output=json_encode(array("count"=>0));
       echo $output;
?>