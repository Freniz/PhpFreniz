<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$output=  json_encode(array("success"=>"false"));
if(isset($_REQUEST['pageid']) && isset($_REQUEST['category']) && isset($_REQUEST['action']) && isset($_SESSION['userid']))
{
    $pages=$_SESSION[$_REQUEST['category']];
    if(!in_array($_REQUEST['pageid'], $pages) && $_REQUEST['action']=='add'){
        array_push ($pages, $_REQUEST['pageid']);
        update($pages,$_REQUEST['pageid'],$_SESSION['userid']);
        $_SESSION[$_REQUEST['category']]=$pages;
        $output=json_encode(array("success"=> "true"));    
    }
    elseif (in_array($_REQUEST['pageid'], $pages) && $_REQUEST['action']=='remove') {
        $pages=array_diff($pages,array($_REQUEST['pageid']));
        update($pages,$_REQUEST['pageid'],$_SESSION['userid']);
        $_SESSION[$_REQUEST['category']]=$pages;
        $output=json_encode(array("success"=> "true"));    
    }
            
}
 else {
    $output=json_encode(array("success"=> "false"));    
}
echo $output;
function update($pages,$pageid,$userid){
    mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
    mysql_select_db("fztest1") or die ("coudnt find database");
    if($_REQUEST['category']=='school' || $_REQUEST['category']=='college' || $_REQUEST['category']=='employer'){
        mysql_query("delete from activity where userid='".$_SESSION['userid']."' and ruserid='".$_SESSION['userid']."' and contenttype='education info' and contenturl='educationinfo.php'");
         mysql_query("insert into activity (userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$_SESSION['userid']."','".$_SESSION['userid']."','update education info','education info','educationinfo.php',now())");
           
    }
   elseif($_REQUEST['category']=='language'){
        mysql_query("delete from activity where userid='".$_SESSION['userid']."' and ruserid='".$_SESSION['userid']."' and contenttype='language info' and contenturl='languageinfo.php'");
         mysql_query("insert into activity (userid,ruserid,contentid,title,contenttype,contenturl,date) values('".$_SESSION['userid']."','".$_SESSION['userid']."','".$_SESSION['userid']."','update language info','language info','languageinfo.php',now())");
         
    }
    mysql_query("update user_info set ".$_REQUEST['category']." ='".serialize($pages)."' where userid='".$_SESSION['userid']."'");
    $result=mysql_query("select vote from pages where pageid='".$pageid."'");
    while($row=  mysql_fetch_assoc($result)){
        $votes=unserialize($row['vote']);
        if($_REQUEST['action']=='add')
            array_push($votes,$userid);
        elseif($_REQUEST['action']=='remove')
            $votes=array_diff ($votes, array($userid));
        $votes=array_unique($votes);
        mysql_query("update pages set vote='".serialize($votes)."' where pageid='".$pageid."'");
    }
    mysql_close();        
}
?>
