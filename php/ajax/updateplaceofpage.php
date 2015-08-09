<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if(isset($_SESSION['userid']) && isset($_REQUEST['placeid']) && isset ($_REQUEST['pageid'])){
   if(in_array($_REQUEST['pageid'], $_SESSION['adminpages']) || $_SESSION['userid']==$_REQUEST['pageid']){
    mysql_connect('localhost','nizam','ajith786');
    mysql_select_db('fztest1');
    $result=mysql_query("select infoid from places where id='".$_REQUEST['placeid']."'");
    $infoid;
    while($row=  mysql_fetch_assoc($result)){
        $infoid=$row['infoid'];
    }
    echo "update pages set place='$infoid' where pageid='".$_REQUEST['pageid']."'";
    mysql_query("update pages set place='$infoid' where pageid='".$_REQUEST['pageid']."'");
   }
}
?>
