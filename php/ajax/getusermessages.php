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
   <messages>
       <?php
mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
mysql_select_db("fztest1") or die ("coudnt find database");
$result=mysql_query("select messageid,suserid,ruserid,message,date,read1,suservisi,ruservisi  from message where (suserid='".$_REQUEST['userid']."' and ruserid='".$_SESSION['userid']."') or (ruserid='".$_REQUEST['userid']."' and suserid='".$_SESSION['userid']."') order by date asc"); 
while ($row = mysql_fetch_assoc($result)) {
    if(($row['suserid']==$_SESSION['userid'] && $row['suservisi']=='visible') || ($row['ruserid']==$_SESSION['userid'] && $row['ruservisi']=='visible')){
?>
       <message>
           <id><?php echo $row['messageid']; ?></id>
           <suserid><?php echo $row['suserid']; ?></suserid>
           <?php $mp=getminipro($row['suserid']);
           ?>
           <from><?php echo $mp['username']; ?></from>
           <propic><?php echo $mp['propic']; ?></propic>
           <msg><?php echo $row['message']; ?></msg>
           <date><?php echo $row['date']; ?></date>
           <read><?php echo $row['read1'];?></read>
       </message>
       <?php  } }
 mysql_query("update message set read1='1' where ruserid='".$_SESSION['userid']."' and suserid='".$_REQUEST['userid']."'");
       mysql_close();?>
   </messages>