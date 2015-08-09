<?php
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

session_start();
require_once ('getminiprofile.php');

?>
<?xml version="1.0" encoding="utf-8" ?>

<posts>
<?php if(isset($_REQUEST['type']) && isset($_REQUEST['userid']) && isset($_REQUEST['from'])){
    $query = "select statusid,suserid,ruserid,status,comments,commentcount,vote,date,pt,specificlist,hiddenlist from status where ruserid='".$_REQUEST['userid']."' and accepted='yes'";
    if($_REQUEST['type']=='posts')
        $query.=" and suserid='".$_REQUEST['userid']."' ";
    else if($_REQUEST['type']=='scribbles')
        $query.=" and suserid!='".$_REQUEST['userid']."' ";
    $query.="order by date desc limit ".$_REQUEST['from'].",500";
    
     mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
    mysql_select_db("fztest1") or die ("coudnt find database");
    $result=mysql_query($query);
    $minipro=array();
    while($row=  mysql_fetch_assoc($result)){
    $rusrid=$row['ruserid'];
    $comments=unserialize($row['comments']);
    $privacy=$row['pt'];
    $specific=  unserialize($row['specificlist']);
    $hiddenlist=  unserialize($row['hiddenlist']);
    $minipro1=getminipro($rusrid);
    $rusrfrnds=$minipro1['friends'];
    if((($privacy=='public'||($privacy=='friends' && in_array($rusrid,$_SESSION['friends']))||($privacy=='fof' && count(array_intersect($rusrfrnds, $_SESSION['friends'])>=1) )||($privacy=='specific' && in_array($_SESSION['userid'], $specific)))&& !in_array($rusrid, $_SESSION['blocklist']) && !in_array($rusrid, $_SESSION['blockedby']) && !in_array($_SESSION['userid'], $hiddenlist))|| $_SESSION['userid']==$rusrid || $_SESSION['userid']==$row['suserid'] ){
     ?>

   <post>
       <id><?php echo $row['statusid'] ?></id>
       <suserid><?php echo $row['suserid']; $minipro=getminipro($row['suserid']) ?></suserid>
       <susername><?php echo $minipro["username"]; ?></susername>
       <suserpic><?php echo $minipro["propic"]; ?></suserpic>
       <suserfrnds><?php echo serialize($minipro["friends"]); ?></suserfrnds>
       <suservotes><?php echo serialize($minipro["votes"]); ?></suservotes>
       <status><?php echo htmlspecialchars($row['status'], ENT_QUOTES); ?></status>
       <vote_count><?php $votes=unserialize($row['vote']); echo sizeof($votes); ?></vote_count>
       <vote><?php echo serialize($votes); ?></vote>
       <votecontains><?php if(in_array($_SESSION['userid'], $votes)){
                            echo "yes";
                     }
                        else 
                            echo "no";
                            ?>
       </votecontains>
       <commentcount><?php echo $row['commentcount']; ?></commentcount>
       <comments>
           <?php foreach($comments as $commentid => $comment){ $userpro=  getminipro($comment['userid']); ?>
           <comment>
           <comment-id><?php echo $commentid; ?></comment-id>
           <comment-userid><?php echo $comment['userid']; ?></comment-userid>
           <comment-username><?php echo $userpro['username']; ?></comment-username>
           <comment-userpic><?php echo $userpro["propic"]; ?></comment-userpic>
           <comment-comment><?php echo $comment['comment']; ?></comment-comment>
           <comment-date><?php echo $comment['date']; ?></comment-date>
           </comment>
           <?php } ?>
       </comments>
      <date><?php echo $row['date']; ?></date>
       
   </post>
       <?php }  }
}
     ?>
    
</posts>
    
