
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>
<?php 
    require_once ('json/JSON.php');
    $json = new Services_JSON();
    $output;
    if(isset($_REQUEST['userid']) && isset($_SESSION['userid'])){
            $frnds=$_SESSION['friends'];
    $bendingrequest=$_SESSION["bendingrequest"];
    mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
    mysql_select_db("fztest1") or die ("coudnt find database");
    mysql_query("delete from invites where ruserid='".$_SESSION['userid']."' and suserid='".$_REQUEST['userid']."'");
    $result=mysql_query("select friendlist,sentrequest from friends_vote where userid='".$_REQUEST['userid']."'");
    $frnds1;$sentrequest;
    while($row=  mysql_fetch_assoc($result))
    {
        $frnds1=unserialize($row['friendlist']);
        $sentrequest=unserialize($row['sentrequest']);
    }
    if(in_array($_REQUEST['userid'],$bendingrequest))
             {
       array_push($frnds,$_REQUEST["userid"]);
       $frnds=array_unique($frnds);
       $bendingrequest=array_diff($bendingrequest,array($_REQUEST['userid']));
       $_SESSION['bendingrequest']=$bendingrequest;
       $_SESSION['friends']=$frnds;
       mysql_query("update friends_vote set friendlist='".  serialize($frnds)."',incomingrequest='".  serialize($bendingrequest)."' where userid='".$_SESSION['userid']."'") ;
       array_push($frnds1,$_SESSION["userid"]);
       $sentrequest=array_diff($sentrequest, array($_SESSION['userid']));
       mysql_query("update friends_vote set friendlist='".  serialize($frnds1)."',sentrequest='".  serialize($sentrequest)."' where userid='".$_REQUEST['userid']."'");
       $result=mysql_query("select count(userid) count from activity where userid='".$_SESSION['userid']."' and title=' now friends' and date>date_sub(now(),interval 1 day)");
       while($row=  mysql_fetch_assoc($result))
       {
           if($row['count']==0){
               mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','0',' now friends','user','friends.php?userid=".$_SESSION['userid']."',now())");
               
           }
           else{
               mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".$row['count']."',' now friends','user','friends.php?userid=".$_SESSION['userid']."',now())");
               
           }
       }
        $result1=mysql_query("select count(userid) count from activity where userid='".$_REQUEST['userid']."' and title=' now friends' and date>date_sub(now(),interval 1 day)");
       while($row1=  mysql_fetch_assoc($result1))
       {
           if($row1['count']==0){
               mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_REQUEST['userid']."','".$_SESSION['userid']."','0',' now friends','user','friends.php?userid=".$_REQUEST['userid']."',date_add(now(),interval 1 second))");
               
           }
           else{
               mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_REQUEST['userid']."','".$_SESSION['userid']."','".$row1['count']."',' now friends','user','friends.php?userid=".$_REQUEST['userid']."',date_add(now(),interval 1 second))");
               
           }
       }
            $output=$json->encode(array("status"=>"friend request accepted successfully"));
   }
   else
             {
       $output=$json->encode(array("status"=> "error occured"));
   }
   mysql_close();
    }
   echo $output;
   ?>