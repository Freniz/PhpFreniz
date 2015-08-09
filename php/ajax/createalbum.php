<?php
session_start();
require_once ('json/JSON.php');
    $json = new Services_JSON();
    $output=array();
 if(isset($_SESSION['userid']) && isset ($_REQUEST['albumname'])) {
mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
mysql_select_db("fztest1") or die ("coudnt find database");
$result=mysql_query("select postvisi,postspeci,posthidden from privacy where userid='".$_SESSION['userid']."'");
while($row=  mysql_fetch_assoc($result)){
if(mysql_query("insert into album (userid,name,date,pt,specificlist,hiddenlist,ignorelist) values('".$_SESSION['userid']."','".$_REQUEST['albumname']."',now(),'".$row['postvisi']."','".$row['postspeci']."','".$row['posthidden']."','a:0:{}')"))
{
    $updtdid=mysql_insert_id();
    $output=$json->encode(array("status"=>"album created successfully"));
}
else
   $output=$json->encode(array("status"=>"error occured while creating album"));
    
}
 }
echo $output;
?>