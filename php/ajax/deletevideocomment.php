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
    if(isset($_REQUEST['commentid']) && isset($_SESSION['userid'])){
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select videoid,userid from video_comments where commentid='".$_REQUEST['commentid']."'");
        while($row=  mysql_fetch_assoc($result))
        {
        	$result1=mysql_query("select suserid,ruserid,commentcount from video where videoid='".$row['videoid']."'");
        	while($row1=mysql_fetch_assoc($result1)){
                if($row1['ruserid']==$_SESSION['userid'] || $row1['suserid']==$_SESSION['userid'] || $row['userid']==$_SESSION['userid']){
                    mysql_query("delete from comment where commentid='".$_REQUEST['commentid']."'");
                mysql_query("delete from activity where userid='".$_SESSION['userid']."' and contentid='".$row['videoid']."' and contenttype='video' and title='commented on'");
                mysql_query("update video set commentcount='".(intval($row1['commentcount'])-1)."' where videoid='".$row['videoid']."'");
                }
            }
                    else
                        $output=$json->encode(array("status"=>"you dont have permission to delete this comment"));
             
            
        }
        mysql_close();
        
    }
    else
        $output=$json->encode(array("status"=>"please give valid information for this operation"));
    echo $output;
?>