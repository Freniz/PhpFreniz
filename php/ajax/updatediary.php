<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>
<?php
    if(isset($_SESSION['userid']) && $_SESSION['type']=="user"){
        $diary=$_SESSION['diary'];$content=array();
        $parameters=array_keys($_REQUEST);
        $output;
        foreach($parameters as $pname){
            if($pname!="date")
                $content[$pname] = $_REQUEST[$pname] ;
        }
        $diary[$_REQUEST['date']]=$content;
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");
        if(mysql_query("update apps set diary='".serialize($diary)."' where userid='".$_SESSION['userid']."'" ))
           $output= json_encode (array("status"=> "diary is updated"));
        else
            $output= json_encode (array("status"=>"error occured while trying to update diary please try again later"));
    }
    else
        $output= json_encode (array("status"=>"you must have to login for this operation"));
    echo $output;
?>