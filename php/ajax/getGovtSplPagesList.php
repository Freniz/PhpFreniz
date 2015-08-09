<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if(isset ($_SESSION['userid']) && isset($_REQUEST['govpageid']))
{
    mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
    mysql_select_db("fztest1") or die ("coudnt find database");
    $result=mysql_query("select pagename,country,province,pagesurl,pagepic from govtpages where pagename='".$_REQUEST['govtpageid']."'");
    while($row=  mysql_fetch_assoc($result))
    {
        
    }
}
?>