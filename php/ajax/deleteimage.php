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
    if(isset($_REQUEST['imageid']) && isset($_SESSION['userid'])){
         mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select userid,albumid from image where imageid='".$_REQUEST['imageid']."'");
        while($row=  mysql_fetch_assoc($result))
        {
            if($row['userid']==$_SESSION['userid'])
            {
                mysql_query("delete from image where imageid='".$_REQUEST['imageid']."'");
                mysql_query("delete from activity where contentid='".$_REQUEST['imageid']."' and contenttype='image'");
            }
            else
            {
                $result1=mysql_query ("select userid from album where albumid='".$row['albumid']."'");
                while($row1=  mysql_fetch_assoc($result1))
                {
                    if($row1['userid']==$_SESSION['userid'])
                    {
                        mysql_query("delete from image where imageid='".$_REQUEST['imageid']."'");
                        $output=$json->encode(array("status"=>"post removed"));
                    }
                    else
                        $output=$json->encode(array("status"=>"you dont have permission to delete this post"));
                }
            }
        }
        mysql_close();
    }
    else
        $output=$json->encode(array("status"=>"you dont have permission to delete this post"));
    echo $output;
    ?>
        