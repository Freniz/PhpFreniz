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
    $ud;$fv;$votes;$privacy;
    mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
    mysql_select_db("fztest1") or die ("coudnt find database");    
    if(isset($_SESSION['userid']))
        {
        $results=mysql_query("select profiletype,fname,lname,dob,sex,school,college,email,hometown,currentcity,language,rstatus,employer,religion,myphilosophy,state,country,propic,pinnedpic,books,musics,movies,celebrities,games,sports,other,playlist,mood,secondarypic1,secondarypic2,propicalbum,adminpages,url,pt,blocklist,blockedby from user_info where userid='".$_REQUEST['userid']."'");
        while($row=  mysql_fetch_assoc($results))
        {
        $ud=$row;
        $results1=mysql_query("select friendlist,vote from friends_vote where userid='".$_REQUEST['userid']."'");
        while($row1=  mysql_fetch_assoc($results1))
        {
        $fv=$row1;
        $votes=unserialize($fv['vote']);
        }
        $results2=mysql_query("select contactdetails,religion,dob,aboutme,relationship,livingin,hometown,languages,education,occupation,friendlist,status,fav,message,request,invite from privacy where userid='".$_REQUEST['userid']."'");
        
        while($row2=  mysql_fetch_assoc($results2))
        {
            $privacy=$row2;
        }
        }
        }
        else
            header("location:login.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta charset="UTF-8">
<title>Freniz - <?php echo $ud['fname'].' '.$ud['lname']; ?></title>
<link href="css/blue-world.css" rel="stylesheet" type="text/css"/>










<link rel="stylesheet" href="css/prettyGallery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		
		<script src="http://www.google.com/jsapi" type="text/javascript"></script>
		<script type="text/javascript" charset="utf-8">
			google.load("jquery", "1.5.1");
		</script>
		<script src="js/jquery.prettyGallery.js" type="text/javascript" charset="utf-8"></script>












<link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />


<style>
    .set-mood-today{
    
    }
    .set-mood-today ul{
        display:block;
        width: 400px;
        height: 200px;
    }
    .set-mood-today ul li{
        display: inline;
    }
</style>


<script type="text/javascript">
var i;
$(document).ready(function(){

$(".arow").mouseout(function(){
$(".popup span").css("display","none");
clearInterval(i);
});
$(".popup span").mouseout(function(){
$(".popup span").css("display","none");
});
$(".popup span").mouseover(function(){
$(".popup span").css("display","inline");
clearInterval(i);
});
$(".arow").mouseover(function(){
  $(".popup span").css("top","25px");
  $(".popup span").css("display","inline");
   $(".popup span").css("width","400px");
    $(".popup span").css("height","300px");
  
    $(".popup span").css("position","absolute");
	 $(".popup span").css("background-color","#E4EAE6");
	 $(".popup span").css("border","solid 2px");
   $(".popup span").css("right","14px");
     i=setInterval(function(){$(".popup span").css("display","none");},3000);
});
});
</script>
</head>

<body>
    <div class="headerdiv">
<div style="width:200px; float:left; height:80px; ">
<a style="text-decoration:none; cursor: pointer;" class="headername" href="#">Freniz</a>
</div>
<div style="width:40px; float:left; height:80px; ">
    <div style="width:40px; margin-top: 10px; float:left; height:40px; "><img style="marin-top:10px" src="images/mood/<?php echo $_SESSION['mood'];?>" width="40" height="40"/></div>

  
    
</div>
<div style=" float:left; height:80px; ">
<div id="top-menu-bar" style="height:30px; margin-top: 20px; margin-left: 30px;  float:left; ">
<ul id="menu">
  <li><a href="profile.php?userid=<?php echo $_SESSION['userid']; ?>">Streams</a></li>
  <li><a href="profile.php?userid=<?php echo $_SESSION['userid']; ?>">Biog</a>
  </li>
  <li><a href="message.php">Messages</a>
   </li>
   <li><a href="invitations.php">Alert</a>
   </li>
    <li><a href="profile.php?userid=<?php echo $_SESSION['userid']; ?>&tab=blogs">Blog</a>
   </li> 
  <li><a href="">Apps</a>
    <ul>
    <li><a href="">Music</a></li>
    <li><a href="dairy.php">Diary</a></li>
    <li><a href="slambook.php?userid=<?php echo $_SESSION['userid']; ?>">Slambook</a></li>
    </ul>
  </li>
</ul>
</div>

</div>
<div style=" width: 250px; margin-right: 10px; float:right; height:80px; ">
<div style=" float:right; font-weight: bold; color: #fff; height:40px;">
   
<div class="popup" style=" float:left; ">
<div style=" float:left; margin-top: 5px; font-size:16px;  font-weight:bold;">
    <center><?php echo $_SESSION['username']; ?></center>
</div>
<div style="width:32px; position: relative; height:32px; float:right; ">
<a class="arow"></a>
<span>
<div class="set-mood-today" style="width:300px;  height:200px; ">
<ul class="mood" style=" overflow-y:scroll">
<li><img src="images/mood/6smiley_face.gif" onclick="updatemood('6smiley_face.gif.png')"/></li>
<li><img src="images/mood/130.png" onclick="updatemood('130.png')" /></li>
<li><img src="images/mood/22461291.png" onclick="updatemood('22461291.png')" /></li>
<li><img src="images/mood/angel.png" onclick="updatemood('angel.png')" /></li>
<li><img src="images/mood/att.png" onclick="updatemood('att.png')" /></li>
<li><img  src="images/mood/att2.png" onclick="updatemood('att2.png')" /></li>
<li><img src="images/mood/cas.png" onclick="updatemood('cas.png')" /></li>
<li><img src="images/mood/cry.gif" onclick="updatemood('2cry.gif')" /></li>
<li><img src="images/mood/cry1.png" onclick="updatemood('cry1.png')" /></li>
<li><img src="images/mood/cry2.png" onclick="updatemood('cry2.png')" /></li>
<li><img src="images/mood/cry3.png" onclick="updatemood('cry3.png')" /></li>
<li><img src="images/mood/irritate.png" onclick="updatemood('irritate.png')" /></li>
<li><img src="images/mood/kiss.png" onclick="updatemood('kiss.png')" /></li>
<li><img src="images/mood/love.png" onclick="updatemood('love.png')" /></li>
<li><img src="images/mood/love2.png" onclick="updatemood('love2.png')" /></li>
<li><img src="images/mood/love3.png" onclick="updatemood('love3.png')" /></li>
<li><img src="images/mood/love4.png" onclick="updatemood('love4.png')"/></li>
<li><img src="images/mood/love5.png" onclick="updatemood('love5.png')"/></li>
<li><img src="images/mood/love.6png.png" onclick="updatemood('love.6png.png')"/></li>
<li><img src="images/mood/nospeak.png" onclick="updatemood('nospeak.png')"/></li>
<li><img src="images/mood/prirate.png" onclick="updatemood('prirate.png')"/></li>
<li><img src="images/mood/resign.png" onclick="updatemood('resign.png')"/></li>
<li><img src="images/mood/sad.png" onclick="updatemood('sad.png')"/></li>
<li><img  src="images/mood/sad1.png" onclick="updatemood('sad1.png')"/></li>
<li><img src="images/mood/sad2.png" onclick="updatemood('sad2.png')"/></li>
<li><img src="images/mood/sad3.png" onclick="updatemood('sad3.png')" /></li>
<li><img src="images/mood/sad4.png" onclick="updatemood('sad4.png')"/></li>
<li><img src="images/mood/sad5.png" onclick="updatemood('sad5.png')"/></li>
<li><img src="images/mood/Sad06.gif" onclick="updatemood('Sad06.gif')"/></li>
<li><img src="images/mood/shut.png" onclick="updatemood('shut.png')"/></li>
<li><img src="images/mood/shut1.png" onclick="updatemood('shut1.png')"/></li>
<li><img src="images/mood/sleep.png" onclick="updatemood('sleep.png')"/></li>
<li><img src="images/mood/sleep2.png" onclick="updatemood('sleep2.png')"/></li>
<li><img src="images/mood/sm2.png" onclick="updatemood('sm2.png')"/></li>
<li><img src="images/mood/sm3.png" onclick="updatemood('sm3.png')"/></li>
<li><img src="images/mood/sm4.png" onclick="updatemood('sm4.png')"/></li>
<li><img src="images/mood/sm5.png" onclick="updatemood('sm5.png')"/></li>
<li><img src="images/mood/sm6.png" onclick="updatemood('sm6.png')"/></li>
<li><img src="images/mood/sm7.png" onclick="updatemood('sm7.png')"/></li>
<li><img src="images/mood/happy.png" onclick="updatemood('happy.png')"/></li>
<li><img src="images/mood/sm9.png" onclick="updatemood('sm9.png')"/></li>
<li><img src="images/mood/smile.png" onclick="updatemood('smile.png')"/></li>
<li><img src="images/mood/smile2.png" onclick="updatemood('smile2.png')"/></li>
<li><img src="images/mood/smile3.png" onclick="updatemood('smile3.png')"/></li>
<li><img src="images/mood/SmileyCoffeeTired.jpg" onclick="updatemood('SmileyCoffeeTired.jpg')"/></li>
<li><img src="images/mood/smiley-sad.png" onclick="updatemood('smiley-sad.png')"/></li>
<li><img src="images/mood/stop.png" onclick="updatemood('stop.png')"/></li>
</ul>

<div >

</span>
</div>

</div>

</div>
<div style="width:200px; float:left; height:20px; ">
<input class="search-box" id="searchusers"  type="text" value="Search..." onfocusout="searchitemsout(this)" onfocus="searchitemsin(this)" style="width:200px; height:20px" />
</div>
</div>


</div>
<div id='maincontainer' style="width:100%; height:100%; float:left; border:solid 1px">
<a onclick="document.getElementById('light1').style.display='block';document.getElementById('fade1').style.display='block';">Add Me</a>



</div>
    

    <div id="light1" class="white_content" style="width:410px; height:230px; border:solid 6px">
</div>
<div id="fade1" onClick="document.getElementById('light1').style.display='none';  document.getElementById('fade1').style.display='none'" class="black_overlay">
        </div>
       
   
</body>
</html>
