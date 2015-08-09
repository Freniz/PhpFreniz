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
    if(isset($_SESSION['userid']) && isset($_REQUEST['testyid']))
    {
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select suserid,ruserid,vote from testimonial where testyid='".$_REQUEST['testyid']."'");
        while($row=  mysql_fetch_assoc($result))
        {
            $userpro=getminipro($row['ruserid']);
            $votes=unserialize($row['vote']);
            $votes1=$votes;
            array_push($votes1, $row['ruserid']);
            array_push($votes1, $row['suserid']);
            $votes1=array_diff($votes1,array($_SESSION['userid']));
            $votes1=array_unique($votes1);
            if(!in_array($_SESSION['userid'], $votes))
            {
                array_push($votes, $_SESSION['userid']);
                mysql_query("update testimonial set vote='".serialize($votes)."' where testyid='".$_REQUEST['testyid']."'");
                mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$row['ruserid']."','".$_REQUEST['testyid']."','voted on','admire','admire.php?admireid=".$_REQUEST['testyid']."',now())");
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
                                    if($user==$row['suserid'])
                                    {
                                        $notificationtext.=" your admire on <a href='profile.php?userid=".$row['ruserid']."'>".$userpro['username']."</a>'s chart";
                                    }
                                    else if($user==$row['ruserid'])
                                    {
                                        $notificationtext.=" an admiration of your chart";
                                    }
                                    else
                                    {
                                        $notificationtext.=" <a href='profile.php?userid=".$row['ruserid']."'>".$userpro['username']."</a>'s admire";
                                    }
                                    $notifications["admire.php?blogid=".$_REQUEST['testyid']]=array("notification"=>  htmlspecialchars($notificationtext,ENT_QUOTES),"read"=>"0","time"=>  time());
                                    mysql_query("update notification set notifications='".serialize($notifications)."' where userid='".$user."'");
                    }
                }
                $output=$json->encode(array("status"=>"you have voted to this testy"));
            }
            
        else
            $output=$json->encode(array("status"=> "you are already voted to this testy"));
        }
       mysql_close(); 
    }
    else
        $output=$json->encode(array("status"=> "you don't have permission to vote this testy"));
   echo $output;
   
?>