<?php
    require_once ('json/JSON.php');
    $json=new Services_JSON();
    $output;
    mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
    mysql_select_db("fztest1") or die ("coudnt find database");    
    $results=mysql_query("select userid from freniz");
    while($row=mysql_fetch_assoc($results)){
        if($row['userid']==$_REQUEST['userid']){
            $output=$json->encode(array("status"=>"false"));
        }
    }
    if(!isset($output))
        $output=$json->encode(array("status"=>"true"));
    echo $output;
    mysql_close();
    
    ?>
