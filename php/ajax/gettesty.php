<?php
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

session_start();
require_once ('getminiprofile.php');

?>
<?xml version="1.0" encoding="utf-8" ?>

<testies>
<?php 
    $query = "select testyid,suserid,ruserid,message,vote,date,pt,specificlist,hiddenlist from testimonial where (suserid='".$_REQUEST['userid']."'or ruserid='".$_REQUEST['userid']."') and accpeted='yes' ";
    $query.="order by date desc limit ".$_REQUEST['from'].",500";
    mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
    mysql_select_db("fztest1") or die ("coudnt find database");
    $result=mysql_query($query);
    $minipro=array();
    while($row=  mysql_fetch_assoc($result)){
    $privacy=$row['pt'];
        $specific=  unserialize($row['specificlist']);
        $hiddenlist=  unserialize($row['hiddenlist']);
        $minipro1=getminipro($row['ruserid']);
        $rusrfrnds=$minipro1['friends'];
        if((($privacy=='public'||($privacy=='friends' && in_array($row['ruserid'],$_SESSION['friends']))||($privacy=='fof' && count(array_intersect($rusrfrnds, $_SESSION['friends'])>=1) )||($privacy=='specific' && in_array($_SESSION['userid'], $specific)))&& !in_array($row['ruserid'], $_SESSION['blocklist']) && !in_array($row['ruserid'], $_SESSION['blockedby']) && !in_array($_SESSION['userid'], $hiddenlist))|| $_SESSION['userid']==$row['ruserid']){
    ?>

   <testy>
       <id><?php echo $row['testyid'] ?></id>
       <suserid><?php echo $row['suserid']; $minipro=getminipro($row['suserid']) ?></suserid>
       <susername><?php echo $minipro["username"]; ?></susername>
       <suserpic><?php echo $minipro["propic"]; ?></suserpic>
       <suserfrnds><?php echo serialize($minipro["friends"]); ?></suserfrnds>
       <suservotes><?php echo serialize($minipro["votes"]); ?></suservotes>
       <message><?php echo $row['message'] ?></message>
       <vote_count><?php $votes=unserialize($row['vote']); echo sizeof($votes); ?></vote_count>
       <vote><?php echo serialize($votes); ?></vote>
       <votecontains><?php if(in_array($_SESSION['userid'], $votes)){
                            echo "yes";
                     }
                        else 
                            echo "no";
                            ?></votecontains>
                            
       <date><?php echo $row['date']; ?></date>
       
   </testy>
       <?php   }
       
       }
     ?>
    
</testies>
    
