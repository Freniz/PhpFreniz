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
$from=0;
if(isset($_REQUEST['from']) && $_REQUEST['from']>0)
    $from=$_REQUEST['from'];
if(isset($_SESSION['userid'])&& isset($_REQUEST['placeid']) )
{
    mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
    mysql_select_db("fztest1") or die ("coudnt find database");
    $infoid;
    $result1=mysql_query("select infoid from places where id='".$_REQUEST['placeid']."'");
    while($row1=  mysql_fetch_assoc($result1))
    {
        $infoid=$row1['infoid'];
    }
    $result=mysql_query("select pageid,pagename,pagepic,vote,type,category,subcategory,url,bids from pages where  place='$infoid'  order by bids desc limit $from,20");
    ?>

    <pages>
    <?php
    echo "select pageid,pagename,pagepic,vote,type,category,subcategory,url,bids from pages where  place='$infoid'  order by bids desc limit $from,20";
    while($row= mysql_fetch_assoc($result))
    {
        ?>
        <page>
            <id><?php echo $row['pageid']; ?></id>
            <pagename><?php echo $row['pagename']; ?></pagename>
            <pagepic><?php echo imageurl($row['pagepic']); ?></pagepic>
            <votes><?php $votes=unserialize( $row['votes']); echo count($votes); ?></votes>
            <category><?php echo $row['category']; ?></category>
            <subcategory><?php echo $row['subcategory']; ?></subcategory>
            <url><?php echo $row['url']; ?></url>
            <bids><?php echo $row['bids']; ?></bids>
        </page>
        
            <?php
    } ?>
    </pages>
        <?php
}
?>