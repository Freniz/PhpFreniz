<?php
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

session_start();
require_once ('getminiprofile.php');

?>
<?xml version="1.0" encoding="utf-8" ?>

<blogs>
<?php 
    $query = "select blogid,title,imgurl,userid,blog,vote,date,pt,specificlist,hiddenlist from blog where userid='".$_REQUEST['userid']."'";
    $query.="order by date desc limit ".$_REQUEST['from'].",500";
    mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
    mysql_select_db("fztest1") or die ("coudnt find database");
    $result=mysql_query($query);
    $minipro=array();
    while($row=  mysql_fetch_assoc($result)){
        $rusrid=$row['userid'];
    $privacy=$row['pt'];
    $specific=  unserialize($row['specificlist']);
    $hiddenlist=  unserialize($row['hiddenlist']);
    $minipro1=getminipro($rusrid);
    $rusrfrnds=$minipro1['friends'];
    if((($privacy=='public'||($privacy=='friends' && in_array($rusrid,$_SESSION['friends']))||($privacy=='fof' && count(array_intersect($rusrfrnds, $_SESSION['friends'])>=1) )||($privacy=='specific' && in_array($_SESSION['userid'], $specific)))&& !in_array($rusrid, $_SESSION['blocklist']) && !in_array($rusrid, $_SESSION['blockedby']) && !in_array($_SESSION['userid'], $hiddenlist))|| $_SESSION['userid']==$rusrid ){
       
?>

   <blog>
       <id><?php echo $row['blogid'] ?></id>
	 <title><?php echo $row['title'] ?></title>
       <imgurl><?php echo $row['imgurl'] ?></imgurl>
       <suserid><?php echo $row['userid']; $minipro=getminipro($row['userid']) ?></suserid>
       <susername><?php echo $minipro["username"]; ?></susername>
       <suserpic><?php echo $minipro["propic"]; ?></suserpic>
       <suserfrnds><?php echo serialize($minipro["friends"]); ?></suserfrnds>
       <suservotes><?php echo serialize($minipro["votes"]); ?></suservotes>
       <blog1><?php echo $row['blog'] ?></blog1>
       <vote_count><?php $votes=unserialize($row['vote']); echo sizeof($votes); ?></vote_count>
       <vote><?php echo serialize($votes); ?></vote>
       <votecontains><?php if(in_array($_SESSION['userid'], $votes)){
                            echo "yes";
                     }
                        else 
                            echo "no";
                            ?></votecontains>
                            
       <date><?php echo $row['date']; ?></date>
       
   </blog>
       <?php }   }
     ?>
    
</blogs>
    
