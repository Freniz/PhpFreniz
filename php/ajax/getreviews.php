<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

session_start();
require_once ('getminiprofile.php');

?>
<?xml version="1.0" encoding="utf-8" ?>

<reviews>
<?php 
    $query = "select reviews from user_info where userid='".$_SESSION['userid']."'";
    mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
    mysql_select_db("fztest1") or die ("coudnt find database");
    $result=  mysql_query($query);
    $reviews=array();
    while($row=  mysql_fetch_assoc($result)){
        $reviews=unserialize($row['reviews']);
    }
    if(isset($reviews['post'])){
        if(count($reviews['post'])>0){
            $query1="select statusid,suserid,ruserid,date,status from status where ";
            $i=0;
            foreach($reviews['post'] as $postid){
                $i++;
                if($i!=count($reviews['post']))
                    $query1.=" statusid='$postid' or ";
                else
                    $query1.=" statusid='$postid' ";
            }
            $query1.=" order by date desc";
            $result1=mysql_query($query1);
            while($row1=  mysql_fetch_assoc($result1)){
                if($row1['ruserid']==$_SESSION['userid']){
                    $userpro=  getminipro($row1['suserid']);
              ?>
    <post>
        <id><?php echo $row1['statusid']; ?></id>
        <userid><?php echo $row1['suserid']; ?></userid>
        <username><?php echo htmlspecialchars($userpro['username']); ?></username>
        <userpic><?php echo $userpro['propic']; ?></userpic>
        <status><?php echo htmlspecialchars($row1['status']); ?></status>
        <date><?php echo $row1['date']; ?></date>
    </post>
    <?php
                }
            }
        }
    }
    if(isset($reviews['image'])>0 && count($reviews['image'])>0){
        $query1="select imageid,url,userid,title,description,date from image where ";
        $i=0;
            foreach($reviews['image'] as $imageid){
                $i++;
                if($i!=count($reviews['image']))
                    $query1.=" imageid='$imageid' or ";
                else
                    $query1.=" imageid='$imageid' ";
            }
            $query1.=" order by date desc";
            $result1=mysql_query($query1);
            while($row1=  mysql_fetch_assoc($result1)){
                $userpro=  getminipro($row1['userid']);
     ?>
    <image1>
        <id><?php echo $row1['imageid']; ?></id>
        <userid><?php echo $row1['userid']; ?></userid>
        <username><?php echo htmlspecialchars($userpro['username']); ?></username>
        <userpic><?php echo $userpro['propic']; ?></userpic>
        <url><?php echo $row1['url']; ?></url>
        <title><?php echo htmlspecialchars($row1['title']); ?></title>
        <description><?php echo htmlspecialchars($row1['description']); ?></description>
        <date><?php echo htmlspecialchars($row1['date']); ?></date>
    </image1>
    <?php
                
            }
    }
    if(isset($reviews['admire']) && count($reviews['admire'])>0)
    {
        $query1="select testyid,suserid,ruserid,message,date from testimonial where ";
        $i=0;
            foreach($reviews['admire'] as $admireid){
                $i++;
                if($i!=count($reviews['admire']))
                    $query1.=" testyid='$admireid' or ";
                else
                    $query1.=" testyid='$admireid' ";
            }
            $query1.=" order by date desc";
            $result1=mysql_query($query1);
            while($row1=  mysql_fetch_assoc($result1)){
                if($row1['ruserid']==$_SESSION['userid']){
                    $userpro=  getminipro($row1['suserid']);
              ?>
    <admire>
        <id><?php echo $row1['testyid']; ?></id>
        <userid><?php echo $row1['suserid']; ?></userid>
        <username><?php echo htmlspecialchars($userpro['username']); ?></username>
        <userpic><?php echo htmlspecialchars($userpro['propic']); ?></userpic>
        <status><?php echo htmlspecialchars($row1['message']); ?></status>
        <date><?php echo $row1['date']; ?></date>
    </admire>
    <?php
                }
            }
    }
    if(isset($reviews['pinnedpics']) && count($reviews['pinnedpics'])>0){
        $query1="select imageid,url,userid,albumid,title,description,date from image where ";
        $i=0;
        foreach($reviews['pinnedpics'] as $imageid){
            $i++;
            if($i!=count($reviews['pinnedpics']))
                $query1.=" imageid='$imageid' or ";
            else
                $query1.=" imageid='$imageid' ";
        }
        $query1.=" order by date desc";
        $result1=mysql_query($query1);
        while($row1=  mysql_fetch_assoc($result1)){
            $ruserid;
            $result2=mysql_query("select userid from album where albumid='".$row1['albumid']."'");
            while($row2=  mysql_fetch_assoc($result2))
                $ruserid=$row2['userid'];
            $userpro=  getminipro($row1['userid']);
            $userpro1=  getminipro($ruserid);
            ?>
    <pinnedpic>
        <id><?php echo $row1['imageid']; ?></id>
        <suserid><?php echo $row1['userid']; ?></suserid>
        <susername><?php echo htmlspecialchars($userpro['username']); ?></susername>
        <suserpic><?php echo $userpro['propic']; ?></suserpic>
        <ruserid><?php echo $ruserid; ?></ruserid>
        <rusername><?php echo htmlspecialchars($userpro1['username']); ?></rusername>
        <ruserpic><?php echo $userpro1['propic']; ?></ruserpic>
        <url><?php echo $row1['url']; ?></url>
        <title><?php echo htmlspecialchars($row1['title']); ?></title>
        <description><?php echo htmlspecialchars($row1['description']); ?></description>
        <date><?php echo $row1['date']; ?></date>
    </pinnedpic>
    <?php
     
        }
    }
    if(isset($reviews['otherpinreq']) && count($reviews['otherpinreq'])>0)
    {
        $query1="select imageid,url,userid,title,description,date,pinmereq from image where ";
        $i=0;
        foreach($reviews['otherpinreq'] as $imageid => $users){
            $i++;
            if($i!=count($reviews['otherpinreq']))
                $query1.=" imageid='$imageid' or ";
            else
                $query1.=" imageid='$imageid' ";
        }
        $query1.=" order by date desc";
        $result1=mysql_query($query1);
        while($row1=  mysql_fetch_assoc($result1)){
            $users=unserialize($row1['pinmereq']);
           ?>
    <otherpinreq>
        <id><?php echo $row1['imageid']; ?></id>
        <suserid><?php echo $row1['userid'];$userpro=  getminipro($row1['userid']); ?></suserid>
        <susername><?php echo htmlspecialchars($userpro['username']); ?></susername>
        <suserpic><?php echo $userpro['propic']; ?></suserpic>
        <url><?php echo $row1['url']; ?></url>
        <title><?php echo htmlspecialchars($row1['title']); ?></title>
        <description><?php echo htmlspecialchars($row1['description']); ?></description>
        
            <?php
                foreach($users as $user){
                $userpro=  getminipro($user);
                ?>
        <user>
            <userid><?php echo $userpro['userid']; ?></userid>
            <username><?php echo htmlspecialchars($userpro['username']); ?></username>
            <userpic><?php echo $userpro['propic']; ?></userpic>
        </user>
            <?php
            } ?>
        
    </otherpinreq>
    <?php 
        }
    }
?>
</reviews>