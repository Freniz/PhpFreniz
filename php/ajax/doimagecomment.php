<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'getminiprofile.php';
?>
<?php
    $output;
    if(isset($_REQUEST['imageid']) && isset($_REQUEST['comment']) && isset($_SESSION['userid'])){
        $comment=trim($_REQUEST['comment']);
        if(strlen($comment)>0)
                       {
            mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
            mysql_select_db("fztest1") or die ("coudnt find database");
            $result=mysql_query("select userid,albumid,comments,pinnedpeople,notifyusers from image where imageid='".$_REQUEST['imageid']."'");
            while($row=  mysql_fetch_assoc($result)){
                $result1=mysql_query("select userid from album where albumid='".$row['albumid']."'" );
                while($row1=  mysql_fetch_assoc($result1))
                {
                    $userpro=getminipro($row1['userid']);
                    if($userpro['type']=='user' && $_SESSION['type']!='leaf'){
                        $result2=mysql_query("select post,postignore from privacy where userid='".$userpro['userid']."'" );
                    while($row2=  mysql_fetch_assoc($result2)){
                    $ignore=unserialize($row2['postignore']);
                        if(($row2['post']=='friends' && !in_array($userpro['userid'], $_SESSION['blocklist'])&& !in_array($userpro['userid'], $_SESSION['blockedby'])&&in_array($userpro['userid'], $_SESSION['friends']) && !in_array($_SESSION['userid'], $ignore))||($userpro['userid']==$_SESSION['userid'])){
                            mysql_query("insert into image_comments(userid,imageid,comment,vote,date) values('".$_SESSION['userid']."','".$_REQUEST['imageid']."','".$_REQUEST['comment']."','a:0:{}',now())");
                            $notifyusers=unserialize($row['notifyusers']);
                            $notifyusers=array_diff($notifyusers, array($_SESSION['userid']));
                            $notifyusers1=$notifyusers;
                            array_push($notifyusers1, $userpro['userid']);
                            array_push($notifyusers1, $row['userid']);
                            $notifyusers1=array_diff($notifyusers1, array($_SESSION['userid']));
                            $notifyusers1=array_unique($notifyusers1);
                            foreach($notifyusers1 as $user)
                            {
                                $result3=mysql_query("select notifications from notification where userid='".$user."'");
                                while($row3=  mysql_fetch_assoc($result3))
                                {
                                    $notifications=unserialize($row3['notifications']);
                                    $notificationtext;
                                    if(sizeof($notifyusers)>1)
                                    {
                                        $notificationtext="<a href='profile.php?userid=".$_SESSION['userid']."'>".$_SESSION['username']."</a> and ".(sizeof($notifyusers)-1)." other commented on";
                                    }
                                    else
                                    {
                                        $notificationtext="<a href='profile.php?userid=".$_SESSION['userid']."'>".$_SESSION['username']."</a>  commented on";
                                    }
                                    if($user==$row['userid'] && $user==$userpro['userid'])
                                    {
                                        $notificationtext.=" your photo";
                                    }
                                    else if($user==$row['userid']){
                                        $notificationtext.=" your photo of <a href='profile.php?userid=".$userpro['userid']."'>".$userpro['username']."</a>'s chart";
                                    }
                                    else if($user==$userpro['userid'])
                                    {
                                        $notificationtext.=" your photo";
                                    }
                                    else
                                    {
                                        $notificationtext.=" <a href='profile.php?userid=".$userpro['userid']."'>".$userpro['username']."</a>'s photo";
                                    }
                                    $notifications["photo.php?imageid=".$_REQUEST['imageid']]=array("notification"=>  htmlspecialchars($notificationtext,ENT_QUOTES),"read"=>"0","time"=>  time());
                                    mysql_query("update notification set notifications='".serialize($notifications)."' where userid='".$user."'");
                                    
                                }
                            }
                            array_push($notifyusers,$_SESSION['userid']);
                            mysql_query("update image set notifyusers='".  serialize($notifyusers)."' where imageid='".$_REQUEST['imageid']."'");
                            $output=json_encode(array("status"=>"your comment sucessfully posted"));
                                    }
                                    else
                                     $output=json_encode(array("status"=>"you do not have permission to comment"));
                    }
                    }
                    else if($userpro['type']=='leaf')
                    {
                        if((($userpro['canpost']=='public' ||($userpro['canpost']=='votedusers' && in_array($_SESSION['userid'], $userpro['votes'])))&& !in_array($_SESSION['userid'], $userpro['bannedusers'])||  in_array($_SESSION['userid'], $userpro['admin']) || $_SESSION['userid']==$userpro['userid']   )){
                            mysql_query("insert into image_comments (imageid,userid,comment,date,vote) values('".$_REQUEST['imageid']."','".$_SESSION['userid']."','".mysql_real_escape_string($comment)."',now(),'".  serialize(array())."')");
                            $notifyusers=unserialize($row['notifyusers']);
                            $notifyusers=array_diff($notifyusers, array($_SESSION['userid']));
                            $notifyusers1=$notifyusers;
                            array_push($notifyusers1, $userpro['userid']);
                            array_push($notifyusers1, $row['userid']);
                            $notifyusers1=array_diff($notifyusers1, array($_SESSION['userid']));
                            $notifyusers1=array_unique($notifyusers1);
                            foreach($notifyusers1 as $user)
                            {
                                $result3=mysql_query("select notifications from notification where userid='".$user."'");
                                while($row3=  mysql_fetch_assoc($result3))
                                {
                                    $notifications=unserialize($row3['notifications']);
                                    $notificationtext;
                                    if(sizeof($notifyusers)>1)
                                    {
                                        $notificationtext="<a href='profile.php?userid=".$_SESSION['userid']."'>".$_SESSION['username']."</a> and ".(sizeof($notifyusers)-1)." other commented on";
                                    }
                                    else
                                    {
                                        $notificationtext="<a href='profile.php?userid=".$_SESSION['userid']."'>".$_SESSION['username']."</a>  commented on";
                                    }
                                    if($user==$row['userid'] && $user==$userpro['userid'])
                                    {
                                        $notificationtext.=" your photo";
                                    }
                                    else if($user==$row['userid']){
                                        $notificationtext.=" your photo of <a href='profile.php?userid=".$userpro['userid']."'>".$userpro['username']."</a>'s chart";
                                    }
                                    else if($user==$userpro['userid'])
                                    {
                                        $notificationtext.=" your photo";
                                    }
                                    else
                                    {
                                        $notificationtext.=" <a href='profile.php?userid=".$userpro['userid']."'>".$userpro['username']."</a>'s photo";
                                    }
                                    $notifications["photo.php?imageid=".$_REQUEST['imageid']]=array("notification"=>  htmlspecialchars($notificationtext,ENT_QUOTES),"read"=>"0","time"=>  time());
                                    mysql_query("update notification set notifications='".serialize($notifications)."' where userid='".$user."'");
                                    
                                }
                            }
                            array_push($notifyusers,$_SESSION['userid']);
                            mysql_query("update image set notifyusers='".  serialize($notifyusers)."' where imageid='".$_REQUEST['imageid']."'");
                            $output=json_encode(array("status"=>"your comment sucessfully posted"));
                        }  
                        else
                                     $output=json_encode(array("status"=>"you do not have permission to comment"));
                    }
                }
            }
            
            
            mysql_close();
        }
        else
            $output=json_encode(array("status"=> "your comment cannot be blank"));
    }
    else
        $output=json_encode(array("status"=>"please give the valid information"));
    echo $output;
?>