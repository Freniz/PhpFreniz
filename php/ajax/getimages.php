<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

session_start();
require_once 'getminiprofile.php';
?>
<?xml version="1.0" encoding="UTF-8"?>
<images>
<?php 
    $result;
    mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
    mysql_select_db("fztest1") or die ("coudnt find database");
    $result1=mysql_query("select userid from album where albumid='".$_REQUEST['albumid']."'");
    $rusrid;
    while($row2=  mysql_fetch_assoc($result1))
    {
        $rusrid=$row2['userid'];
    }
    $result=mysql_query("select imageid,title,description,url,userid,pinnedpeople,vote,date,pt,specificlist,hiddenlist from image where albumid='".$_REQUEST['albumid']."' order by imageid desc");
    if(mysql_num_rows($result)){
        while($row=  mysql_fetch_assoc($result)){
        $privacy=$row['pt'];
        $specific=  unserialize($row['specificlist']);
        $hiddenlist=  unserialize($row['hiddenlist']);
        $minipro1=getminipro($rusrid);
        $rusrfrnds=$minipro1['friends'];
        if((($privacy=='public'||($privacy=='friends' && in_array($rusrid,$_SESSION['friends']))||($privacy=='fof' && count(array_intersect($rusrfrnds, $_SESSION['friends'])>=1) )||($privacy=='specific' && in_array($_SESSION['userid'], $specific)))&& !in_array($rusrid, $_SESSION['blocklist']) && !in_array($rusrid, $_SESSION['blockedby']) && !in_array($_SESSION['userid'], $hiddenlist))|| $_SESSION['userid']==$rusrid || $_SESSION['userid']==$row['userid']){
    ?>
   <image>
       <id><?php echo $row['imageid']; ?></id>
       <url><?php echo $row['url']; ?></url>
       <albumid><?php echo $_REQUEST['albumid']; ?></albumid>
       <albumname><?php $result1=  mysql_query("select name from album where albumid='".$_REQUEST['albumid']."'");  while($row1=  mysql_fetch_assoc($result1)){echo $row1['name']; }  ?></albumname>
       <userid><?php echo $row['userid']; ?></userid>
       <pinnedpeople><?php echo $row['pinnedpeople']; ?></pinnedpeople>
       <pinnedpeople_count><?php echo sizeof(unserialize($row['pinnedpeople'])); ?></pinnedpeople_count>
       <vote_count><?php echo sizeof(unserialize($row['vote'])); ?></vote_count>
       <vote><?php echo $row['vote']; ?></vote>
       <date><?php echo $row['date']; ?></date>
   </image>
    <?php } }
    } else { ?>
   <image>
            <id></id>
            <url></url>
            <userid></userid>
            <albumid><?php echo $_REQUEST['albumid']; ?></albumid>
            <albumname><?php $result1=  mysql_query("select name from album where albumid='".$_REQUEST['albumid']."'"); while($row1=  mysql_fetch_assoc($result1)){echo $row1['name']; }  ?></albumname>
            <pinnedpeople></pinnedpeople>
            <pinnedpeople_count></pinnedpeople_count>
            <vote_count></vote_count>
            <vote></vote>
            <date></date>
    </image>
        <?php }?>
</images>