<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'getminiprofile.php';
?>
<?php
    require_once ('json/JSON.php');
    $json = new Services_JSON();
    $output;
    if(isset($_SESSION['userid']) && isset($_REQUEST['postid']))
    {
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select ruserid,suserid,vote,notifyusers from status where statusid='".$_REQUEST['postid']."'");
        while($row=  mysql_fetch_assoc($result))
        {
            $userpro=getminipro($row['ruserid']);
            $notifyusers=unserialize($row['notifyusers']);
            $votes=unserialize($row['vote']);
            if(!in_array($_SESSION['userid'], $votes))
            {
                
                array_push($votes, $_SESSION['userid']);
                mysql_query("update status set vote='".serialize($votes)."' where statusid='".$_REQUEST['postid']."'");
                mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$row['ruserid']."','".$_REQUEST['postid']."','voted on','post','post.php?postid=".$_REQUEST['postid']."',now())");
                $notifyusers=array_merge($votes,array($row['suserid'],$row['ruserid']),$notifyusers);
                $notifyusers=array_diff($notifyusers,array($_SESSION['userid']));
                $votes1=array_diff($votes, array($_SESSION['userid']));
                $notifyusers=array_unique($notifyusers);
                foreach($notifyusers as $user)
                {
                    $result1=mysql_query("select notifications from notification where userid='".$user."'");
                    while($row1=  mysql_fetch_assoc($result1)){
                        $notifications=unserialize($row1['notifications']);
                                    $notificationtext;
                                    if(sizeof($votes)>1)
                                    {
                                        if(sizeof($votes)!=2)
                                            $notificationtext="<a href='profile.php?userid=".$_SESSION['userid']."'>".$_SESSION['username']."</a> and ".(sizeof($votes1)-1)." others voted";
                                        else
                                            $notificationtext="<a href='profile.php?userid=".$_SESSION['userid']."'>".$_SESSION['username']."</a> and ".(sizeof($votes1)-1)." other voted";
                                    }
                                    else
                                    {
                                        $notificationtext="<a href='profile.php?userid=".$_SESSION['userid']."'>".$_SESSION['username']."</a>  voted";
                                    }
                                    if($user==$row['suserid'] && $user==$row['ruserid'])
                                    {
                                        $notificationtext.=" your post";
                                    }
                                    else if($user==$row['suserid']){
                                        $notificationtext.=" your post of <a href='profile.php?userid=".$row['ruserid']."'>".$userpro['username']."</a>'s chart";
                                    }
                                    else if($user==$row['ruserid'])
                                    {
                                        $notificationtext.=" your post";
                                    }
                                    else
                                    {
                                        $notificationtext.=" <a href='profile.php?userid=".$row['ruserid']."'>".$userpro['username']."</a>'s post";
                                    }
                                    $notifications["post.php?postid=".$_REQUEST['postid']."#"]=array("notification"=>  htmlspecialchars($notificationtext,ENT_QUOTES),"read"=>"0","time"=>  time());
                                    mysql_query("update notification set notifications='".serialize($notifications)."' where userid='".$user."'");
                    }
                }
                $output=$json->encode(array("status"=>"you have voted to this post"));
            }
            
        else
            $output=$json->encode(array("status"=> "you are already voted to this post"));
        }
       mysql_close(); 
    }
    else
        $output=$json->encode(array("status"=> "you don't have permission to vote this post"));
   echo $output;
   
?>