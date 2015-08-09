<?php
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'getminiprofile.php';

session_start();
if(isset($_SESSION['userid']) && isset ($_REQUEST['key']) &&!empty ($_REQUEST['key']))
{?>
    
    <places>
    <?php
    mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
    mysql_select_db("fztest1") or die ("coudnt find database");
    $country;$province;
    $result1=mysql_query("select id,name,infoid from places where name like '".$_REQUEST['key']."%' group by infoid limit 3");
    while($row1=  mysql_fetch_assoc($result1))
    {
        
    $result=mysql_query("select country,province from placesinfo where  id='".$row1['infoid']."'");
    while($row=  mysql_fetch_assoc($result))
    {
        $result2=mysql_query("select name from country where code='".$row['country']."'");
        $result3=mysql_query("select provincename from province where provinceid='".$row['country'].".".$row['province']."'");
        while($row2=  mysql_fetch_assoc($result2))
        {
            $country=$row2['name'];
        }
        while ($row3=  mysql_fetch_assoc($result3))
        {
            $province=$row3['provincename'];
        }
    }
    ?>

        <place>
            <id><?php echo $row1['id']; ?></id>
            <name><?php echo $row1['name']; ?></name>
            <province><?php echo $province; ?></province>
            <country><?php echo $country; ?></country>
        </place>
        
            <?php
    } ?>
    </places>
        <?php
}
?>
