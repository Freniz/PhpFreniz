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
    mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
    mysql_select_db("fztest1") or die ("coudnt find database");
    $result=mysql_query("select friendlist from friends_vote where userid='".$_REQUEST['userid']."'");
    $frnds1;
    while($row=  mysql_fetch_assoc($result))
    {
        $frnds1=unserialize($row['friendlist']);
    }
    if(in_array($_REQUEST['userid'],$frnds))
             {
        $newfrnds=array_diff($frnds,array($_REQUEST["userid"]));
       $newfrnds=array_unique($newfrnds);
       $_SESSION['friends']=$newfrnds;
       mysql_query("update friends_vote set friendlist='".  serialize($newfrnds)."' where userid='".$_SESSION['userid']."'");
       $newfrnds1=array_diff($frnds1,array($_SESSION["userid"]));
       mysql_query("update friends_vote set friendlist='".  serialize($newfrnds1)."' where userid='".$_REQUEST['userid']."'");
       mysql_query("delete from activity where (userid='".$_SESSION['userid']."' and ruserid='".$_REQUEST['userid']."' and title=' now friends') or (userid='".$_REQUEST['userid']."' and ruserid='".$_SESSION['userid']."' and title=' now friends')");
       $output=$json->encode(array("status"=>"success"));
   }
   else
             {
       $output=$json->encode(array("status"=> "error occured"));
   }
   mysql_close();
    }
   echo $output;
   ?>