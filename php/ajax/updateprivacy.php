<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>
<?php 
    if(isset($_SESSION['userid']) && isset($_REQUEST['type']) && isset($_REQUEST['id']) && isset($_REQUEST['pt']) ){
        $suserid;$ruserid;$id=$_REQUEST['id'];
        if(isset($_REQUEST['specificlist'])){
        $specificlist=explode(',', $_REQUEST['specificlist']);
        }
        else
        {
            $specificlist=array();
        }
        if(isset($_REQUEST['hiddenlist'])){
        $hiddenlist=explode(',', $_REQUEST['hiddenlist']);
        }
        else
        {
            $hiddenlist=array();
        }
        switch ($_REQUEST['type'])
        {
           case 'post':
               $query="select suserid,ruserid from status where postid='".$id."'";
               $updateString="update status ";
               $result=mysql_query($query);
               while($row=  mysql_fetch_assoc($result)){
                   if($row['ruserid']==$_SESSION['userid'])
                           mysql_query ("update status set pt='".$_REQUEST['pt']."',specificlist='".serialize ($specificlist)."',hiddenlist='".serialize ($hiddenlist)." where statusid='$id'");
               }
               break;
               case 'admire':
               $query="select suserid,ruserid from testimonial where testyid='".$id."'";
               $updateString="update testimonial ";
               $result=mysql_query($query);
               while($row=  mysql_fetch_assoc($result)){
                   if($row['ruserid']==$_SESSION['userid'])
                           mysql_query ("update testimonial set pt='".$_REQUEST['pt']."',specificlist='".serialize ($specificlist)."',hiddenlist='".serialize ($hiddenlist)." where testyid='$id'");
               }
               break;
               case 'blog':
               $query="select userid from blog where blogid='".$id."'";
               $updateString="update blog ";
               $result=mysql_query($query);
               while($row=  mysql_fetch_assoc($result)){
                   if($row['ruserid']==$_SESSION['userid'])
                           mysql_query ("update blog set pt='".$_REQUEST['pt']."',specificlist='".serialize ($specificlist)."',hiddenlist='".serialize ($hiddenlist)." where blogid='$id'");
               }
               break;
               case 'album':
               $query="select userid from album where albumid='".$id."'";
               $updateString="update album ";
               $result=mysql_query($query);
               while($row=  mysql_fetch_assoc($result)){
                   if($row['userid']==$_SESSION['userid']){
                       mysql_query ("update album set pt='".$_REQUEST['pt']."',specificlist='".serialize ($specificlist)."',hiddenlist='".serialize ($hiddenlist)." where albumid='$id'");
                       $result1=mysql_query("select imageid from image where albumid='$id'");
                       while($row1=  mysql_fetch_assoc($result1)){
                           mysql_query("update image set pt='".$_REQUEST['pt']."',specificlist='".serialize($specificlist)."',hiddenlist='".serialize($hiddenlist)."' where imageid='".$row1['imageid']."'");
                       }
                   }
               }
               break;
               case 'image':
               $query="select userid,albumid from image where imageid='".$id."'";
               $result=mysql_query($query);
               while($row=  mysql_fetch_assoc($result)){
                   $suserid=$row['userid'];
                   $result1=mysql_query("select userid from album where albumid='".$row['albumid']."'");
                   while($row1=  mysql_fetch_assoc($result1)){
                   
                       if($row1['userid']==$_SESSION['userid'])
                           mysql_query ("update image set pt='".$_REQUEST['pt']."',specificlist='".serialize ($specificlist)."',hiddenlist='".serialize ($hiddenlist)." where imageid='$id'");
                   }
                   
               }
               break; 
               
        }
        
    }
?>
