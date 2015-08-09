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
    if(isset($_SESSION['userid']) && isset($_REQUEST['blogid']))
    {
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select userid,vote from blog where blogid='".$_REQUEST['blogid']."'");
        while($row=  mysql_fetch_assoc($result))
        {
            $userpro=getminipro($row['userid']);
            $votes=unserialize($row['vote']);
            $votes1=$votes;
            array_push($votes1, $row['userid']);
            $votes1=array_diff($votes1,array($_SESSION['userid']));
            $votes1=array_unique($votes1);
            if(!in_array($_SESSION['userid'], $votes))
            {
                array_push($votes, $_SESSION['userid']);
                mysql_query("update blog set vote='".serialize($votes)."' where blogid='".$_REQUEST['blogid']."'");
                mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$row['userid']."','".$_REQUEST['blogid']."','voted on','blog','blog.php?blogid=".$_REQUEST['blogid']."',now())");
                foreach($votes1 as $user)
                {
                    $result1= mysql_query("select notifications from notification where userid='".$user."'");
                    while($row1=  mysql_fetch_assoc($result1)){
                        $notifications=unserialize($row1['notifications']);
                        $notificationtext;
                                    if(sizeof($votes)>1)
                                    {
                                        if(sizeof($votes)!=2)
                                            $notificationtext="<a href='profile.php?userid=".$_SESSION['userid']."'>".$_SESSION['username']."</a> and ".(sizeof($votes)-1)." others voted";
                                        else
                                            $notificationtext="<a href='profile.php?userid=".$_SESSION['userid']."'>".$_SESSION['username']."</a> also voted";
                                    }
                                    else
                                    {
                                        $notificationtext="<a href='profile.php?userid=".$_SESSION['userid']."'>".$_SESSION['username']."</a>  voted";
                                    }
                                    if($user==$row['userid'])
                                    {
                                        $notificationtext.=" your blog";
                                    }
                                    
                                    else
                                    {
                                        $notificationtext.=" <a href='profile.php?userid=".$row['userid']."'>".$userpro['username']."</a>'s blog";
                                    }
                                    $notifications["blog.php?blogid=".$_REQUEST['blogid']]=array("notification"=>  htmlspecialchars($notificationtext,ENT_QUOTES),"read"=>"0","time"=>  time());
                                    mysql_query("update notification set notifications='".serialize($notifications)."' where userid='".$user."'");
                    }
                }
                $output=json_encode(array("status"=>"you have voted to this blog"));
            }
            
        else
            $output=json_encode(array("status"=> "you are already voted to this blog"));
        }
       mysql_close(); 
    }
    else
        $output=json_encode(array("status"=> "you don't have permission to vote this blog"));
   echo $output;
?>