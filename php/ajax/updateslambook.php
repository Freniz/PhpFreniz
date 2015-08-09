<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>

<?php
    $output;
    if(isset($_SESSION['userid']) && $_SESSION['type']=="user" && isset($_REQUEST['userid'])){
        $slambook=array();$slam=array();
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select slambook from apps where userid='".$_REQUEST['userid']."'");
        if($row=  mysql_fetch_assoc($result)){
          $slambook=unserialize($row['slambook']);  
        }
        foreach(array_keys($_REQUEST) as $pname){
            if($pname!="userid")
                $slam[$pname]=$_REQUEST[$pname];
        }
        $slambook[$_SESSION['userid']]=$slam;
        if(mysql_query("update apps set slambook='".serialize($slambook)."' where userid='".$_REQUEST['userid']."'" )){
           $output= json_encode (array("status"=> "slambook updated successfully"));
        }
        else
           $output= json_encode (array("status"=>"erro occured while writing slam book please try agin later"));
    }
    else
        $output= json_encode (array("status"=>"you must have to login for this operation"));
    echo $output;
?>