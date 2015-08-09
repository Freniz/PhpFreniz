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
    if(isset($_SESSION['userid']))
       {
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select incomingrequest,friendlist,sentrequest from friends_vote where userid='".$_SESSION['userid']."'");
        $bendingrequest;$frnds;$sentrequest;
        while($row=  mysql_fetch_assoc($result))
        {
            $bendingrequest=unserialize($row['incomingrequest']);
            $frnds=unserialize($row['friendlist']);
            $sentrequest=unserialize($row['sentrequest']);
        }
        $_SESSION['bendingrequest']=$bendingrequest;
        $_SESSION['friends']=$frnds;
        $_SESSION['sentrequest']=$sentrequest;
        $output=$json->encode(array("reqcount"=> sizeof($bendingrequest)));
        mysql_close();
       }
       else
           {
       $output=$json->encode(array("reqcount"=>'0'));
       }
    echo $output;

   ?>