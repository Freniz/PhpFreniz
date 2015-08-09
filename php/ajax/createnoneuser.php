<?php require_once ('json/JSON.php');
$json = new Services_JSON();
$output;
if(isset($_REQUEST["pass"]) && isset($_REQUEST["email"])){
    mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
    mysql_select_db("fztest1") or die ("coudnt find database");
    $rand=mt_rand()."_".mt_rand();
    if(mysql_query("insert into freniz values('".$rand."','none','freniz.com','a:0:{}')")){
    if(mysql_query("insert into userstable (userid,pass,email) values('".$_REQUEST['un']."','".$_REQUEST['pass']."','".$_REQUEST['email']."')")){
    $albumid=mysql_insert_id();
    $output=$json->encode(array("html"=>"Your Account has been Created Successfully"));
    }
    else{
        $output=$json->encode(array("html"=>"sorry an error occured while creating your account please try again"));
    }
    }
    else{
        $output=$json->encode(array("html"=>"sorry an error occured while creating your account please try again"));
    }
    mysql_close();
    
} 
else
   $output=$json->encode(array("html"=>"sorry an error occured while creating your account please try again"));

echo $output;
?>
