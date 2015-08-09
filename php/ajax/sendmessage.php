<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'getminiprofile.php';
?>

<?php  
    $output;
    if(isset($_REQUEST['userid']) && isset($_REQUEST['message']) && isset($_SESSION['userid']))
               {
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select message from privacy where userid='".$_REQUEST['userid']."'");
            while($row=  mysql_fetch_assoc($result)){
                $minipro=getminipro($_REQUEST['userid']);
                if(($row['message']=='public' || ($row['message']=='friends' &&in_array($_REQUEST['userid'], $_SESSION['friends']) || ($row['message']=='fof' && (in_array($_REQUEST['userid'], $_SESSION['friends'])|| count(array_intersect($minipro['friends'], $_SESSION['friends'])>=1))) )&& !in_array($_REQUEST['userid'], $_SESSION['blocklist'])&& !in_array($_REQUEST['userid'], $_SESSION['blockedby']))&&($_REQUEST['userid']!=$_SESSION['userid'])){
                    if(strlen(trim($_REQUEST['message']))>0) {
                        if(mysql_query("insert into message (suserid,ruserid,message,date,read1) values('".$_SESSION['userid']."','".$_REQUEST['userid']."','".$_REQUEST['message']."',now(),'0')"))
                            $output=json_encode(array("status"=> "your message has been send to ".$_REQUEST['userid']));
                        else
                            $output=json_encode(array("status"=> "error occured please try again"));
                    }
                    else
                        $output=json_encode(array("status"=> "your message can not be blank"));
                }
                else
                    $output=json_encode(array("status"=> "you don't have permission to message this user"));
            }
            
    }
    else
            $output=json_encode(array("status"=> "error occured please try again"));
    echo $output;

?>