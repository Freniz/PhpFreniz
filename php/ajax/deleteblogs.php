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
    $output=$json->encode(array("status"=>"You do not have permission to do this operation"));
    if(isset($_REQUEST['blogid']) && isset($_SESSION['userid'])){
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select userid from blog where blogid='".$_REQUEST['blogid']."'");
        while($row=mysql_fetch_array($result))
        {
        if($row['userid']==$_SESSION['userid'] ){
            mysql_query("delete from blog where blogid='".$_REQUEST['blogid']."'");
            mysql_query("delete from activity where userid='".$_SESSION['userid']."' and contentid='".$_REQUEST['blogid']."' and contenttype='blog' and title='write blog'");
            $output=$json->encode(array("status"=>"blog removed"));
        }
        
        }
       mysql_close(); 
    }
    else
        $output=$json->encode(array("status"=>"please give valid information for this operation"));
    echo $output;
?>