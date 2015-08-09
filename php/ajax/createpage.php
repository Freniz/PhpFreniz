<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once '../Classes/ip2c.php';
?>
<?php  
    require_once ('json/JSON.php');
    $json = new Services_JSON();
    $output;
    if (isset($_SESSION['userid']) && isset($_REQUEST['pagename']) && isset($_REQUEST['type']) && isset($_REQUEST['category']) && isset($_REQUEST['subcategory'])){
        if($_REQUEST['type']=='default' || $_REQUEST['type']=='normal' ){
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $rand=mt_rand()."_".mt_rand();
        if(strlen($rand)>25)
            $rand=$substr ($rand, 0, 25);
        $admins=array($_SESSION['userid']);
        $creator=$_SESSION['userid'];
        if($_REQUEST['type']=='defualt')
        {
            $admins=array('default');
            $creator='default';
        }
        $ip2c=new ip2c();
        $a=array($_SESSION['userid']);
        if($_REQUEST['category']!='songs'){
        if(mysql_query("insert into freniz values('leaf_".$rand."','page','leaf.php?leafid=leaf_".$rand."','a:0:{}','".$_REQUEST['pagename']."','".$ip2c->getIpAdd()."')")){
            if(mysql_query("insert into pages (pageid,pagename,type,category,subcategory,creator,admins,vote,date,url,bannedusers) values('leaf_".$rand."','".$_REQUEST['pagename']."','".$_REQUEST['type']."','".$_REQUEST['category']."','".$_REQUEST['subcategory']."','".$creator."','".  serialize($admins)."','".  serialize($a)."',now(),'leaf.php?leafid=leaf_".$rand."','a:0:{}')")){
                if(mysql_query("insert into pages_info(pageid,info) values('leaf_".$rand."','a:0:{}')")){
                    $results1=mysql_query("select adminpages from user_info where userid='".$_SESSION['userid']."'");
                    while($row1=  mysql_fetch_assoc($results1))
                    {
                        $admins1=unserialize($row1['adminpages']);
                        array_push($admins1, "leaf_".$rand);
                        if($_REQUEST['type']=='normal')
                        {
                            mysql_query("update user_info set adminpages='".serialize($admins1)."' where userid='".$_SESSION['userid']."'");
                            mysql_query("update freniz set adminpages='".serialize($admins1)."' where userid='".$_SESSION['userid']."'");
                            mysql_query("insert into album (userid,name,date) values('leaf_".$rand."','pagepics',now())");
                        }
                        $output=$json->encode(array("status" => "success","leafid"=>"leaf_".$rand));
                    }
                }
                else
                   $output=$json->encode(array("status" => "Error occured while creating your leaf","leafid"=>0)); 
            }
            else
                $output=$json->encode(array("status" => "Error occured while creating your leaf","leafid"=>0));
        }
        }
        else if($_REQUEST['category']=='songs' && isset($_REQUEST['songurl']))
        {
            if(mysql_query("insert into freniz values('leaf_".$rand."','page','leaf.php?leafid=leaf_".$rand."','a:0:{}','".$_REQUEST['pagename']."',$ip2c->getIpAdd()')")){
            if(mysql_query("insert into pages (pageid,pagename,type,category,subcategory,creator,admins,vote,date,url,bannedusers) values('leaf_".$rand."','".$_REQUEST['pagename']."','".$_REQUEST['type']."','".$_REQUEST['category']."','".$_REQUEST['subcategory']."','".$creator."','".  serialize($admins)."','".  serialize($a)."',now(),'leaf.php?leafid=leaf_".$rand."','a:0:{}')")){
                if(mysql_query("insert into pages_info(pageid,info,songurl) values('leaf_".$rand."','a:0:{}','".$_REQUEST['songurl']."')")){
                    $results1=mysql_query("select adminpages from user_info where userid='".$_SESSION['userid']."'");
                    while($row1=  mysql_fetch_assoc($results1))
                    {
                        $admins1=unserialize($row1['adminpages']);
                        array_push($admins1, "leaf_".$rand);
                        mysql_query("update user_info set adminpages='".serialize($admins1)."' where userid='".$_SESSION['userid']."'");
                        mysql_query("update freniz set adminpages='".serialize($admins1)."' where userid='".$_SESSION['userid']."'");
                        if($_REQUEST['type']=='normal')
                        mysql_query("insert into album (userid,name,date) values('leaf_".$rand."','pagepics',now())");
                        $output=$json->encode(array("status" => "success","leafid"=>"leaf_".$rand));
                    }
                }
                else
                   $output=$json->encode(array("status" => "Error occured while creating your leaf","leafid"=>0)); 
            }
            else
                $output=$json->encode(array("status" => "Error occured while creating your leaf","leafid"=>0));
        }
        }
        else
            $output=$json->encode(array("status" => "Error occured while creating your leaf","leafid"=>0));
        mysql_close();
        }
        else
            $output=$json->encode(array("status" => "Error occured while creating your leaf","leafid"=>0));
    }
    else
        $output=$json->encode(array("status" => "Error occured while creating your leaf","leafid"=>0));
    echo $output;
 ?>