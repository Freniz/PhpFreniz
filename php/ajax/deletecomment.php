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
    if(isset($_REQUEST['commentid']) && isset($_REQUEST['postid']) && isset($_SESSION['userid'])){
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select statusid,suserid,ruserid,comments,commentcount from comment where statusid='".$_REQUEST['postid']."'");
        while($row=  mysql_fetch_assoc($result))
        {
            $comments=unserialize($row['comments']);
            if(isset($comments[$_REQUEST['commentid']])){
                if($row['ruserid']==$_SESSION['userid'] || $row['suserid']==$_SESSION['userid'] || $comments[$_REQUEST['commentid']]['userid']==$_SESSION['userid']){
                    mysql_query("delete from comment where commentid='".$_REQUEST['commentid']."'");
                mysql_query("delete from activity where userid='".$_SESSION['userid']."' and contentid='".$row['statusid']."' and contenttype='post' and title='commented on'");
                mysql_query("update status set commentcount='".(intval($row['commentcount'])-1)."' where statusid='".$row['statusid']."'");
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