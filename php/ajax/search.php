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
if(isset($_SESSION['userid']) && isset($_REQUEST['type']) && isset($_REQUEST['key'])){
    mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
    mysql_select_db("fztest1") or die ("coudnt find database");
    $result;
    if($_REQUEST['type']=='pages')
    {
        if(isset($_REQUEST['category']))
                $result=mysql_query("select pageid,pagename,pagepic,category,vote,url from pages where pagename like '".$_REQUEST['key']."%' and category='".$_REQUEST['category']."' order by pagename asc limit 0,3");
        else
            $result=mysql_query ("select pageid,pagename,pagepic,category,vote,url from pages where pagename like '".$_REQUEST['key']."%' order by pagename asc limit 0,3");
        ?>
        <pages>
        <?php while($row=  mysql_fetch_assoc($result))
        { ?>
            <page>
            <pageid><?php echo $row['pageid']; ?></pageid>
            <pagename><?php echo $row['pagename']; ?></pagename>
            <pagepic><?php echo $row['pagepic']; ?></pagepic>
            <category><?php echo $row['category']; ?></category>
            <vote><?php echo $row['vote']; ?></vote>
            <votecount><?php $votes=  unserialize($row['vote']); echo sizeof($votes);  ?></votecount>
            <url><?php echo $row['url']; ?></url>
            </page>
        <?php } ?>
        </pages>
<?php
    }
    else if($_REQUEST['type']=='users')
    {
        $result=mysql_query ("select userid,fname,lname,propic,url from user_info where userid!='default' and (fname like '".$_REQUEST['key']."%' or lname like '".$_REQUEST['key']."%' or concat(fname,' ',lname) like '".$_REQUEST['key']."%') order by concat(fname,' ',lname) asc limit 0,3");
        ?>
        <users>
        <?php            while ($row1 = mysql_fetch_assoc($result)) {
        ?>
            <user>
            <userid><?php echo $row1['userid']; ?></userid>
            <username><?php echo $row1['fname'].' '.$row1['lname']; ?></username>
            <propic><?php echo $row1['propic']; ?></propic>
            <?php $result2=  mysql_query("select vote from friends_vote where userid='".$row1['userid']."'");
                if($row2=  mysql_fetch_assoc($result2)){
            ?>
            <votes><?php echo $row2['vote']; ?></votes>
            <votecount><?php $votes=  unserialize($row2['vote']); echo sizeof($votes);  } ?></votecount>
            <url><?php echo $row1['url']; ?></url>
            </user>
        <?php  }
            ?>
        </users>
<?php
    }
    else if($_REQUEST['type']=='all')
    {
        $result=mysql_query ("select userid,fname,lname,propic,url from user_info where userid!='default' and (fname like '".$_REQUEST['key']."%' or lname like '".$_REQUEST['key']."%' or concat(fname,' ',lname) like '".$_REQUEST['key']."%') order by concat(fname,' ',lname) asc limit 0,3");
    ?>   
<results>
    <?php
    while($row1=  mysql_fetch_assoc($result))
    {?>
    <result>
        <id><?php echo $row1['userid']; ?></id>
        <name><?php echo $row1['fname'].' '.$row1['lname']; ?></name>
        <pic><?php echo $row1['propic'];?></pic>
        <type>user</type>
        <?php $result2=  mysql_query("select vote from friends_vote where userid='".$row1['userid']."'");
                if($row2=  mysql_fetch_assoc($result2)){
            ?>
            <votes><?php echo $row2['vote']; ?></votes>
            <votecount><?php $votes=  unserialize($row2['vote']); echo sizeof($votes);   ?></votecount>
        <?php  }
            ?>
            <url><?php echo $row1['url']; ?></url>
    </result>
    <?php }
    $result=mysql_query ("select pageid,pagename,pagepic,category,vote,url from pages where pagename like '".$_REQUEST['key']."%' order by pagename asc limit 0,3");
    while($row1= mysql_fetch_assoc($result)){
    ?>
    <result>
        <id><?php echo $row1['pageid']; ?></id>
        <name><?php echo $row1['pagename']; ?></name>
        <pic><?php echo $row1['pagepic'];?></pic>
        <type>leaf</type>
        <votes><?php echo $row1['vote']; ?></votes>
        <votecount><?php $votes=  unserialize($row1['vote']); echo sizeof($votes);   ?></votecount>
        <url><?php echo $row1['url']; ?></url>
    </result>
    <?php }
    $result1=mysql_query ("select id,name,infoid,placepic,vote from places where name like '".$_REQUEST['key']."%' group by infoid asc limit 0,3");
    echo mysql_error();
    $country;$province;
    while($row1= mysql_fetch_assoc($result1)){
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
    <result>
        <id><?php echo $row1['id']; ?></id>
        <name><?php echo $row1['name'].",".$province.",".$country; ?></name>
        <pic><?php echo $row1['placepic'];?></pic>
        <type>Place</type>
        <votes><?php echo $row1['vote']; ?></votes>
        <votecount><?php $votes=  unserialize($row1['vote']); echo sizeof($votes);   ?></votecount>
        <url>places.php?placeid=<?php echo $row1['id']; ?></url>
    </result>
    <?php } ?>
</results>
    <?php }
    else if($_REQUEST['type']=='friends')
    {
        $matchedusers=array();$searcharray=array();
        $userpros=array();
        foreach($_SESSION['friends'] as $user)
        {
            $userpro=getminipro($user);
            $searcharray[$user]=$userpro['username'];
            $userpros[$user]=$userpro;
            
        }
        $matchedusers=array_find($_REQUEST['key'], $searcharray);
        ?><users> <?php foreach($matchedusers as $user){
            $userpro=$userpros[$user];?>
            <user>
            <userid><?php echo $userpro['userid']; ?></userid>
            <username><?php echo $userpro['username']; ?></username>
            <propic><?php echo $userpro['propic']; ?></propic>
            <votes><?php echo $userpro['votes']; ?></votes>
            <votecount><?php echo sizeof($userpro['votes']);?></votecount>
            <url><?php echo $userpro['url']; ?></url>
            </user>
        <?php }?>
        </users>
            <?php
    }
    else if($_REQUEST['type']=='places'){
        $country;$province;
    $result1=mysql_query("select id,name,infoid,vote,placepic from places where name like '".$_REQUEST['key']."%' group by infoid limit 3");

    ?>
<places>
<?php
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
            <placepic><?php echo $row1['placepic']; ?></placepic>
            <votes><?php echo $row1['vote']; ?></votes>
            <votecount><?php echo count(unserialize($row1['vote'])); ?></votecount>
            <url>places.php?placeid=<?php echo $row1['id']; ?></url>
        </place>
        
            <?php
    } ?>
    </places>
    <?php
    }
    
}


function array_find($needle, $haystack, $search_keys = false) {
        if(!is_array($haystack)) return false;
        $returnarray=array();
        foreach($haystack as $key=>$value) {
            $what = ($search_keys) ? $key : $value;
            $what=strtolower($what);
            $words=explode(' ', $what);
            foreach($words as $word ){
                if(strpos($word, strtolower($needle))===0) { array_push($returnarray, $key); break;}
            }
            
        }
        return $returnarray;
    }
?>