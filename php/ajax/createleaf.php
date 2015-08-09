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
    if (isset($_SESSION['userid']) && isset($_REQUEST['pagename']) && isset($_REQUEST['type']) && isset($_REQUEST['category'])&& isset($_REQUEST['subcategory'])){
        $query1;$query2;$query3;
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $rand=mt_rand()."_".mt_rand();
        $a=array();
        if(strlen($rand)>25)
            $rand=$substr ($rand, 0, 25);
        $admins=array($_SESSION['userid']);
        $creator=$_SESSION['userid'];
        if($_REQUEST['type']=='default' || $_REQUEST['type']=='place'){
            $admin=array('default');
            $creator='default';
        }
            if($_REQUEST['type']!='songs'){
                $query1="insert into freniz values('leaf_".$rand."','page','leaf.php?leafid=leaf_".$rand."','a:0:{}')";
                $query2="insert into pages (pageid,pagename,type,category,subcategory,creator,admins,vote,date,url,bannedusers) values('leaf_".$rand."','".$_REQUEST['pagename']."','".$_REQUEST['type']."','".$_REQUEST['category']."','".$_REQUEST['subcategory']."','".$creator."','".  serialize($admins)."','".  serialize($a)."',now(),'leaf.php?leafid=leaf_".$rand."','a:0:{}')";
                $query3="insert into pages_info(pageid,info,tabs) values('leaf_".$rand."','a:0:{}','a:0:{}')";
            }
            else if(isset($_REQUEST['songurl']) && $_REQUEST['validurl']=='valid')
            {
                $query1="insert into freniz values('leaf_".$rand."','page','leaf.php?leafid=leaf_".$rand."','a:0:{}')";
                $query2="insert into pages (pageid,pagename,type,category,subcategory,creator,admins,vote,date,url,bannedusers) values('leaf_".$rand."','".$_REQUEST['pagename']."','".$_REQUEST['type']."','".$_REQUEST['category']."','".$_REQUEST['subcategory']."','".$creator."','".  serialize($admins)."','".  serialize($a)."',now(),'leaf.php?leafid=leaf_".$rand."','a:0:{}')";
                $query3="insert into pages_info(pageid,info,songurl,tabs) values('leaf_".$rand."','a:0:{}','".$_REQUEST['songurl']."','a:0:{}')"; 
            }
            if(isset($query1) && isset($query2) && isset($query3)){
            mysql_query($query1);
            mysql_query($query2);
            mysql_query($query3);
            echo json_encode(array("leafid"=>'leaf_'.$rand));
            }
        
    }
?>