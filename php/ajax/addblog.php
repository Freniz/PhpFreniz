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
    if(isset($_SESSION['userid']) && isset($_REQUEST['text']) && isset($_REQUEST['title']) ){
            mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
            mysql_select_db("fztest1") or die ("coudnt find database");
            $result=mysql_query("select blogvisi,blogspeci,bloghidden from privacy where userid='".$_SESSION['userid']."'");
            while($row=  mysql_fetch_assoc($result)){
            if(sizeof($_REQUEST['text'])>0)
                       {
        $a=array();
if(isset($_REQUEST['imgurl'])){
            mysql_query("insert into blog (userid,blog,date,vote,pt,specificlist,hiddenlist,title,imgurl) values('".$_SESSION['userid']."','".$_REQUEST['text']."',now(),'".serialize($a)."','".$row['blogvisi']."','".$row['blogspeci']."','".$row['bloghidden']."','".$_REQUEST['title']."','".$_REQUEST['imgurl']."')");
            }else{
             mysql_query("insert into blog (userid,blog,date,vote,pt,specificlist,hiddenlist,title) values('".$_SESSION['userid']."','".$_REQUEST['text']."',now(),'".serialize($a)."','".$row['blogvisi']."','".$row['blogspeci']."','".$row['bloghidden']."','".$_REQUEST['title']."')");
       } 
$updtdid=mysql_insert_id();
            mysql_query("insert into activity(userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$_SESSION['userid']."','".$updtdid."','write blog','blog','blog.php?blogid=".$updtdid."',now())");
            $output=$json->encode(array("status"=>"your blog sucessfully updated"));    
            }
        else
            $output=$json->encode (array("status"=>"your blog cannot be blank"));    
        }
        
    }
    else
        $output=$json->encode (array("status","please give the valid information"));
    echo $output;
?>