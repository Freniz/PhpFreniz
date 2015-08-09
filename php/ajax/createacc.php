<?php require_once ('json/JSON.php');
 require_once '../Classes/ip2c.php';
 
$json = new Services_JSON();
$output;
if(isset($_REQUEST["un"]) && isset($_REQUEST["pass"]) && isset($_REQUEST["fname"]) && isset($_REQUEST["lname"]) && isset($_REQUEST["email"]) && isset($_REQUEST["sex"]) && isset($_REQUEST["bdd"]) && isset($_REQUEST["bdm"]) && isset($_REQUEST["bdy"]) ){
    $dob=$_REQUEST["bdy"]."-".$_REQUEST["bdm"]."-".$_REQUEST["bdd"];
    $ip2c=new ip2c();
    mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
    mysql_select_db("fztest1") or die ("coudnt find database");
    if(mysql_query("insert into freniz values('".$_REQUEST['un']."','user','profile.php?userid=".$_REQUEST['un']."','a:0:{}','".$_REQUEST['fname']." ".$_REQUEST['lname']."','".$ip2c->getIpAdd()."')")){
    if(mysql_query("insert into userstable (userid,pass,email) values('".$_REQUEST['un']."','".$_REQUEST['pass']."','".$_REQUEST['email']."')")){
    $a=array();
    $b=serialize($a);
    if(mysql_query("insert into user_info (userid,fname,lname,dob,sex,email,date,musics,books,movies,games,celebrities,other,pinnedpic,sports,playlist,school,college,language,adminpages,employer,url,blocklist,blockedby,reviews,reqfrmme) values('".$_REQUEST['un']."','".$_REQUEST['fname']."','".$_REQUEST['lname']."','".$dob."','".$_REQUEST['sex']."','".$_REQUEST['email']."',now(),'".$b."','".$b."','".$b."','".$b."','".$b."','".$b."','".$b."','".$b."','".$b."','".$b."','".$b."','".$b."','".$b."','".$b."','profile.php?userid=".$_REQUEST['un']."','a:0:{}','a:0:{}','a:0:{}','a:0:{}')")){
    if(mysql_query("insert into apps values('".$_REQUEST['un']."','".$b."','".$b."','".$b."')")){
        $a1=array();
        $b1=array('post','image','admire','pin','video');
        foreach($b1 as $c1)
            $a1[$c1]=array();
        $d1= serialize($a1);

    if(mysql_query("insert into friends_vote (userid,friendlist,incomingrequest,sentrequest,vote,voted) values('".$_REQUEST['un']."','".$b."','".$b."','".$b."','".$b."','a:0:{}')")&&  mysql_query("insert into privacy (userid,postignore,testyignore,postspeci,testyspeci,blogspeci,posthidden,testyhidden,bloghidden,autoacceptusers,blockactivityusers,hidestreams,hideusersstream) values('".$_REQUEST['un']."','a:0:{}','a:0:{}','a:0:{}','a:0:{}','a:0:{}','a:0:{}','a:0:{}','a:0:{}','".$d1."','".$d1."','a:0:{}','a:0:{}')")){
    if(mysql_query("insert into album (userid,name,date,specificlist,hiddenlist,ignorelist) values('".$_REQUEST['un']."','Profilepics',now(),'a:0:{}','a:0:{}','a:0:{}')")){
    $albumid=mysql_insert_id();
    mysql_query("insert into album (userid,name,date,specificlist,hiddenlist,ignorelist) values('".$_REQUEST['un']."','SecondaryProfilepics',now(),'a:0:{}','a:0:{}','a:0:{}')");
    $secalbum=mysql_insert_id();
    mysql_query("insert into album (userid,name,date,specificlist,hiddenlist,ignorelist,canupload) values('".$_REQUEST['un']."','Chart Pics',now(),'a:0:{}','a:0:{}','a:0:{}','friends')");
    if(mysql_query("update user_info set propicalbum='".$albumid."',secondarypicalbum='$secalbum' where userid='".$_REQUEST['un']."'")&& mysql_query("insert into notification values('".$_REQUEST['un']."','a:0:{}')")){
    $output=$json->encode(array("status"=>"success","html"=>"Your Account has been Created Successfully"));
    }
    else{
        $output=$json->encode(array("status"=>"failiure","html"=>"sorry an error occured while creating your account please try again"));
    }
    }
    else{
        $output=$json->encode(array("status"=>"failiure","html"=>"sorry an error occured while creating your account please try again"));
    }
    }
    else{
        $output=$json->encode(array("status"=>"failiure","html"=>"sorry an error occured while creating your account please try again"));
    }
    }
    else{
        $output=$json->encode(array("status"=>"failiure","html"=>"sorry an error occured while creating your account please try again"));
    }
    }
    else{
        $output=$json->encode(array("status"=>"failiure","html"=> "sorry an error occured while creating your account please try again"));
    }
    }
    else{
        $output=$json->encode(array("status"=>"failiure","html"=>"sorry an error occured while creating your account please try again"));
    }
    }
    else{
        $output=$json->encode(array("status"=>"failiure","html"=>"sorry an error occured while creating your account please try again"));
    }
    mysql_close();
    
} 
else
   $output=$json->encode(array("status"=>"failiure","html"=>"sorry an error occured while creating your account please try again"));

echo $output;
?>
