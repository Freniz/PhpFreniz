

<?php
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

session_start();
require_once ('getminiprofile.php');

?>
<?xml version="1.0" encoding="utf-8" ?>

<posts>
<?php 
    $query = "select statusid,suserid,ruserid,status,commentcount,vote,date,pt,specificlist,hiddenlist from status where suserid='".$_SESSION['userid']."'or ruserid='".$_SESSION['userid']."'";
    $showcontent=false;
    foreach($_SESSION['friends'] as $user)
            $query.=" or suserid='".$user."' or ruserid='".$user."'";
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

   <post>
       <id><?php echo $row['statusid'] ?></id>
       <suserid><?php echo $row['suserid']; $minipro=getminipro($row['suserid']); ?></suserid>
       <susername><?php echo $minipro["username"]; ?></susername>
       <suserpic><?php echo $minipro["propic"]; ?></suserpic>
       <suserfrnds><?php echo serialize($minipro["friends"]); ?></suserfrnds>
       <suservotes><?php echo serialize($minipro["votes"]); ?></suservotes>
       <ruserid><?php echo $row['ruserid'];  ?></ruserid>
       <rusername><?php echo $minipro1["username"]; ?></rusername>
       <ruserpic><?php echo $minipro1["propic"]; ?></ruserpic>
       <ruserfrnds><?php echo serialize($minipro1["friends"]); ?></ruserfrnds>
       <ruservotes><?php echo serialize($minipro1["votes"]); ?></ruservotes>
       <status><?php echo htmlspecialchars($row['status'], ENT_QUOTES); ?></status>
       <vote_count><?php $votes=unserialize($row['vote']); echo sizeof($votes); ?></vote_count>
       <vote><?php echo serialize($votes); ?></vote>
       <votecontains><?php if(in_array($_SESSION['userid'], $votes)){
                            echo "yes";
                     }
                        else 
                            echo "no";
                            ?></votecontains>
                            <commentcount><?php echo $row['commentcount']; ?></commentcount>
       <date><?php echo $row['date']; ?></date>
       
   </post>
       <?php   }
    }
     ?>
    
</posts>
    
