<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>

<?php
    $output;
    if(isset($_REQUEST['imageid']) && isset($_REQUEST['people']) && isset($_SESSION['userid'])){
        $people=explode(',', $_REQUEST['people']);
        echo addpinnedpeople($_REQUEST['imageid'], $people);
    }

    function addpinnedpeople($imageid,$people)
    {
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select albumid,reqpinusers,pinmereq,pinnedpeople from image where imageid='".$imageid."'");
        if($row=  mysql_fetch_assoc($result))
        {
            $albumid=$row['albumid'];
            $pinnedpeople=unserialize($row['pinnedpeople']);
            $reqpinusers=unserialize($row['reqpinusers']);
            $result1=mysql_query("select userid from album where albumid='".$albumid."'");
            while($row1=  mysql_fetch_assoc($result1)){
                if(strcasecmp($row1['userid'],$_SESSION['userid'])==0){
                    foreach($people as $user){
                        if((in_array($user, $_SESSION['friends']) && !in_array($user, $_SESSION['blocklist']) && !in_array($user, $_SESSION['blockedby']) && !in_array($user, $pinnedpeople) && !in_array($user, unserialize($row['reqpinusers'])) && !in_array($user, unserialize($row['pinmereq']))))
                        {
                            $result2=mysql_query("select advancedprivacypin,autoacceptusers,blockactivityusers from privacy where userid='".$user."'");
                            while($row2=  mysql_fetch_assoc($result2)){
                                $autoacceptusers=unserialize($row2['autoacceptusers']);
                                $blockusersactivity=unserialize($row2['blockactivityusers']);
                                if($row2['advancedprivacypin']=='on' && !in_array($_SESSION['userid'], $blockusersactivity['pin'])){
                                    if(in_array($_SESSION['userid'], $autoacceptusers['pin'])){
                                        array_push($pinnedpeople, $user);
                                        $result4=mysql_query("select pinnedpic from user_info where userid='".$user."'");
                                        if($row4=  mysql_fetch_assoc($result4))
                                        {
                                            $pinnedpic=unserialize($row4['pinnedpic']);
                                            if(!in_array($imageid, $pinnedpic))
                                                array_push ($pinnedpic, $imageid);
                                            mysql_query("update user_info set pinnedpic='".serialize($pinnedpic)."' where userid='".$user."'");
                                        }
                                    }
                                    else{
                                        array_push($reqpinusers, $user);
                                        $result4=mysql_query("select reviews from user_info where userid='".$user."'");
                                        $reviews;$postreviews=array();
                                        while($row4= mysql_fetch_assoc($result4))
                                        {
                                           $reviews=unserialize($row4['reviews']);
                                           if(isset($reviews['pinnedpics']))
                                           {
                                               array_push($reviews['pinnedpics'], $imageid);
                                           }
                                           else
                                               {
                                               $reviews['pinnedpics']=array($imageid);
                                           }
                                           mysql_query("update user_info set reviews='".serialize($reviews)."' where userid='".$user."'");
                                           
                                        }
                                    }
                                }
                                else if(!in_array($_SESSION['userid'], $blockusersactivity['pin'])){
                                    array_push($pinnedpeople, $user);
                                        $result4=mysql_query("select pinnedpic from user_info where userid='".$user."'");
                                        if($row4=  mysql_fetch_assoc($result4))
                                        {
                                            $pinnedpic=unserialize($row4['pinnedpic']);
                                            if(!in_array($imageid, $pinnedpic))
                                                array_push ($pinnedpic, $imageid);
                                            mysql_query("update user_info set pinnedpic='".serialize($pinnedpic)."' where userid='".$user."'");
                                        }
                                }
                            }
                        }
                    }
                    mysql_query("update image set pinnedpeople='".  serialize($pinnedpeople)."' where imageid='".$imageid."'");
                    mysql_query("update image set reqpinusers='".  serialize($reqpinusers)."' where imageid='".$imageid."'");
                    
                }
            }
            
                                        
            return json_encode(array("status"=>"people pinned to this pic sucessfully"));
        }
        else 
            return json_encode(array("status"=>"error occured while pinning this pic please try again later"));
    }
?>