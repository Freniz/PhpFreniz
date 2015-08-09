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
    if (isset($_SESSION['userid']) && isset($_REQUEST['pagename']) && isset($_REQUEST['admin']) && isset($_REQUEST['pagesurl'])){
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $pagesurl=explode(",", $_REQUEST['pagesurl']);
        $tabs['Related Sites']['type']='links';
        $tabs['Related Sites']['urls']=$pagesurl;
        $rand=$_REQUEST['pagename'];
        $admins=array($_REQUEST['admin']);
        $creator=$_REQUEST['admin'];
        $ip2c=new ip2c();
        $a=array($_SESSION['userid']);
        if(mysql_query("insert into freniz values('".$rand."','page','leaf.php?leafid=".$rand."','a:0:{}','".$_REQUEST['pagename']."','".$ip2c->getIpAdd()."')")){
            if(mysql_query("insert into pages (pageid,pagename,type,category,subcategory,creator,admins,vote,date,url,bannedusers) values('".$rand."','".$_REQUEST['pagename']."','govt','govt','govt','".$creator."','".  serialize($admins)."','".  serialize($a)."',now(),'leaf.php?leafid=".$rand."','a:0:{}')")){
                if(mysql_query("insert into pages_info(pageid,info,tabs) values('".$rand."','a:0:{}','".  serialize($tabs)."')")){
                    $results1=mysql_query("select adminpages from user_info where userid='".$_REQUEST['admin']."'");
                    while($row1=  mysql_fetch_assoc($results1))
                    {
                        $admins1=unserialize($row1['adminpages']);
                        array_push($admins1,$rand);
                        if($_REQUEST['type']=='normal')
                        {
                            mysql_query("update user_info set adminpages='".serialize($admins1)."' where userid='".$_REQUEST['admin']."'");
                            mysql_query("update freniz set adminpages='".serialize($admins1)."' where userid='".$_REQUEST['admin']."'");
                            mysql_query("insert into album (userid,name,date) values('".$rand."','pagepics',now())");
                        }
                        $output=$json->encode(array("status" => "success","leafid"=>$rand));
                    }
                }
                else
                   $output=$json->encode(array("status" => "Error occured while creating your leaf","leafid"=>0)); 
            }
            else
                $output=$json->encode(array("status" => "Error occured while creating your leaf","leafid"=>1));
        }
        
        else
            $output=$json->encode(array("status" => "Error occured while creating your leaf","leafid"=>2));
        mysql_close();
        
    }
    else
        $output=$json->encode(array("status" => "Error occured while creating your leaf","leafid"=>4));
    echo $output;
 ?>