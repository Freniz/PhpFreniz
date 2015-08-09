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
    if(isset($_SESSION['userid'])&& $_SESSION['type']=='user' && isset($_REQUEST['leafid']))
    {
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select vote from pages where pageid='".$_REQUEST['leafid']."'");
        while($row=  mysql_fetch_assoc($result))
        {
            $votes=unserialize($row['vote']);
            if(in_array($_SESSION['userid'], $votes))
            {
                $votes=array_diff($votes, array($_SESSION['userid']));
                $_SESSION['voted']=array_diff($_SESSION['voted'], array($_REQUEST['leafid']));
                mysql_query("update pages set vote='".serialize($votes)."' where pageid='".$_REQUEST['leafid']."'");
                mysql_query("update friends_vote set voted='".serialize($_SESSION['voted'])."' where userid='".$_SESSION['userid']."'");
                mysql_query("delete from activity where userid='".$_SESSION['userid']."' and contentid='".$_REQUEST['leafid']."' and contenttype='leaf' and title='voted on'");
                $output=$json->encode(array("status"=>"you have withdrawn vote from this leaf"));
            }
            
        else
            $output=$json->encode(array("status"=> "you havent voted to this leaf"));
        }
       mysql_close(); 
    }
    else
        $output=$json->encode(array("status"=> "you don't have permission to this operation"));
   echo $output;
   
?>
