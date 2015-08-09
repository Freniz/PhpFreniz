<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

session_start();
require_once 'getminiprofile.php';
?>
<?php
    if(isset($_SESSION['userid']) && $_SESSION['type']=='user'){
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $query="select userid,hometown,currentcity,school,college,employer from user_info where userid!='default' and userid!='".$_SESSION['userid']."'";
        foreach($_SESSION['friends'] as $user)
            $query.=" and userid!='".$user."' ";
        $result=mysql_query($query);
        $suggestpriority;
        $userarray=array();
        $suggestions= array();
        while($row=  mysql_fetch_assoc($result)){
            if($_SESSION['hometown']==$row['hometown'] && $_SESSION['currentcity']==$row['currentcity'])
                $suggestpriority=2;
             else if($_SESSION['hometown']!=$row['hometown'] && $_SESSION['currentcity']!=$row['currentcity'])
                 $suggestpriority=0;
             else
                 $suggestpriority=1;
             $userpro=getminipro($row['userid']);
            $suggestpriority+=(count(array_intersect($_SESSION['school'], unserialize($row['school'])))*2)+(count(array_intersect($_SESSION['college'], unserialize($row['college'])))*3)+(count(array_intersect($_SESSION['employer'], unserialize($row['employer'])))*2)+(count(array_intersect($_SESSION['friends'], $userpro['friends']))/10);
            if(!isset($userarray[$suggestpriority]))
                $userarray[$suggestpriority]=array($row['userid']);
            else
                array_push ($userarray[$suggestpriority], $row['userid']);
        }
        krsort($userarray);
        foreach($userarray as $values)
        {
            foreach($values as $value)
                array_push($suggestions, $value);
        }
    }

?>
<?xml version="1.0" encoding="utf-8" ?>
<users>
    <?php foreach($suggestions as $user) {
        $userpro1=getminipro($user); 
?>
    <user>
        <userid><?php echo $userpro1['userid']; ?></userid>
        <username><?php echo $userpro1['username']; ?></username>
        <propic><?php echo $userpro1['propic']; ?></propic>
        <mood><?php echo $userpro1['mood']; ?></mood>
        <mutual><?php echo count(array_intersect($_SESSION['friends'], $userpro1['friends'])); ?></mutual>
        <votes><?php echo count($userpro1['votes']); ?></votes>
    </user>
    <?php } ?>
</users>