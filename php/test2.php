<?php
mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
mysql_select_db('fztest1') or die("database not found");
set_time_limit(0);
ini_set("memory_limit", "2000M");
$geonameid=array();
$result1=mysql_query("select geonameid from countryinfo");
echo mysql_error();
while($row1=  mysql_fetch_assoc($result1))
{
    array_push($geonameid, $row1['geonameid']);
    
}
$id="'".  implode("','", $geonameid)."'";
echo $id;
mysql_query("delete from placesinfo where id in ($id)");
    if(mysql_error())
    echo mysql_error()."<br>";
    
   

?>
<html>
    <head>
        
        <script type="text/javascript">
        
        </script>
    </head>
    <body>
    </body>
</html>