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
require_once '../Classes/Images.php';
?>
<?xml version="1.0" encoding="UTF-8"?>
<?php
    if(isset($_SESSION['userid']) && $_REQUEST['imageid']){
    $images=new Images();
    $comments=$images->getComments($_REQUEST['imageid']);
    krsort($comments);
    
?>
    <imgcomments>
    <?php
    echo count($comments);
    foreach($comments as $key=>$comment){
        ?>
        <comment>
            <id><?php echo $key ?></id>
       <suserid><?php echo $comment['userid']; $minipro=getminipro($comment['userid']) ?></suserid>
       <susername><?php echo $minipro["username"]; ?></susername>
       <suserpic><?php echo $minipro["propic"]; ?></suserpic>
       <suserfrnds><?php echo serialize($minipro["friends"]); ?></suserfrnds>
       <suservotes><?php echo serialize($minipro["votes"]); ?></suservotes>
       <status><?php echo $comment['comment']; ?></status>
       <vote_count><?php $votes=unserialize($comment['vote']); echo sizeof($votes); ?></vote_count>
       <vote><?php echo serialize($votes); ?></vote>
       <votecontains><?php if(in_array($_SESSION['userid'], $votes)){
                            echo "yes";
                     }
                        else 
                            echo "no";
                            ?></votecontains>
                            
       <date><?php echo $comment['date']; ?></date>
       
        </comment>
    <?php } 
    ?>
    </imgcomments>
    <?php } ?>
