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
   <albums>
       <?php
mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
mysql_select_db("fztest1") or die ("coudnt find database");
$albums=  mysql_query("select albumid,name,date,pt,specificlist,hiddenlist from album where userid='".$_REQUEST['userid']."'");
 
while ($row = mysql_fetch_assoc($albums)) {
    $rusrid=$_REQUEST['userid'];
 $privacy=$row['pt'];
        $specific=  unserialize($row['specificlist']);
        $hiddenlist=  unserialize($row['hiddenlist']);
        $minipro1=getminipro($rusrid);
        $rusrfrnds=$minipro1['friends'];
        if((($privacy=='public'||($privacy=='friends' && in_array($rusrid,$_SESSION['friends']))||($privacy=='fof' && count(array_intersect($rusrfrnds, $_SESSION['friends'])>=1) )||($privacy=='specific' && in_array($_SESSION['userid'], $specific)))&& !in_array($rusrid, $_SESSION['blocklist']) && !in_array($rusrid, $_SESSION['blockedby']) && !in_array($_SESSION['userid'], $hiddenlist))|| $_SESSION['userid']==$rusrid ){  
?>
       <album>
           <id><?php echo $row['albumid']; ?></id>
           <name><?php echo $row['name']; ?></name>
           <date><?php echo $row['date']; ?></date>
       </album>
       <?php }
       }mysql_close(); ?>
   </albums>