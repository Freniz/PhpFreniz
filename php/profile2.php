<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'ajax/getminiprofile.php';
require_once 'ajax/getpagename.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
    $ud;$fv;$votes;
    mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
    mysql_select_db("fztest1") or die ("coudnt find database");    
    if(isset($_SESSION['userid']))
        {
        $results=mysql_query("select profiletype,fname,lname,dob,sex,school,college,email,hometown,currentcity,language,rstatus,employer,religion,myphilosophy,state,country,propic,pinnedpic,books,musics,movies,celebrities,games,sports,other,playlist,mood,secondarypic1,secondarypic2,propicalbum,adminpages,url from user_info where userid='".$_REQUEST['userid']."'");
        while($row=  mysql_fetch_assoc($results))
        {
        $ud=$row;
        $results1=mysql_query("select friendlist,vote from friends_vote where userid='".$_REQUEST['userid']."'");
        while($row1=  mysql_fetch_assoc($results1))
        {
        $fv=$row1;
        $votes=unserialize($fv['vote']);
        }
       
        }
        }
        else
            echo "javascript:alert('please login to <a href=\"/index.jp\">login page</a>')";

?>




<div  style=" position:absolute; width:250px; right:0px; top:40px">

<ul class="roundbuttons profilerdwidth" style=" right:5px; top: 25px;">
    <?php $frnds=$_SESSION['friends'];
if(in_array($_REQUEST['userid'], $frnds)){
?>
<li ><a  onclick="removefrnd('<?php echo $_REQUEST['userid']; ?> ')">Remove </a></li>
<?php } else if(in_array($_REQUEST['userid'], $_SESSION['sentrequest'])){ ?>
<li ><a  onclick="cancelfrndreq('<?php echo $_REQUEST['userid']; ?>')">Cancel Req </a></li>
<?php } else if(in_array($_REQUEST['userid'], $_SESSION['bendingrequest'])){ ?>
<li ><a  onclick="respondfrnd('<?php echo $_REQUEST['userid']; ?>')">Respond to Req </a></li>
<?php }else{ ?>
<li ><a  onclick="sendfrndreq('<?php echo $_REQUEST['userid']; ?>')">Invite </a></li>
<?php } ?>
<li ><a  onclick="document.getElementById('light3').style.display='block';document.getElementById('fade3').style.display='block';" >Message</a></li>
<li ><a  >Music</a></li>
<li ><a  onclick="slambook('<?php echo $_REQUEST['userid']; ?>')">Slambook</a></li>
<?php 
if(in_array($_SESSION['userid'], $votes)){
?>
<li ><a onclick="withdrawuservote('<?php echo $_REQUEST['userid']; ?>')">Withdraw</a></li>
<?php }else{ ?>
<li ><a  onclick="voteuser('<?php echo $_REQUEST['userid']; ?>')">Vote</a></li>
<?php } ?>
</ul>
</div>



<div id="center" style="float:left; width:1024px; border:solid 1px">
 <div style="width:200px; height:600px;float:left;   ">
     <div style="width:200px; height: 30px; float: left"><?php echo $ud['fname']." ".$ud['lname']; ?></div>
     <div style="width:200px;height:16px; text-align: right"><?php echo sizeof($votes); ?></div>
     <div class="profiledetailsfontcolor" style="width:200px">
  B'day:<?php echo $ud['dob']; ?><br />
     Sex:<?php echo $ud['sex']; ?><br />
     Status:<?php echo $ud['rstatus']; ?><br />
     Religion: <?php echo $ud['religion']; ?><br />
     Current City:<?php echo $ud['currentcity']; ?><br />
     Hometown:<?php echo $ud['hometown']; ?><br />
      Language: <br />
     <?php $languages=unserialize($ud["language"]);
  for($i=0;$i<sizeof($languages);$i++)
           {
      if($i<3){
           echo "<a href='pages.php?pageid=".$languages[$i]."'>".$languages[$i]."</a></br>";
           }
      }
if(sizeof($languages)>2)
    echo "<a href='#'>seemore</a>";
?>
 </div>
 <div style="width:200px">
 <li class=" favorites">  Education & Occupation<div class="arrow"></div></li>
 <div class="profiledetailsfontcolor" style="width:200px">
 school:<br>
 <?php  $schools=unserialize($ud["school"]);
  for($i=0;$i<sizeof($schools);$i++)
           {
      if($i<3){
          echo "<a href='pages.php?pageid=".$schools[$i]."'>".$schools[$i]."</a></br>";
           }
      }
if(sizeof($schools)>2)
    echo "<a href='#'>seemore</a>";
?>
 </div>
 <div class="profiledetailsfontcolor" style="width:200px">
 college:<br>
  <?php $colleges = unserialize($ud["college"]);
  for($i=0;$i<sizeof($colleges);$i++)
           {
      if($i<3){
          echo "<a href='pages.php?pageid=".$colleges[$i]."'>".$colleges[$i]."</a></br>";
           }
      }
if(sizeof($colleges)>2)
    echo "<a href='#'>seemore</a>";
?>
 </div>
 <div class="profiledetailsfontcolor" style="width:200px">
 Worked In:<br>
 <?php $employer= unserialize($ud["employer"]);
  for($i=0;$i<sizeof($employer);$i++)
           {
      if($i<3){
          echo "<a href='pages.php?pageid=".$employer[$i]."'>".$employer    [$i]."</a></br>";
           }
      }
if(sizeof($colleges)>2)
    echo "<a href='#'>seemore</a>";
?></div>
 </div>

 <div style="width:200px">
 <li class="favorites" >Favourites <div class="arrow"></div> </li>
 
 <div class="profiledetailsfontcolor" style="width:200px">
 Books:<br>
<?php
$books=unserialize($ud['books']);
$i=0;
  foreach($books as $book){
      if($i<3){
          echo "<a href='pages.php?pageid=".$book."'>".getpagename($book)."</a></br>";
           }
           $i++;
      }
if(sizeof($books)>2)
    echo "<a href='#'>seemore</a>";
?>
 </div>
 
 <div class="profiledetailsfontcolor" style="width:200px">
 Music:
 <div class="profiledetailsfontcolor" style="width:200px">
 Album:
<?php
$musics=unserialize($ud['musics']);
$i=0;
  foreach($musics as $music)
           {
      if($i<3){
          echo "<a href='pages.php?pageid=".$music."'>".getpagename($music)."</a></br>";
           }
           $i++;
      }
if(sizeof($musics)>2)
    echo "<a href='#'>seemore</a>";
?>

 </div>
 <div class="profiledetailsfontcolor" style="width:200px">
 Songs:
 <?php
$playlists=unserialize($ud['playlist']);
$i=0;  
    foreach($playlists as $playlist)
           {
      if($i<3){
          echo "<a href='pages.php?pageid=".$playlist."'>".getpagename($playlist)."</a></br>";
           }
           $i++;
      }
if(sizeof($playlists)>2)
    echo "<a href='#'>seemore</a>";
?>

 </div>
 </div>
 <div class="profiledetailsfontcolor" style="width:200px">
 Movies:
 <?php
$movies=unserialize($ud['movies']);
$i=0;
  foreach($movies as $movie)
           {
      if($i<3){
          echo "<a href='pages.php?pageid=".$movie."'>".getpagename($movie)."</a></br>";
           }
           $i++;
      }
if(sizeof($movies)>2)
    echo "<a href='#'>seemore</a>";
?>

</div>
 <div class="profiledetailsfontcolor" style="width:200px">
 Celebrities:
 <?php
$celebrities=unserialize($ud['celebrities']);
$i=0;
  foreach($celebrities as $celebrity)
           {
      if($i<3){
          echo "<a href='pages.php?pageid=".$celebrity."'>".getpagename($celebrity)."</a></br>";
           }
           $i++;
      }
if(sizeof($celebrities)>2)
    echo "<a href='#'>seemore</a>";
?>

 </div>
 <div class="profiledetailsfontcolor" style="width:200px">
 Games:
 <?php
$games=unserialize($ud['games']);
$i=0;
  foreach($games as $game)
           {
      if($i<3){
          echo "<a href='pages.php?pageid=".$game."'>".getpagename($game)."</a></br>";
           }
           $i++;
      }
if(sizeof($games)>2)
    echo "<a href='#'>seemore</a>";
?>

 </div>
 <div class="profiledetailsfontcolor" style="width:200px">
 Sports:
 <?php
$sports=unserialize($ud['sports']);
$i=0;
  foreach($sports as $sport)
           {
      if($i<3){
          echo "<a href='pages.php?pageid=".$sport."'>".getpagename($sport)."</a></br>";
           }
           $i++;
      }
if(sizeof($sports)>2)
    echo "<a href='#'>seemore</a>";
?>

 </div>
 <div class="profiledetailsfontcolor" style="width:200px">
 Others:
 <?php
$others=unserialize($ud['other']);
$i=0;
  foreach($others as $other)
           {
      if($i<3){
          echo "<a href='pages.php?pageid=".$other."'>".getpagename($other)."</a></br>";
           }
           $i++;
      }
if(sizeof($others)>2)
    echo "<a href='#'>seemore</a>";
?>

 </div>
 </div>
</div>


<div id="innercenter" style="width:624px; float: left; border:solid 1px; " >
<div id="profpic" style=" width:380px;  float:left">
<div  class="profilepic" style="">
    <img src="images/<?php echo imageurl($ud['propic']);
         ?>" width="150" height="200"/>
</div>
<div class="secondaryprofilepic" style=" float:right; border:solid 1px;">
<div class="innersecondaryprofilepic_1" style="border:solid 1px;">
    <img src="images/200/200_<?php echo imageurl($ud['secondarypic1']);  ?>" height="95" width="200"/>
</div>
<div class="innersecondaryprofilepic_2" style="border:solid 1px;">
    <img src="images/200/200_<?php echo imageurl($ud['secondarypic2']);  ?>" height="95" width="200"/>
</div>
</div>
</div>
<div id="pinnedpic" style="width:215px; border:solid 1px; overflow: scroll">
    <?php $pinnedpics=unserialize($ud["pinnedpic"]);
      for($i=0;$i<sizeof($pinnedpics);$i++){
          $results2=mysql_query("select url from image where imageid='".$pinnedpics[$i]."'");
    while($row3=  mysql_fetch_assoc($results2))
        echo "<img src='images/".$row3['url']."' width='50' height='50'/>";
  if(($i+1)%6==0)
      echo "</br>";
  }
?>
    
</div>
<div id="stature" style="width: 604px;border:solid 1px;">
    <?php $results2=mysql_query("select status from status where suserid='".$_REQUEST['userid']."' and ruserid='".$_REQUEST['userid']."' order by date desc limit 0,1");
    while($row3=  mysql_fetch_assoc($results2))
        echo $row3['status'];
    ?>
</div>
<div id="update" style="width:624px; border:solid 1px; float:left; height:20px;">
<a  >My stream</a>
<a  >My profile</a>
<a onclick="getalbums('<?php echo $_REQUEST['userid']; ?>')" >My picz</a>
</div>
<div style="height:40px; width:624px; float:left">
    <form name="postform" onsubmit="dopost('<?php echo $_REQUEST['userid']; ?>')">
<input type="text" name="post" style="width:500px; height:25px; float:left" />
<input type="button" value="update" onclick="dopost('<?php echo $_REQUEST['userid']; ?>')"/>
    </form>
</div>
<div style="width:624px; float: left">
<div style="width:500px; float: left">
            <input type="text" id="albumname" size="70"/>
            <input type="button" value="Create Album" onclick="createalbum()" size="20"/>
        
    </div>
    <div style="width:624px; float: left" id="streams">
        
    </div>
    <div style="width:624px; float: left" id="myalbum">
        
    </div>
    
</div>
</div>


<div style="height:600px; width:200px; border:solid 1px; float:right; margin-top:50px;"  >
<div style="width:200px; height:50px;">
<div style="width:50px; height:50px; float:left">
<img src="Blushing_smiley_face.png" height="50" width="50" />
</div>
<div class="headerfont" style="width:150px; height:50px; float:right">
My freniz
</div>

</div>
<?php $frnds1=unserialize($fv['friendlist']);

foreach($frnds1 as $user){
    $results2=mysql_query("select fname,lname from user_info where userid='".$user."'");
while($row3=  mysql_fetch_assoc($results2)){
?>
<div class="innerpic" >
<img src="preview.jpg" height="50" width="50" />
</div>
<div class="innername" >
    <?php echo "<a href='#profile?userid=".$user."'>".$row3['fname']." ".$row3['lname']."</a>"; }?>
</div>
<div class="innername" >
    <?php $results2=mysql_query("select vote from friends_vote where userid='".$user."'"); while($row3=mysql_fetch_assoc($results2)){$votes=unserialize($row3['vote']); echo "Votes :".  sizeof($votes); ?>
</div>
<?php } }mysql_close(); ?>
</div>


</div>

<div id="light3" style="width:550px; height:240px; " class="white_content">
        
       
<div style="width:500px; height:200px; margin-left:20px; margin-top:20px; ">
<div style="width:30px; height:30px; margin-top:5px; margin-left:5px; float:left; ">
To:
</div>
<form name="sendmessage" onsubmit="sendmsguser()">


<div style="width:400px; height:30px; margin-top:6px; margin-left:5px; float:left; ">
    <input size="40" type="text" disabled="disable" name="msgto" value="<?php echo $ud["fname"]." ".$ud["lname"]; ?>"/>
    <input type="hidden" value="<?php echo $_REQUEST['userid']; ?>" name="to"/>
</div>
<div style="width:300px; height:100px; margin-top:10px; margin-left:60px; float:left;">
<textarea rows="4" cols="50" name="msg" >
</textarea>
</div>


<div style="width:300px; ">

  <ul class="roundbuttons sendmessagewidth">
  <li><input type="button" name="cancel" value="cancel" onClick="document.getElementById('light3').style.display='none';   document.getElementById('fade3').style.display='none';"  /></li>
  <li><input type="button" name="send" value="send" onclick="sendmsguser()" /></li>
  </ul>


</div>
</form>
</div>
        
        </div>
		
		<div id="fade3" onClick="document.getElementById('light3').style.display='none';   document.getElementById('fade3').style.display='none'" class="black_overlay">
        </div>


<div id="light4" style="width:550px; height:240px; " class="white_content">
       
        
        </div>
		
		<div id="fade4" onClick="document.getElementById('light4').style.display='none';   document.getElementById('fade4').style.display='none'" class="black_overlay">
        </div>
<div id="light5" style="width:550px; height:240px; " class="white_content">
    <div id="light5_image" style="width:624px;">
        
    </div>
       
    <div id="light5_comments" style="width:624px;">
        
    </div>
        </div>
		
		<div id="fade5" onClick="document.getElementById('light5').style.display='none';   document.getElementById('fade5').style.display='none'" class="black_overlay">
        </div>   