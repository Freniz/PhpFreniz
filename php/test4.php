<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$file=  file_get_contents("/Users/abdulnizam/Desktop/ip-to-country.csv");
$filelines=explode(",;;;;;",$file);
mysql_connect('localhost','nizam','ajith786');
mysql_select_db('fztest1');
set_time_limit(0);

foreach($filelines as $line)
{
    $string=explode(",", $line);
    $string1="'".trim(implode("','", $string))."'";
    echo "insert into ip2country (beginip,endip,isoalpha2,isoalpha3) values ($string1)<br>";
    //mysql_query("insert into ip2country (beginip,endip,isoalpha2,isoalpha3) values ($string1)");
}

?>
