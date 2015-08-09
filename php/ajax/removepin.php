<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>
<?php
    $output;
    if(isset($_REQUEST['imageid']) && isset($_REQUEST['userid']) && isset($_SESSION['userid'])){
        
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select pinnedpeople,userid from image where imageid='".$_REQUEST['imageid']."'");
        if($row=  mysql_fetch_assoc($result))
        {
            if($row['userid']==$_SESSION['userid'] || $_REQUEST['userid']==$_SESSION['userid'])
            {
                $pinnedpeople=unserialize($row['pinnedpeople']);
                $pinnedpeople=array_diff($pinnedpeople, array($_REQUEST['userid']));
                mysql_query("update image set pinnedpeople='".serialize($pinnedpeople)."' where imageid='".$_REQUEST['imageid']."'");
                $result2=mysql_query("select pinnedpic from user_info where userid='".$_REQUEST['userid']."'");
                    if($row2=mysql_fetch_assoc($result2))
                    {
                        $pinnedpics=unserialize($row2['pinnedpic']);
                        $pinnedpics=array_diff($pinnedpics, array($_REQUEST['imageid']));
                        mysql_query("update user_info set pinnedpic='".serialize($pinnedpics)."' where userid='".$_REQUEST['userid']."'");
                        $output=json_encode(array("status"=> "user unpinned from this pic sucessfully"));
                    }
                    else
                        $output=json_encode(array("status"=> "error occured while pinning this pic please try again later"));
            }
            else
                $output=json_encode(array("status"=> "you dont have permission to remove pin for this user or this picture"));
        }
        else
            $output=json_encode(array("status"=> "image not found"));
    }
    else
        $output=json_encode(array("status"=> "please provide valid informations"));
    echo $output;
?>