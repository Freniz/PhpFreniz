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
    if(isset($_REQUEST['postid']) && isset($_SESSION['userid'])){
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select suserid,ruserid from status where statusid='".$_REQUEST['postid']."'");
        while($row=mysql_fetch_array($result))
        {
        if($row['suserid']==$_SESSION['userid'] || $row['ruserid']==$_SESSION['userid']){
            mysql_query("delete from status where statusid='".$_REQUEST['postid']."'");
            mysql_query("delete from activity where contentid='".$_REQUEST['postid']."' and contenttype='post'");
            $output=$json->encode(array("status"=>"post removed"));
        }
        else
            $output=$json->encode(array("status"=>"you dont have permission to delete this post"));
        }
       mysql_close(); 
    }
    else
        $output=$json->encode(array("status"=>"please give valid information for this operation"));
    echo $output;
?>