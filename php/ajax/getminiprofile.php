<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function getminipro($user) {
    $minipro=array();
    if($_SESSION['userid']==$user)
    {
        $minipro=array("userid"=>$_SESSION['userid'],"username"=>$_SESSION['username'],"propic"=>  imageurl($_SESSION['propic']),"friends"=>$_SESSION['friends'],"votes"=>$_SESSION['votes'],"mood"=>$_SESSION['mood'],"url"=>$_SESSION['url'],"type"=>$_SESSION['type'],"sex"=>$_SESSION['sex']);
        
    }
    else{
        $result=mysql_query("select type from freniz where userid='".$user."'");
        while($row=  mysql_fetch_assoc($result))
        {
            if($row['type']=='user')
            {
                $result1=mysql_query("select fname,lname,propic,mood,url,sex from user_info where userid='".$user."'");
                while($row1=  mysql_fetch_assoc($result1))
                {
                    $username=$row1['fname']." ".$row1['lname'];
                    $propic=$row1['propic'];
                    $results2=mysql_query("select friendlist,vote from friends_vote where userid='".$user."'");
                    while($row2=  mysql_fetch_assoc($results2))
                    {
                        $minipro=array("userid"=>$user,"username"=>$username,"propic"=>imageurl($propic),"friends"=>unserialize($row2['friendlist']),"votes"=>unserialize($row2['vote']),"mood"=>$row1['mood'],"url"=>$row1['url'],"type"=>'user',"sex"=>$row1['sex']);
                    }
                }
            }
            else if($row['type']=='page')
            {
                $result1=mysql_query("select pagename,pagepic,vote,bannedusers,canpost,url,admins,creator from pages where pageid='".$user."'");
                while($row1=  mysql_fetch_assoc($result1))
                {
                    $minipro=array("userid"=>$user,"username"=>$row1['pagename'],"propic"=>imageurl($row1['pagepic']),"friends"=>array(),"votes"=>unserialize($row1['vote']),"bannedusers"=>  unserialize($row1['bannedusers']),"canpost"=>$row1['canpost'],"url"=>$row1['url'],"admins"=>  unserialize($row1['admins']),"type"=>'leaf',"sex"=>"leaf","creator"=>$row1['creator']);
                }
            }
        }
    }
    return $minipro;
}

function imageurl($imageid)
{
    $result=mysql_query("select url from image where imageid='".$imageid."'");
    while($row=  mysql_fetch_assoc($result))
    {
        return $row['url'];
    }
}
function getimageprivacy($imageid)
{
    $result=mysql_query("select userid,pt,specificlist,hiddenlist,url from image where imageid='".$imageid."'");
    while($row=  mysql_fetch_assoc($result)){
        return $row;
    }
}
?>
