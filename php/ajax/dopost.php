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
    if(isset($_SESSION['userid']) && isset($_REQUEST['text']) && isset($_REQUEST['userid']) && isset($_REQUEST['type'])){
          mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
            mysql_select_db("fztest1") or die ("coudnt find database");
            if($_REQUEST['type']=='user'){
            $result=mysql_query("select post,postignore,postvisi,postspeci,posthidden,advancedprivacypost,autoacceptusers,blockactivityusers from privacy where userid='".$_REQUEST['userid']."'");
            while($row=  mysql_fetch_assoc($result)){
                $ignore=unserialize($row['postignore']);
                $autoacceptusers=unserialize($row['autoacceptusers']);
                $blockusersactivity=unserialize($row['blockactivityusers']);
                if(($row['post']=='friends' && !in_array($_REQUEST['userid'], $_SESSION['blocklist'])&& !in_array($_REQUEST['userid'], $_SESSION['blockedby'])&&in_array($_REQUEST['userid'], $_SESSION['friends']) && !in_array($_SESSION['userid'], $ignore))||($_REQUEST['userid']==$_SESSION['userid'])){
                    if(strlen($_REQUEST['text'])>0)
                       {
                            $a=array();
                            if($_SESSION['userid']!=$_REQUEST['userid']){
                                if($row['advancedprivacypost']=='on' && !in_array($_SESSION['userid'], $blockusersactivity['post'])){
                                    if(in_array($_SESSION['userid'], $autoacceptusers['post'])){
                                        mysql_query("insert into status (suserid,ruserid,status,date,vote,pt,specificlist,hiddenlist,notifyusers,comments,accepted) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".mysql_real_escape_string($_REQUEST['text'])."',now(),'".serialize($a)."','".$row['postvisi']."','".$row['postspeci']."','".$row['posthidden']."','".  serialize($a)."','a:0:{}','yes')");
                                        $updtdid=mysql_insert_id();
                                        $b=array($_SESSION['userid']);
                                        mysql_query("insert into activity (userid,ruserid,contentid,title,contenttype,contenturl,date) values ('".$_SESSION['userid']."','".$_REQUEST['userid']."','".$updtdid."','posted on','post','post.php?postid=".$updtdid."',now())");
                                        $output=$json->encode(array("status"=>"your post sucessfully posted"));
                                    }
                                    else{
                                        mysql_query("insert into status (suserid,ruserid,status,date,vote,pt,specificlist,hiddenlist,notifyusers,comments) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".mysql_real_escape_string($_REQUEST['text'])."',now(),'".serialize($a)."','".$row['postvisi']."','".$row['postspeci']."','".$row['posthidden']."','".  serialize($a)."','a:0:{}')");
                                        $updtdid=mysql_insert_id();
                                        $result1=mysql_query("select reviews from user_info where userid='".$_REQUEST['userid']."'");
                                        $reviews;$postreviews=array();
                                        while($row1= mysql_fetch_assoc($result1))
                                        {
                                           $reviews=unserialize($row1['reviews']);
                                           if(isset($reviews['post']))
                                           {
                                               array_push($reviews['post'], $updtdid);
                                           }
                                           else
                                               {
                                               $reviews['post']=array($updtdid);
                                           }
                                           mysql_query("update user_info set reviews='".serialize($reviews)."' where userid='".$_REQUEST['userid']."'");
                                           
                                        }
                                        if(isset($_SESSION['reqfrmme']['post']))
                                        array_push($_SESSION['reqfrmme']['post'], $updtdid);
                                        else
                                            $_SESSION['reqfrmme']['post']=array($updtdid);
                                        mysql_query("update user_info set reqfrmme='".serialize($_SESSION['reqfrmme'])."' where userid='".$_SESSION['userid']."'");
                                        $output=$json->encode(array("status"=>"your post will be posted after ".$_REQUEST['userid']." has reviewed    $updtdid"));
                                    }
                                }
                                else if(!in_array($_SESSION['userid'], $blockusersactivity['post'])){
                                    mysql_query("insert into status (suserid,ruserid,status,date,vote,pt,specificlist,hiddenlist,notifyusers,comments,accepted) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".mysql_real_escape_string($_REQUEST['text'])."',now(),'".serialize($a)."','".$row['postvisi']."','".$row['postspeci']."','".$row['posthidden']."','".  serialize($a)."','a:0:{}','yes')");
                                    
                            $updtdid=mysql_insert_id();
                            $b=array($_SESSION['userid']);
                            mysql_query("insert into activity (userid,ruserid,contentid,title,contenttype,contenturl,date) values ('".$_SESSION['userid']."','".$_REQUEST['userid']."','".$updtdid."','posted on','post','post.php?postid=".$updtdid."',now())");
                            $output=$json->encode(array("status"=>"your post sucessfully posted"));
                            }
                            else
                                $ouput=json_encode(array("status"=>"you do not have permission to post"));
                            }
                            else{
                            mysql_query("insert into status (suserid,ruserid,status,date,vote,pt,specificlist,hiddenlist,notifyusers,comments,accepted) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".mysql_real_escape_string($_REQUEST['text'])."',now(),'".serialize($a)."','".$row['postvisi']."','".$row['postspeci']."','".$row['posthidden']."','".  serialize($a)."','a:0:{}','yes')");
                            $updtdid=mysql_insert_id();
                            $b=array($_SESSION['userid']);
                            mysql_query("insert into activity (userid,ruserid,contentid,title,contenttype,contenturl,date) values ('".$_SESSION['userid']."','".$_REQUEST['userid']."','".$updtdid."','posted on','post','post.php?postid=".$updtdid."',now())");
                            $output=$json->encode(array("status"=>"your post sucessfully posted"));
                            }
                        }
            
                    else
                        $output=$json->encode (array("status"=>"your post cannot be blank"));
                   }
                    else{
                        $output=$json->encode(array("status"=>"you do not have permission to post"));
                    }
                }
            }
    else if($_REQUEST['type']=='leaf'){
        $page=getminipro($_REQUEST['userid']);
            if((($page['canpost']=='public' || ($page['canpost']=='votedusers' && in_array($_SESSION['userid'], $page['votes'])))&&!in_array($_SESSION['userid'], $page['bannedusers']) )|| $_SESSION['userid']==$_REQUEST['userid'] ){
                if(sizeof($_REQUEST['text'])>0)
                       {
                            $a=array();
                            mysql_query("insert into status (suserid,ruserid,status,date,vote,pt,specificlist,hiddenlist,notifyusers,comments,accepted) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".mysql_real_escape_string($_REQUEST['text'])."',now(),'".serialize($a)."','public','".serialize($a)."','".serialize($a)."','".serialize($a)."','a:0:{}','yes')");
                            $output=$json->encode(array("status"=>"your post sucessfully posted"));
                        }
            
                    else
                        $output=$json->encode (array("status"=>"your post cannot be blank"));
            }
            else{
                        $output=$json->encode(array("status"=>"you do not have permission to post"));
                    }
        }
    }
    else
        $output=$json->encode (array("status"=>"please give the valid information"));
    echo $output;
?>