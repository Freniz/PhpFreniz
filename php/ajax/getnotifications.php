<?php
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

session_start();

?>
<?xml version="1.0" encoding="utf-8" ?>

<notifications>
<?php 
    $query = "select userid,notifications from notification where userid='".$_SESSION['userid']."'";
    $showcontent=false;
    mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
    mysql_select_db("fztest1") or die ("coudnt find database");
    $result=mysql_query($query);
    while($row=  mysql_fetch_assoc($result)){
        $notifications=unserialize($row['notifications']);
        $ordered_notifications;
        foreach ($notifications as $key => &$entry) {
    $ordered_notifications[$entry['time']][$key] = $entry;
}
krsort($ordered_notifications);
$notifications=array_values($ordered_notifications);
$ordered_notifications=array();
foreach ($notifications as $key => &$entry) {
    foreach($entry as $key1=>&$entry1)    
    $ordered_notifications[$entry1['read']][$key1] = $entry1;
}
ksort($ordered_notifications);
$ordered_notifications=  array_values($ordered_notifications);
foreach ($ordered_notifications as $notification){
    foreach($notification as $key => $value){
          ?>

   <notification>
       <userid><?php echo $_SESSION['userid']; ?></userid>
       <contenturl><?php echo $key; ?></contenturl>
       <text><?php echo $value['notification']; ?></text>
       <read><?php echo $value["read"]; ?></read>
      <date><?php echo date(DATE_RSS,$value['time']); ?></date>
       
   </notification>
       <?php  
    }
    }
    }
     ?>
    
</notifications>
    
