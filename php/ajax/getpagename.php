<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function getpagename($pageid)
{
    mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
    mysql_select_db("fztest1") or die ("coudnt find database");
    $result=  mysql_query("select pagename from pages where pageid='".$pageid."'");
    while($row=  mysql_fetch_assoc($result)){
        return $row['pagename'];
    }
    
}

?>
