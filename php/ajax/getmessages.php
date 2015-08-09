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
$result=mysql_query("select t.suserid,t.message,t.date,t.read1  from message t  join(select suserid,message,max(date) date,read1 from message where ruserid='".$_SESSION['userid']."' and ruservisi='visible' group by suserid) r on r.date=t.date and t.suserid=r.suserid where t.ruserid='".$_SESSION['userid']."' and t.ruservisi='visible' order by date desc"); 
while ($row = mysql_fetch_assoc($result)) {
   
?>
       <message>
           <suserid><?php echo $row['suserid']; ?></suserid>
           <?php $mp=getminipro($row['suserid']);
           ?>
           <from><?php echo $mp['username']; ?></from>
           <propic><?php echo $mp['propic']; ?></propic>
           <msg><?php echo $row['message']; ?></msg>
           <date><?php echo $row['date']; ?></date>
           <read><?php echo $row['read1'];?></read>
       </message>
       <?php  } ?>
   </messages>