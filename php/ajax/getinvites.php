<?php
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

session_start();
require_once ('getminiprofile.php');

?>
<?xml version="1.0" encoding="utf-8" ?>

<invites>
<?php 
    if(isset($_SESSION['userid']) && isset($_REQUEST['userid'])){
    $query = "select inviteid,text,songurl,imageurl from invites where suserid='".$_REQUEST['userid']."' and ruserid='".$_SESSION['userid']."'";
    mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
    mysql_select_db("fztest1") or die ("coudnt find database");
    $result=mysql_query($query);
    $minipro=getminipro($_REQUEST['userid']);
    while($row=  mysql_fetch_assoc($result)){
?>

   <invite>
       <id><?php echo $row['inviteid'] ?></id>
       <suserid><?php echo $minipro["userid"]; ?></suserid>
       <susername><?php echo $minipro["username"]; ?></susername>
       <suserpic><?php echo $minipro["propic"]; ?></suserpic>
       <mutualfrnds><?php echo count(array_intersect($minipro["friends"], $_SESSION['friends'])); ?></mutualfrnds>
       <suservotes><?php echo count($minipro["votes"]); ?></suservotes>
       <text><?php echo $row['text']; ?></text>
       <songurl><?php echo $row['songurl']; ?></songurl>
       <imageurl><?php echo $row['imageurl']; ?></imageurl>
   </invite>
       <?php }   }
     ?>
    
</invites>
    
