<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once '../classes/Images.php';
?>
<?php $status;
    if(isset($_SESSION['userid'])&&isset($_REQUEST['type'])&&isset($_REQUEST['action']))
    {
            mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
            mysql_select_db("fztest1") or die ("coudnt find database");
            $result=mysql_query("select reviews from user_info where userid='".$_SESSION['userid']."'");
            while($row=  mysql_fetch_assoc($result)){
                $reviews=unserialize($row['reviews']);
                $imgs=new Images();
                if($_REQUEST['action']=='accept'){
                switch ($_REQUEST['type']) {
                    case 'pinnedpics':
                        if(isset($_REQUEST['ids']) && isset($reviews['pinnedpics'])){
                            $imageids=explode(',', $_REQUEST['ids']);
                            $imageids=array_intersect($imageids, $reviews['pinnedpics']);
                            if(count($imageids)!=0)
                            $imgs->approvepinreview($imageids);
                            $reviews['pinnedpics']=array_diff($reviews['pinnedpics'], $imageids);
                        }
                        else if(isset($reviews['pinnedpics']) && count($reviews['pinnedpics'])!=0){
                           $imgs->approvepinreview($reviews['pinnedpics']);
                           $reviews['pinnedpics']=array();
                        }

                        break;
                        case 'images':
                            if(isset($reviews['image'])&& isset($_REQUEST['ids'])){
                                $imageids=explode(',', $_REQUEST['ids']);
                            $imageids=array_intersect($imageids, $reviews['image']);
                            if(count($imageids)!=0)
                            $imgs->approveimages ($imageids);
                            $reviews['image']=array_diff($reviews['image'], $imageids);
                            }
                            else if(isset($reviews['image']) && count($reviews['image'])!=0){
                           $imgs->approvepinreview($reviews['image']);
                           $reviews['image']=array();
                        }
                            break;
                       case 'posts':
                           if(isset($reviews['post'])&& isset($_REQUEST['ids'])){
                                $postids=explode(',', $_REQUEST['ids']);
                            $postids=array_intersect($postids, $reviews['post']);
                            $query1="select statusid,suserid,ruserid from status where ";
                            $i=0;
                            foreach($postids as $id){
                                $i++;
                                if($i!=count($postids))
                                    $query1.=" statusid='".$id."' or ";
                                else {
                                    $query1.=" statusid='$id'";
                                }
                            }
                            if(count($postids)>0){
                            $result1=mysql_query($query1);
                            while($row1=  mysql_fetch_assoc($result1))
                            {
                                mysql_query("insert into activity (userid,ruserid,contentid,title,contenttype,contenturl,date) values ('".$row1['suserid']."','".$row1['ruserid']."','".$row1['statusid']."','posted on','post','post.php?postid=".$row1['statusid']."',now())");
                                mysql_query ("update status set accepted='yes' where statusid='".$row1['statusid']."'");
                            }
                            }
                            $reviews['post']=array_diff($reviews['post'], $postids);
                            }
                            else if(isset($reviews['post']) && count($reviews['post'])!=0){
                               $query1="select statusid,suserid,ruserid from status where ";
                            $i=0;
                            foreach($reviews['post'] as $id){
                                $i++;
                                if($i!=count($postids))
                                    $query1.=" statusid='".$id."' or ";
                                else {
                                    $query1.=" statusid='$id'";
                                }
                            }
                            if(count($reviews['post'])>0){
                            $result1=mysql_query($query1);
                            while($row1=  mysql_fetch_assoc($result1))
                            {
                                mysql_query("insert into activity (userid,ruserid,contentid,title,contenttype,contenturl,date) values ('".$row1['suserid']."','".$row1['ruserid']."','".$row1['statusid']."','posted on','post','post.php?postid=".$row1['statusid']."',now())");
                                mysql_query ("update status set accepted='yes' where statusid='".$row1['statusid']."'");
                            }
                            } $reviews['post']=array();
                             }
                            break;
                       case 'video':
                           if(isset($reviews['video'])&& isset($_REQUEST['ids'])){
                                $postids=explode(',', $_REQUEST['ids']);
                            $postids=array_intersect($postids, $reviews['video']);
                            $query1="select videoid,suserid,ruserid from video where ";
                            $i=0;
                            foreach($postids as $id){
                                $i++;
                                if($i!=count($postids))
                                    $query1.=" videoid='".$id."' or ";
                                else {
                                    $query1.=" videoid='$id'";
                                }
                            }
                            if(count($postids)>0){
                            $result1=mysql_query($query1);
                            while($row1=  mysql_fetch_assoc($result1))
                            {
                                mysql_query("insert into activity (userid,ruserid,contentid,title,contenttype,contenturl,date) values ('".$row1['suserid']."','".$row1['ruserid']."','".$row1['videoid']."','posted on','video','video.php?videoid=".$row1['videoid']."',now())");
                                mysql_query ("update video set accepted='yes' where videoid='".$row1['statusid']."'");
                            }
                            }
                            $reviews['video']=array_diff($reviews['video'], $postids);
                            }
                            else if(isset($reviews['video']) && count($reviews['video'])!=0){
                               $query1="select videoid,suserid,ruserid from video where ";
                            $i=0;
                            foreach($reviews['video'] as $id){
                                $i++;
                                if($i!=count($postids))
                                    $query1.=" videoid='".$id."' or ";
                                else {
                                    $query1.=" videoid='$id'";
                                }
                            }
                            if(count($reviews['video'])>0){
                            $result1=mysql_query($query1);
                            while($row1=  mysql_fetch_assoc($result1))
                            {
                                mysql_query("insert into activity (userid,ruserid,contentid,title,contenttype,contenturl,date) values ('".$row1['suserid']."','".$row1['ruserid']."','".$row1['videoid']."','posted on','video','video.php?videoid=".$row1['videoid']."',now())");
                                mysql_query ("update status set accepted='yes' where statusid='".$row1['statusid']."'");
                            }
                            } $reviews['video']=array();
                             }
                            break;
                            
                        case 'admires':
                            if(isset($reviews['admire'])&& isset($_REQUEST['ids'])){
                                $postids=explode(',', $_REQUEST['ids']);
                            $postids=array_intersect($postids, $reviews['admire']);
                            $query1="select testyid,suserid,ruserid from testimonial where ";
                            $i=0;
                            foreach($postids as $id){
                                $i++;
                                if($i!=count($postids))
                                    $query1.=" testyid='".$id."' or ";
                                else {
                                    $query1.=" testyid='$id'";
                                }
                            }
                            if(count($postids)>0){
                            $result1=mysql_query($query1);
                            while($row1=  mysql_fetch_assoc($result1))
                            {
                                mysql_query("insert into activity (userid,ruserid,contentid,title,contenttype,contenturl,date) values ('".$row1['suserid']."','".$row1['ruserid']."','".$row1['testyid']."','write an admire on','admire','admire.php?admireid=".$row1['testyid']."',now())");
                                mysql_query ("update testimonial set accpeted='yes' where testyid='".$row1['testyid']."'");
                            }
                            }
                            $reviews['admire']=array_diff($reviews['admire'], $postids);
                            }
                            else if(isset($reviews['admire']) && count($reviews['admire'])!=0){
                           $query1="select testyid,suserid,ruserid from testimonial where ";
                            $i=0;
                            foreach($reviews['admire'] as $id){
                                $i++;
                                if($i!=count($reviews['admire']))
                                    $query1.=" testyid='".$id."' or ";
                                else {
                                    $query1.=" testyid='$id'";
                                }
                            }
                            if(count($reviews['admire'])>0){
                            $result1=mysql_query($query1);
                            while($row1=  mysql_fetch_assoc($result1))
                            {
                                mysql_query("insert into activity (userid,ruserid,contentid,title,contenttype,contenturl,date) values ('".$row1['suserid']."','".$row1['ruserid']."','".$row1['testyid']."','write an admire on','admire','admire.php?admireid=".$row1['testyid']."',now())");
                                mysql_query ("update testimonial set accepted='yes' where testyid='".$row1['statusid']."'");
                            }
                            }
                            $reviews['admire']=array();
                        }
                            break;    
                        case 'otherpinreqs':
                            if(isset($reviews['otherpinreq']) && isset($_REQUEST['userids']) && isset($_REQUEST['imageid']) && isset($reviews['otherpinreq'][$_REQUEST['imageid']])){
                                $userids=explode(',', $_REQUEST['userids']);
                                $userids=array_intersect($reviews['otherpinreq'][$_REQUEST['imageid']], $userids);
                                if(count($userids)>0)
                                    $imgs->approveOtherPinReq ($userids, $_REQUEST['imageid']);
                                $reviews['otherpinreq'][$_REQUEST['imageid']]=array_diff($reviews['otherpinreq'][$_REQUEST['imageid']], $userids);
                                if(count($reviews['otherpinreq'][$_REQUEST['imageid']])==0)
                                    unset ($reviews['otherpinreq'][$_REQUEST['imageid']]);
                            }
                            else if(isset($reviews['otherpinreq']) && isset($_REQUEST['imageid']) && isset($reviews['otherpinreq'][$_REQUEST['imageid']]) && count($reviews['otherpinreq'][$_REQUEST['imageid']])>0 ){
                                $imgs->approveOtherPinReq($reviews['otherpinreq'][$_REQUEST['imageid']], $_REQUEST['imageid']);
                                unset($reviews['otherpinreq']['imageid']);
                            }
                            break;
                    default:
                        break;
                }
                }
                else if($_REQUEST['action']=='deny'){
                switch ($_REQUEST['type']) {
                    case 'pinnedpics':
                        if(isset($_REQUEST['ids']) && isset($reviews['pinnedpics'])){
                            $imageids=explode(',', $_REQUEST['ids']);
                            $imageids=array_intersect($imageids, $reviews['pinnedpics']);
                            if(count($imageids)!=0)
                            $imgs->denypinreview($imageids);
                            $reviews['pinnedpics']=array_diff($reviews['pinnedpics'], $imageids);
                        }
                        else if(isset($reviews['pinnedpics']) && count($reviews['pinnedpics'])!=0){
                           $imgs->denypinreview($reviews['pinnedpics']);
                           $reviews['pinnedpics']=array();
                        }

                        break;
                        case 'images':
                            if(isset($reviews['image'])&& isset($_REQUEST['ids'])){
                                $imageids=explode(',', $_REQUEST['ids']);
                            $imageids=array_intersect($imageids, $reviews['image']);
                            if(count($imageids)!=0)
                            $imgs->denyimages ($imageids);
                            $reviews['image']=array_diff($reviews['image'], $imageids);
                            }
                            else if(isset($reviews['image']) && count($reviews['image'])!=0){
                           $imgs->denyimages($reviews['image']);
                           $reviews['image']=array();
                        }
                            break;
                       case 'posts':
                            if(isset($reviews['post'])&& isset($_REQUEST['ids'])){
                                $postids=explode(',', $_REQUEST['ids']);
                            $postids=array_intersect($postids, $reviews['post']);
                            foreach($postids as $id)
                                mysql_query ("delete from status where statusid='$id'");
                             $reviews['post']=array_diff($reviews['post'], $postids);
                            }
                            else if(isset($reviews['post']) && count($reviews['post'])!=0){
                           foreach($reviews['post'] as $id)
                                mysql_query ("delete from status where statusid='$id'");
                            $reviews['post']=array();
                        }
                            break;
                            
                        case 'admires':
                            if(isset($reviews['admire'])&& isset($_REQUEST['ids'])){
                                $postids=explode(',', $_REQUEST['ids']);
                            $postids=array_intersect($postids, $reviews['admire']);
                            foreach($postids as $id)
                                mysql_query ("delete from testimonial where testyid='$id'");
                             $reviews['admire']=array_diff($reviews['admire'], $postids);
                            }
                            else if(isset($reviews['admire']) && count($reviews['admire'])!=0){
                           foreach($reviews['post'] as $id)
                                mysql_query ("delete from testimonial where testyid='$id'");
                            $reviews['admire']=array();
                        }
                            break;    
                        case 'otherpinreqs':
                            if(isset($reviews['otherpinreq']) && isset($_REQUEST['userids']) && isset($_REQUEST['imageid']) && isset($reviews['otherpinreq'][$_REQUEST['imageid']])){
                                $userids=explode(',', $_REQUEST['userids']);
                                $userids=array_intersect($reviews['otherpinreq'][$_REQUEST['imageid']], $userids);
                                if(count($userids)>0)
                                    $imgs->denyOtherPinReq ($userids, $_REQUEST['imageid']);
                                $reviews['otherpinreq'][$_REQUEST['imageid']]=array_diff($reviews['otherpinreq'][$_REQUEST['imageid']], $userids);
                                if(count($reviews['otherpinreq'][$_REQUEST['imageid']])==0)
                                    unset ($reviews['otherpinreq'][$_REQUEST['imageid']]);
                            }
                            else if(isset($reviews['otherpinreq']) && isset($_REQUEST['imageid']) && isset($reviews['otherpinreq'][$_REQUEST['imageid']]) && count($reviews['otherpinreq'][$_REQUEST['imageid']])>0 ){
                                $imgs->denyOtherPinReq($reviews['otherpinreq'][$_REQUEST['imageid']], $_REQUEST['imageid']);
                                unset($reviews['otherpinreq']['imageid']);
                            }
                            break;    
                    default:
                        break;
                }    
                }
                mysql_query("update user_info set reviews='".serialize($reviews)."' where userid='".$_SESSION['userid']."'");
                echo json_encode(array("status"=>"success"));
            }
            
    }

?>