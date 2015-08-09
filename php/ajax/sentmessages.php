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
$result=mysql_query("select t.ruserid,t.message,t.date,t.read1  from message t  join(select ruserid,message,max(date) date,read1 from message where suserid='".$_SESSION['userid']."' and suservisi='visible' group by ruserid) r on r.date=t.date and t.ruserid=r.ruserid where t.suserid='".$_SESSION['userid']."' and t.suservisi='visible' order by date desc"); 
while ($row = mysql_fetch_assoc($result)) {
   
?>
       <message>
           <ruserid><?php echo $row['ruserid']; ?></ruserid>
           <?php $mp=getminipro($row['ruserid']);
           ?>
           <to><?php echo $mp['username']; ?></to>
           <propic><?php echo $mp['propic']; ?></propic>
           <msg><?php echo $row['message']; ?></msg>
           <date><?php echo $row['date']; ?></date>
           <read><?php echo $row['read1'];?></read>
       </message>
       <?php  } ?>
   </messages>