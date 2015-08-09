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
   if(isset($_SESSION['userid']) && isset($_REQUEST['text']) && isset($_REQUEST['postid'])){
       if(sizeof($_REQUEST['text'])>0)
                       {
            mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
            mysql_select_db("fztest1") or die ("coudnt find database");
            $a=array();
            $result=mysql_query("select suserid,ruserid,commentcount,notifyusers,comments from status where statusid='".$_REQUEST['postid']."'");
            while($row=  mysql_fetch_assoc($result)){
                $comments=unserialize($row['comments']);
                $comment=array();
                $comment['userid']=$_SESSION['userid'];
                $comment['comment']=$_REQUEST['text'];
                $comment['date']=date('c');
                $comment['vote']=array();
                $rand=mt_rand();
                while(array_key_exists($rand, $comments))
                    $rand.=mt_rand(10,25);
                $comments[$rand]=$comment;
                $userpro=getminipro($row['ruserid']);
                
                
                if($userpro['type']=='user' && $_SESSION['type']!='leaf')
                    {
                        $result2=mysql_query("select post,postignore from privacy where userid='".$row['ruserid']."'");
                        while($row2=  mysql_fetch_assoc($result2)){
                        $ignore=unserialize($row2['postignore']);
                        if(($row2['post']=='friends' && !in_array($row['ruserid'], $_SESSION['blocklist'])&& !in_array($row['ruserid'], $_SESSION['blockedby'])&&in_array($row['ruserid'], $_SESSION['friends']) && !in_array($_SESSION['userid'], $ignore))||($row['ruserid']==$_SESSION['userid'])){
                            mysql_query("insert into comment(statusid,userid,comment,vote,date) values('".$_REQUEST['postid']."','".$_SESIION['userid']."','".mysql_real_escape_string($_REQUEST['text'])."','a:0:{},now())")
                            mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$row['ruserid']."','".$_REQUEST['postid']."','commented on','post','post.php?postid=".$_REQUEST['postid']."',now())");
                            $notifyusers=unserialize($row['notifyusers']);
                            $notifyusers=array_diff($notifyusers, array($_SESSION['userid']));
                            $notifyusers1=$notifyusers;
                            array_push($notifyusers1, $row['ruserid']);
                            array_push($notifyusers1, $row['suserid']);
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
                                    $notifications["post.php?postid=".$_REQUEST['postid']]=array("notification"=>  htmlspecialchars($notificationtext,ENT_QUOTES),"read"=>"0","time"=>  time());
                                    mysql_query("update notification set notifications='".serialize($notifications)."' where userid='".$user."'");
                                    
                                }
                            }
                            mysql_query("update status set comments='".  serialize($comments)."',commentcount='".(intval($row['commentcount'])+1)."',notifyusers='".  serialize($notifyusers)."' where statusid='".$_REQUEST['postid']."'");
                            array_push($notifyusers,$_SESSION['userid']);
                            $output=$json->encode(array("status"=>"your comment sucessfully posted"));
                                    }
                                    else
                                     $output=$json->encode(array("status"=>"you do not have permission to comment"));   
                            }   
                    }
                    else if($userpro['type']=='leaf')
                    {
                        $page=getminipro($row['ruserid']);
                        if((($page['canpost']=='public' ||($page['canpost']=='votedusers' && in_array($_SESSION['userid'], $page['votes'])))&& !in_array($_SESSION['userid'], $page['bannedusers'])||  in_array($_SESSION['userid'], $page['admin']) || $_SESSION['userid']==$page['userid']   )){
                            mysql_query("insert into comment(statusid,userid,comment,vote,date) values('".$_REQUEST['postid']."','".$_SESIION['userid']."','".mysql_real_escape_string($_REQUEST['text'])."','a:0:{},now())")
                            $notifyusers=unserialize($row['notifyusers']);
                            $notifyusers=array_diff($notifyusers, array($_SESSION['userid']));
                            $notifyusers1=$notifyusers;
                            array_push($notifyusers1, $row['ruserid']);
                            array_push($notifyusers1, $row['suserid']);
                            $notifyusers=array_merge($notifyusers, $page['admins']);
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
                                    $notifications["post.php?postid=".$_REQUEST['postid']]=array("notification"=>  htmlspecialchars($notificationtext,ENT_QUOTES),"read"=>"0","time"=>  time());
                                    mysql_query("update notification set notifications='".serialize($notifications)."' where userid='".$user."'");
                                    
                                }
                            }
                            array_push($notifyusers,$_SESSION['userid']);
                            mysql_query("update status set comments='".  serialize($comments)."',commentcount='".(intval($row['commentcount'])+1)."',notifyusers='".  serialize($notifyusers)."' where statusid='".$_REQUEST['postid']."'");
                            $output=$json->encode(array("status"=>"your comment sucessfully posted")); 
                        }
                        else
                          $output=$json->encode(array("status"=>"you do not have permission to comment")); 
                    }
                
            }
            
        }
        else
            $output=$json->encode (array("status"=>"your post cannot be blank"));
    }
    else
        $output=$json->encode (array("status","please give the valid information"));
    echo $output;
?>