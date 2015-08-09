<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once '../classes/Images.php';
require 'compressimage.php';
?>
<?php
    $output;
   if(isset($_REQUEST['imageid']) && isset($_REQUEST['deletesrc']) && isset($_REQUEST['x']) && isset($_REQUEST['y']) && isset($_REQUEST['width']) && isset($_REQUEST['height']) && isset($_SESSION['userid'])){
       mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
       mysql_select_db("fztest1") or die ("coudnt find database");
       $result=mysql_query("select url,albumid,userid,pinnedpeople from image where imageid='".$_REQUEST['imageid']."'");
       $albumid;$ruserid;
       $Imgs=new Images();
       while($row=  mysql_fetch_assoc($result)){
           $url=$row['url'];
           $albumid=$row['albumid'];
           $pinnedpeople=unserialize($row['pinnedpeople']);
           $suserid=$row['userid'];
           $result1=mysql_query("select userid from album where albumid='$albumid'");
           while($row1=  mysql_fetch_assoc($result1))
               $ruserid=$row1['userid'];
       }
       print_r($pinnedpeople);
       if($_SESSION['userdetails']['propicalbum']==$albumid ){
           if($_REQUEST['deletesrc']=='true'){
               $resolutions=array(32,50,75,200);
               $Imgs->cropImage( '../images/'.$url, '../images/'.$url,$resolutions,$_REQUEST['x'], $_REQUEST['y'], $_REQUEST['width'], $_REQUEST['height']);
           }
            mysql_query ("update user_info set propic='".$_REQUEST['imageid']."' where userid='".$_SESSION['userid']."'");
           //mysql_query("insert into image (title,description,url,albumid,userid,date,pinnedpeople,vote,pt,specificlist,hiddenlist,notifyusers,accepted,reqpinusers,pinmereq,comments) values('title','description','".$filename.'.'.$ext."','".$_REQUEST['album']."','".$_SESSION['userid']."',now(),'".$a."','".$a."','".$pt."','".$specific."','".$hidden."','a:0:{}','".$accepted."','a:0:{}','a:0:{}','a:0:{}')");
            //$Imgs->setAsProPic($_REQUEST['imageid'],$_REQUEST['deletesrc'],$_REQUEST['x'],$_REQUEST['y'],$_REQUEST['width'],$_REQUEST['height']);
       }
       else if($_SESSION['userid']==$suserid || $_SESSION['userid']==$ruserid || in_array($_SESSION['userid'], $pinnedpeople))
       {
           $pathinfo=pathinfo($url);
           $ext=$pathinfo['extension'];
           $filename=md5(uniqid());
           while(file_exists('../images/'.$filename.'.'.$ext))
               $filename.=rand(10,25);
           $resolutions=array(32,50,75,200,500,0);
           $Imgs->cropImage( '../images/'.$url, '../images/'.$filename.'.'.$ext,$resolutions,$_REQUEST['x'], $_REQUEST['y'], $_REQUEST['width'], $_REQUEST['height']);
           mysql_query("insert into image (title,description,url,albumid,userid,date,pinnedpeople,vote,pt,specificlist,hiddenlist,notifyusers,accepted,reqpinusers,pinmereq,comments) values('title','description','".$filename.'.'.$ext."','".$_SESSION['userdetails']['propicalbum']."','".$_SESSION['userid']."',now(),'a:0:{}','a:0:{}','public','a:0:{}','a:0:{}','a:0:{}','yes','a:0:{}','a:0:{}','a:0:{}')");
           $updtid=mysql_insert_id();
           mysql_query("update user_info set propic='$updtid' where userid='".$_SESSION['userid']."'");
           mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values ('".$_SESSION['userid']."','".$_SESSION['userid']."','".$_SESSION['propic']."','changed propic','propic','propic.php',now())");
       }
       
       
       
   }
   
?>