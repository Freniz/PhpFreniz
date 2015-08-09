<?php
    require_once ('json/JSON.php');
    $json=new Services_JSON();
    $output;
    mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
    mysql_select_db("fztest1") or die ("coudnt find database");    
    $results=mysql_query("select email from user_info");
    while($row=mysql_fetch_assoc($results)){
        if($row['email']==$_REQUEST['emailid']){
            $output=$json->encode(array("status"=>"false"));
        }
    }
    if(!isset($output))
        $output=$json->encode(array("status"=>"true"));
    echo $output;
    mysql_close();
?>