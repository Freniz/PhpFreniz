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
    if(isset($_REQUEST['messageid']) && isset($_SESSION['userid'])){
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select suserid,ruserid,suservisi,ruservisi from message where messageid='".$_REQUEST['messageid']."'");
        while($row=mysql_fetch_array($result))
        {
        if($row['suserid']==$_SESSION['userid']){
            if($row['ruservisi']=='hidden'){
                mysql_query("delete from message where messageid='".$_REQUEST['messageid']."'");
                $output=$json->encode(array("status"=>"message removed"));
            }
            else
            {
                mysql_query("update message set suservisi='hidden' where messageid='".$_REQUEST['messageid']."'");
                $output=$json->encode(array("status"=>"message removed"));
            }
        }
        else if($row['ruserid']=$_SESSION['userid']){
            if($row['suservisi']=='hidden'){
                mysql_query("delete from message where messageid='".$_REQUEST['messageid']."'");
                $output=$json->encode(array("status"=>"message removed"));
            }
            else
            {
                mysql_query("update message set ruservisi='hidden' where messageid='".$_REQUEST['messageid']."'");
                $output=$json->encode(array("status"=>"message removed"));
            }
        }
        }
       mysql_close(); 
    }
    else
        $output=$json->encode(array("status"=>"please give valid information for this operation"));
    echo $output;
?>
