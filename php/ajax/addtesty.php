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
    if(isset($_SESSION['userid']) && isset($_REQUEST['text']) && isset($_REQUEST['userid'])){
        
            mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
            mysql_select_db("fztest1") or die ("coudnt find database");
            $result=mysql_query("select testy,testyignore,testyvisi,testyspeci,testyhidden,advancedprivacyadmire,autoacceptusers,blockactivityusers from privacy where userid='".$_REQUEST['userid']."'");
            while($row=  mysql_fetch_assoc($result)){
                $ignore=unserialize($row['testyignore']);
                $autoacceptusers=unserialize($row['autoacceptusers']);
                $blockusersactivity=unserialize($row['blockactivityusers']);
                if(($row['testy']=='friends' && !in_array($_REQUEST['userid'], $_SESSION['blocklist'])&& !in_array($_REQUEST['userid'], $_SESSION['blockedby'])&&in_array($_REQUEST['userid'], $_SESSION['friends']) && !in_array($_SESSION['userid'], $ignore))&&($_REQUEST['userid']!=$_SESSION['userid'])){
                    if(sizeof($_REQUEST['text'])>0)
                       {
                        $a=array();
                               if($row['advancedprivacyadmire']=='on' && !in_array($_SESSION['userid'], $blockusersactivity['admire'])){
                                    if(in_array($_SESSION['userid'], $autoacceptusers['admire'])){
                                        mysql_query("insert into testimonial (suserid,ruserid,message,date,vote,pt,specificlist,hiddenlist) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".$_REQUEST['text']."',now(),'".serialize($a)."','".$row['testyvisi']."','".$row['testyspeci']."','".$row['testyhidden']."')");
                                        $updtdid=mysql_insert_id();
                                        mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".$updtdid."','write an admire on','admire','admire.php?admireid=".$updtdid."',now())");
                                        $output=$json->encode(array("status"=>"your testy sucessfully posted"));
                                    }
                                    else{
                                        mysql_query("insert into testimonial (suserid,ruserid,message,date,vote,pt,specificlist,hiddenlist) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".$_REQUEST['text']."',now(),'".serialize($a)."','".$row['testyvisi']."','".$row['testyspeci']."','".$row['testyhidden']."')");
                                        $updtdid=mysql_insert_id();
                                        $result1=mysql_query("select reviews from user_info where userid='".$_REQUEST['userid']."'");
                                        $reviews;$postreviews=array();
                                        while($row1= mysql_fetch_assoc($result1))
                                        {
                                           $reviews=unserialize($row1['reviews']);
                                           if(isset($reviews['admire']))
                                           {
                                               array_push($reviews['admire'], $updtdid);
                                           }
                                           else
                                               {
                                               $reviews['admire']=array($updtdid);
                                           }
                                           mysql_query("update user_info set reviews='".serialize($reviews)."' where userid='".$_REQUEST['userid']."'");
                                           
                                        }
                                        if(isset($_SESSION['reqfrmme']['admire']))
                                        array_push($_SESSION['reqfrmme']['admire'], $updtdid);
                                        else
                                            $_SESSION['reqfrmme']['admire']=array($updtdid);
                                        mysql_query("update user_info set reqfrmme='".serialize($_SESSION['reqfrmme'])."' where userid='".$_SESSION['userid']."'");
                                        $output=$json->encode(array("status"=>"your admire will be posted after ".$_REQUEST['userid']." has reviewed"));
                                    }
                                }
                                else if(!in_array($_SESSION['userid'], $blockusersactivity['admire'])) {
                                    mysql_query("insert into testimonial (suserid,ruserid,message,date,vote,pt,specificlist,hiddenlist) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".$_REQUEST['text']."',now(),'".serialize($a)."','".$row['testyvisi']."','".$row['testyspeci']."','".$row['testyhidden']."')");
                                    $updtdid=mysql_insert_id();
                                    mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".$updtdid."','write an admire on','admire','admire.php?admireid=".$updtdid."',now())");
                                    $output=$json->encode(array("status"=>"your testy sucessfully posted"));
                                }
                                else
                                    $output=$json->encode(array("status"=>"you do not have permission to post"));
        }
        else
            $output=$json->encode (array("status"=>"your testy cannot be blank"));
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