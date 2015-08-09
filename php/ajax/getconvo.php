<?php
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'getminiprofile.php';
?>
<?xml version="1.0" encoding="UTF-8"?>
   <convos>
       <?php
       if(isset($_REQUEST['userid'])){
mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
mysql_select_db("fztest1") or die ("coudnt find database");
mysql_query("update message set read='1' where suserid='".$_REQUEST['userid']."' and ruserid='".$_SESSION['userid']."'");
$result=mysql_query("select suserid,messageid,message,date from message where suserid='".$_REQUEST['userid']."' and ruserid='".$_SESSION['userid']."' or ruserid='".$_REQUEST['userid']."' and suserid='".$_SESSION['userid']."' order by date desc"); 
while ($row = mysql_fetch_assoc($result)) {
   
?>
       <convo>
           <convoid><?php echo $row['messageid']; ?></convoid>
           <suserid><?php echo $row['suserid']; ?></suserid>
           <?php $mp=getminipro($row['suserid']);
           ?>
           <from><?php echo $mp['username']; ?></from>
           <propic><?php echo $mp['propic']; ?></propic>
           <msg><?php echo $row['message']; ?></msg>
           <date><?php echo $row['date']; ?></date>
       </convo>
       <?php  }  }?>
   </convos>