<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>
<?php 
    require_once ('json/JSON.php');
    $json = new Services_JSON();
    $output;
    if(isset($_SESSION['userid']) && isset($_REQUEST['title']) && isset($_REQUEST['embeddcode']) && isset($_REQUEST['userid'])){
        
            mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
            mysql_select_db("fztest1") or die ("coudnt find database");
            $result=mysql_query("select video,videoignore,videovisi,videospeci,videohidden,advancedprivacyvideo,autoacceptusers,blockactivityusers from privacy where userid='".$_REQUEST['userid']."'");
            while($row=  mysql_fetch_assoc($result)){
                $ignore=unserialize($row['videoignore']);
                $autoacceptusers=unserialize($row['autoacceptusers']);
                $blockusersactivity=unserialize($row['blockactivityusers']);
                if(($row['video']=='friends' && !in_array($_REQUEST['userid'], $_SESSION['blocklist'])&& !in_array($_REQUEST['userid'], $_SESSION['blockedby'])&&in_array($_REQUEST['userid'], $_SESSION['friends']) && !in_array($_SESSION['userid'], $ignore))||($_REQUEST['userid']==$_SESSION['userid'])){
                    if(sizeof($_REQUEST['embeddcode'])>0)
                       {
                        $a=array();
                               if(($row['advancedprivacyvideo']=='on' && !in_array($_SESSION['userid'], $blockusersactivity['video']))||$_SESSION['userid']==$_REQUEST['userid']){
                                    if(in_array($_SESSION['userid'], $autoacceptusers['video'])||$_SESSION['userid']==$_REQUEST['userid']){
                                        mysql_query("insert into video (suserid,ruserid,title,embeddcode,date,vote,pt,specificlist,hiddenlist,accepted) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".$_REQUEST['title']."','".$_REQUEST['embeddcode']."',now(),'".serialize($a)."','".$row['videovisi']."','".$row['videospeci']."','".$row['videohidden']."','yes')");
                                        $updtdid=mysql_insert_id();
                                        mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".$updtdid."','post a video on','video','video.php?videoid=".$updtdid."',now())");
                                        $output=$json->encode(array("status"=>"your video sucessfully posted"));
                                    }
                                    else{
                                        mysql_query("insert into video (suserid,ruserid,title,embeddcode,date,vote,pt,specificlist,hiddenlist) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".$_REQUEST['title']."','".$_REQUEST['embeddcode']."',now(),'".serialize($a)."','".$row['videovisi']."','".$row['videospeci']."','".$row['videohidden']."')");
                                        $updtdid=mysql_insert_id();
                                        $result1=mysql_query("select reviews from user_info where userid='".$_REQUEST['userid']."'");
                                        $reviews;$videoreviews=array();
                                        while($row1= mysql_fetch_assoc($result1))
                                        {
                                           $reviews=unserialize($row1['reviews']);
                                           if(isset($reviews['video']))
                                           {
                                               array_push($reviews['video'], $updtdid);
                                           }
                                           else
                                               {
                                               $reviews['video']=array($updtdid);
                                           }
                                           mysql_query("update user_info set reviews='".serialize($reviews)."' where userid='".$_REQUEST['userid']."'");
                                           
                                        }
                                        if(isset($_SESSION['reqfrmme']['video']))
                                        array_push($_SESSION['reqfrmme']['video'], $updtdid);
                                        else
                                            $_SESSION['reqfrmme']['video']=array($updtdid);
                                        mysql_query("update user_info set reqfrmme='".serialize($_SESSION['reqfrmme'])."' where userid='".$_SESSION['userid']."'");
                                        $output=$json->encode(array("status"=>"your video will be posted after ".$_REQUEST['userid']." has reviewed"));
                                    }
                                }
                                else if(!in_array($_SESSION['userid'], $blockusersactivity['video'])) {
                                    mysql_query("insert into video (suserid,ruserid,title,embeddcode,date,vote,pt,specificlist,hiddenlist) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".$_REQUEST['title']."','".$_REQUEST['embeddcode']."',now(),'".serialize($a)."','".$row['videovisi']."','".$row['videospeci']."','".$row['videohidden']."')");
                                    $updtdid=mysql_insert_id();
                                    mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".$updtdid."','post a video on','video','video.php?videoid=".$updtdid."',now())");
                                    $output=$json->encode(array("status"=>"your video sucessfully posted"));
                                }
                                else
                                    $output=$json->encode(array("status"=>"you do not have permission to post"));
        }
        else
            $output=$json->encode (array("status"=>"your embeddcode cannot be blank"));
        }
        else{
                        $output=$json->encode(array("status"=>"you do not have permission to post"));
                    }
            }
            }
    else
        $output=$json->encode (array("status","please give the valid information"));
    echo $output;
?>