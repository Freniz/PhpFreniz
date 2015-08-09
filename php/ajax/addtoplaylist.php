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
    if(isset($_SESSION['userid']) && isset($_REQUEST['leafid']) && $_SESSION['type']=='user'){
            mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
            mysql_select_db("fztest1") or die ("coudnt find database");
            if(!in_array($_REQUEST['leafid'], $_SESSION['playlist']))
                array_push ($_SESSION['playlist'], $_REQUEST['leafid']);
            $_SESSION['playlist']=array_unique($_SESSION['playlist']);
            mysql_query("update user_info set playlist='".serialize($_SESSION['playlist'])."' where userid='".$_SESSION['userid']."'");
            echo json_encode(array("status"=>"song added to playlist successfully"));
    }
    else
        echo json_encode(array("status"=>"oops!!! error occured"));
    ?>
