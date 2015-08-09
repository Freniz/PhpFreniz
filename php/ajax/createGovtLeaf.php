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
    if (isset($_SESSION['userid']) && isset($_REQUEST['pagename']) && isset($_REQUEST['category'])&& isset($_REQUEST['subcategory']) && isset($_REQUEST['admin']) && isset($_REQUEST['pagesurl'])){
        $query1;$query2;$query3;
        $pagesurl=explode(",", $_REQUEST['pagesurl']);
        $tabs['Related Sites']['type']='links';
        $tabs['Related Sites']['urls']=$pagesurl;
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $rand=mt_rand()."_".mt_rand();
        $a=array();
        if(strlen($rand)>25)
            $rand=$substr ($rand, 0, 25);
        $admins=array($_REQUEST['admin']);
        $creator=$_SESSION['userid'];
        $query1="insert into freniz values('".$_REQUEST['pagename']."','page','leaf.php?leafid=".$_REQUEST['pagename']."','a:0:{}')";
        $query2="insert into pages (pageid,pagename,type,category,subcategory,creator,admins,vote,date,url,bannedusers) values('".$_REQUEST['pagename']."','".$_REQUEST['pagename']."','govtpage','".$_REQUEST['category']."','".$_REQUEST['subcategory']."','".$creator."','".  serialize($admins)."','".  serialize($a)."',now(),'leaf.php?leafid=".$_REQUEST['pagename']."','a:0:{}')";
        $query3="insert into pages_info(pageid,info,tabs) values('".$_REQUEST['pagename']."','a:0:{}','".  serialize($tabs)."')";
        if(isset($query1) && isset($query2) && isset($query3)){
        mysql_query($query1);
        mysql_query($query2);
        mysql_query($query3);
        echo json_encode(array("leafid"=>$_REQUEST['pagename']));
        }

    }
?>