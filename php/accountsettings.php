<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php session_start();
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        
 require_once 'ajax/getminiprofile.php';
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Account Setting</title>
    <script type="text/javascript" src="js/jquery-latest.js"></script> 
    <script type="text/javascript" src="js/accountsettings.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="js/bsn.AutoSuggest_c_2.0.js"></script>

<link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<link href="css/blue-world.css" rel="stylesheet" type="text/css"/>
<link href="css/style.css" rel="stylesheet" />

    <link href="css/tabs.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">

$(document).ready(function(){


$(".moody").toggle(function(){
		$("span-smiley").css("display","block");
		$("span-smiley").css("position","absolute");
	  
		
	},
	function(){ $("span-smiley").css("display","none"); });
	
	$("span-smiley").mouseover(function(){
		$("span-smiley").css("display","block");
		
	});
	
	$(".moody").mouseover(function(){
		$("span-edit").css("display","block");
		
	});
	$(".moody").mouseout(function(){
		$("span-edit").css("display","none");
		
	});

$(".arow").toggle(function(){
		$("span-setting").css("display","block");
		$("span-setting").css("position","absolute");
	  
		
	},
	function(){
		$("span-setting").css("display","none");
		});
	
	$("span-setting").mouseover(function(){
		$("span-setting").css("display","block");
		
	});
	
	
	

});
</script>
<script type="text/javascript">
    function searchitemsin(element) {
      if(element.value=='Search...'){
  	element.value = '';
      }
  
   }
   function searchitemsout(element) {
       if(element.value==''){
   	element.value = 'Search...';}
     }
    </script>
<style>
span-edit{
	width:120px; display:none; position:absolute; top:51px; left:203px; background:#999;
}
span-setting{
	width:150px; display:none; float:right; margin-top:22px; margin-right:-140px; background:#999;
}
.inner-account-set{
	width:600px; background-color:#0FC; height:750px; float:left; 
	 border-radius: 12px ;
	-moz-border-radius: 12px ;
	-webkit-border-radius: 12px ; 
}
.inner-account-set-fav{
	width:600px; background-color:#0FC;  float:left; 
	 border-radius: 12px ;
	-moz-border-radius: 12px ;
	-webkit-border-radius: 12px ; 
}
input{
	 font-size:16px; font-weight:bold;
}

select{
	 font-size:16px; font-weight:bold;
}
textarea{
	 font-size:14px; font-weight:bold;
}
.mood li{
	cursor:pointer;
}
.style{
width:100px;
height:35px;
font-size:20px;
background:#0C3;
cursor:pointer;
-webkit-box-shadow:0 0 4px #000;/*safari and Chrome*/
-moz-box-shadow:0 0 4px #000; /*Mozilla*/
-o-box-shadow:0 0 4px #000; /*Opera*/
-ms-box-shadow:0 0 4px #000; /*Ms IE*/
box-shadow:0 0 4px #000; /*W3C*/
	-webkit-border-radius:15px;/*safari and Chrome*/
-moz-border-radius:15px; /*Mozilla*/
-o-box-border-radius:15px; /*Opera*/
-ms-box-border-radius:15px; /*Ms IE*/
border-radius:15px; /*W3C*/
background-image:-webkit-linear-gradient(top,#ffffff 0%,#0C3 100%);
background-image:-moz-linear-gradient(top,#ffffff 0%,#0C3 100%);
background-image:-o-linear-gradient(top,#ffffff 0%,#0C3 100%);
background-image:-ms-linear-gradient(top,#ffffff 0%,#0C3 100%);
background-image:linear-gradient(top,#ffffff 0%,#0C3 100%);
	}
</style>
</head>
<body>
<div class="headerdiv">
<div style="width:200px; float:left; height:80px; ">
<a style="text-decoration:none; cursor: pointer;" class="headername" href="#">Freniz</a>
</div>
<div style="width:40px; float:left; height:80px; ">
    <div class="moody" style="width:40px; margin-top: 10px; float:left; height:40px; "><img style="marin-top:10px" src="images/mood/<?php echo $_SESSION['mood'];?>" width="40" height="40"/></div>
<span-edit>
Click to Change
</span-edit>
  <span-smiley id="mood-smile">

<ul class="mood">
<li><img src="images/mood/32/6smiley_face.gif" onclick="updatemood('6smiley_face.gif.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/130.png" onclick="updatemood('130.png');document.getElementById('mood-smile').style.display='none'" /></li>
<li><img src="images/mood/32/22461291.png" onclick="updatemood('22461291.png');document.getElementById('mood-smile').style.display='none'" /></li>
<li><img src="images/mood/32/angel.png" onclick="updatemood('angel.png');document.getElementById('mood-smile').style.display='none'" /></li>
<li><img src="images/mood/32/att.png" onclick="updatemood('att.png');document.getElementById('mood-smile').style.display='none'" /></li>
<li><img  src="images/mood/32/att2.png" onclick="updatemood('att2.png');document.getElementById('mood-smile').style.display='none'" /></li>
<li><img src="images/mood/32/cas.png" onclick="updatemood('cas.png');document.getElementById('mood-smile').style.display='none'" /></li>
<li><img src="images/mood/32/cry.gif" onclick="updatemood('2cry.gif');document.getElementById('mood-smile').style.display='none'" /></li>
<li><img src="images/mood/32/cry1.png" onclick="updatemood('cry1.png');document.getElementById('mood-smile').style.display='none'" /></li>
<li><img src="images/mood/32/cry2.png" onclick="updatemood('cry2.png');document.getElementById('mood-smile').style.display='none'" /></li>
<li><img src="images/mood/32/cry3.png" onclick="updatemood('cry3.png');document.getElementById('mood-smile').style.display='none'" /></li>
<li><img src="images/mood/32/irritate.png" onclick="updatemood('irritate.png');document.getElementById('mood-smile').style.display='none'" /></li>
<li><img src="images/mood/32/kiss.png" onclick="updatemood('kiss.png');document.getElementById('mood-smile').style.display='none'" /></li>
<li><img src="images/mood/32/love.png" onclick="updatemood('love.png');document.getElementById('mood-smile').style.display='none'" /></li>
<li><img src="images/mood/32/love2.png" onclick="updatemood('love2.png');document.getElementById('mood-smile').style.display='none'" /></li>
<li><img src="images/mood/32/love3.png" onclick="updatemood('love3.png');document.getElementById('mood-smile').style.display='none'" /></li>
<li><img src="images/mood/32/love4.png" onclick="updatemood('love4.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/love5.png" onclick="updatemood('love5.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/love.6png.png" onclick="updatemood('love.6png.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/nospeak.png" onclick="updatemood('nospeak.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/prirate.png" onclick="updatemood('prirate.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/resign.png" onclick="updatemood('resign.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/sad.png" onclick="updatemood('sad.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img  src="images/mood/32/sad1.png" onclick="updatemood('sad1.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/sad2.png" onclick="updatemood('sad2.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/sad3.png" onclick="updatemood('sad3.png');document.getElementById('mood-smile').style.display='none'" /></li>
<li><img src="images/mood/32/sad4.png" onclick="updatemood('sad4.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/sad5.png" onclick="updatemood('sad5.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/Sad06.gif" onclick="updatemood('Sad06.gif');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/shut.png" onclick="updatemood('shut.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/shut1.png" onclick="updatemood('shut1.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/sleep.png" onclick="updatemood('sleep.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/sleep2.png" onclick="updatemood('sleep2.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/sm2.png" onclick="updatemood('sm2.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/sm3.png" onclick="updatemood('sm3.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/sm4.png" onclick="updatemood('sm4.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/sm5.png" onclick="updatemood('sm5.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/sm6.png" onclick="updatemood('sm6.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/sm7.png" onclick="updatemood('sm7.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/happy.png" onclick="updatemood('happy.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/sm9.png" onclick="updatemood('sm9.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/smile.png" onclick="updatemood('smile.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/smile2.png" onclick="updatemood('smile2.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/smile3.png" onclick="updatemood('smile3.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/SmileyCoffeeTired.jpg" onclick="updatemood('SmileyCoffeeTired.jpg');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/smiley-sad.png" onclick="updatemood('smiley-sad.png');document.getElementById('mood-smile').style.display='none'"/></li>
<li><img src="images/mood/32/stop.png" onclick="updatemood('stop.png');document.getElementById('mood-smile').style.display='none'"/></li>
</ul>



</span-smiley>
    
</div>
<div style=" float:left; height:80px; ">
<div id="top-menu-bar" style="height:30px; margin-top: 20px; margin-left: 30px;  float:left; ">
<ul id="menu">
  <li><a class="user-navigate" href="profile.php?userid=<?php echo $_SESSION['userid']; ?>">Streams</a></li>
  <li><a class="user-navigate" href="profile.php?userid=<?php echo $_SESSION['userid']; ?>">Biog</a>
  </li>
  <li><a class="user-navigate" href="message.php">Messages</a>
   </li>
   <li><a class="user-navigate" href="invitations.php">Alert</a>
   </li>
    <li><a class="user-navigate" href="profile.php?userid=<?php echo $_SESSION['userid']; ?>&tab=blogs">Blog</a>
   </li> 
  <li><a href="">Apps</a>
    <ul>
    <li><a class="user-navigate" href="">Music</a></li>
    <li><a class="user-navigate" href="dairy.php">Diary</a></li>
    <li><a class="user-navigate" href="slambook.php?userid=<?php echo $_SESSION['userid']; ?>">Slambook</a></li>
    </ul>
  </li>
</ul>
</div>

</div>
<div style=" width: 250px; margin-right: 10px; float:right; height:80px; ">
<div class="popup" style=" float:right; font-weight: bold; color: #fff; height:40px;">
  <div style="width:32px; height:32px; float:left; ">
<a class="arow"></a>
<span-setting>
<div style="background-image:url(/images/prettyGallery/arrow.png); margin-top:-7px; width:20px; height:6px; float:right"></div>
<ul><li><a class="user-navigate" href="accountsettings.php">Account settings</a></li>
<li><a class="user-navigate" href="#2">Privacy settings</a></li>
</ul>

<div style="width:150px; height:20px; background-color:#6699FF">
<a id="letmeout" href="#3" >Letme out</a></div>
</span-setting>
</div> 


<div style=" float:left; margin-top: 5px; font-size:16px;  font-weight:bold;">
    <center><?php echo $_SESSION['username']; ?></center>
</div>




</div>
<div style="width:200px; float:left; height:20px; ">
<input class="search-box" id="searchusers"  type="text" value="Search..." onfocusout="searchitemsout(this)" onfocus="searchitemsin(this)" style="width:200px; height:20px" />
</div>
</div>


</div>
<div style=" width:900px; margin-left:auto; margin-right:auto; ">
<ol id="toc">
    <li><a href="#page-1"><span>Basic details</span></a></li>
    <li><a href="#page-2"><span>Education & Occupation</span></a></li>
    <li><a href="#page-3"><span>Favourites</span></a></li>
    <li><a href="#page-4"><span>PersonalInfo</span></a></li>
</ol>
<div class="content" style=" background-color:#CFC; width:600px; height:800px" id="page-1">
    
    <div class="inner-account-set" >
        
<div style="width:600px; margin-left:20px; margin-top:30px; font-size:18px; font-weight:bold; height:40px; float:left; ">
    Name:<input type="text" value="<?php echo $_SESSION['fname']; ?>" id="fname" name="fname" />
    <input type="text" value="<?php echo $_SESSION['lname']; ?>" id="lname" name="lname" />

</div>
<div style="width:600px; float:left; border:solid 1px #FFF ">
</div>
<div style="width:600px; margin-left:20px; margin-top:30px; font-size:18px; font-weight:bold; height:40px; float:left;">
    <?php $bdd;$bdy;$bdm;
    if(isset($_SESSION['dob']))
    {
        $bdd=substr($_SESSION['dob'], 8,2);
        $bdy=substr($_SESSION['dob'], 0,4);
        $bdm=substr($_SESSION['dob'], 5,2);
    }
    ?>
    
    D.O.B:<select class="" id="bdm" name="birthday_month"><?php if(isset($bdm)) { ?><option value="">Month:</option><?php } ?>
<option <?php if(isset($bdm)) { if($bdm=="01") echo "selected"; } ?> value="1">Jan</option>
<option <?php if(isset($bdm)) { if($bdm=="02") echo "selected"; } ?> value="2">Feb</option>
<option <?php if(isset($bdm)) { if($bdm=="03") echo "selected"; } ?> value="3">Mar</option>
<option <?php if(isset($bdm)) { if($bdm=="04") echo "selected"; } ?> value="4">Apr</option>
<option  <?php if(isset($bdm)) { if($bdm=="05") echo "selected"; } ?> value="5">May</option>
<option <?php if(isset($bdm)) { if($bdm=="06") echo "selected"; } ?>  value="6">Jun</option>
<option <?php if(isset($bdm)) { if($bdm=="07") echo "selected"; } ?>  value="7">Jul</option>
<option <?php if(isset($bdm)) { if($bdm=="08") echo "selected"; } ?>  value="8">Aug</option>
<option <?php if(isset($bdm)) { if($bdm=="09") echo "selected"; } ?>  value="9">Sep</option>
<option <?php if(isset($bdm)) { if($bdm=="10") echo "selected"; } ?>  value="10">Oct</option>

<option <?php if(isset($bdm)) { if($bdm=="11") echo "selected"; } ?>  value="11">Nov</option>
<option <?php if(isset($bdm)) { if($bdm=="12") echo "selected"; } ?>  value="12">Dec</option>
</select> <select name="birthday_day" id="bdd"  onchange="bagofholding" autocomplete="off"><option value="">Day:</option>
<?php for($i=1;$i<=31;$i++){ ?>
    <option <?php if(isset($bdd)) { if(intval($bdd)==$i) echo "selected"; } ?>  value="<?php echo $i ?>"><?php echo $i ?></option><?php }?>
</select> <select name="birthday_year" id="bdy"  autocomplete="off"><option value="-1">Year:</option>
    <?php for($i=2012;$i>=1905;$i--){ ?>
<option <?php if(isset($bdy)) { if(intval($bdy)==$i) echo "selected"; } ?> value="<?php echo $i ?>"><?php echo $i ?></option><?php }?>

</select>

</div>
<div style="width:600px; float:left; border:solid 1px #FFF ">
</div>
<div style="width:600px; margin-left:20px; margin-top:30px; font-size:18px; font-weight:bold; height:40px; float:left; ">
    Sex:<select class="select" name="sex" id="sex"><?php if(!isset($_SESSION['sex'])){  ?><option value="0">Select Sex:</option><?php } ?><option <?php if(isset($_SESSION['sex'])){ if($_SESSION['sex']=="female") echo "selected"; } ?> value="1">Female</option><option <?php if(isset($_SESSION['sex'])){ if($_SESSION['sex']=="male") echo "selected"; } ?> value="2">Male</option></select>
</div>
<div style="width:600px; float:left; border:solid 1px #FFF ">
</div>
<div style="width:600px; margin-left:20px; margin-top:30px; font-size:18px; font-weight:bold; height:40px; float:left; ">
    Religious:<input type="text" value="<?php if(isset($_SESSION['religion'])) echo $_SESSION['religion']; ?>" id="religious" name="religious" />
</div>
<div style="width:600px; float:left; border:solid 1px #FFF ">
</div>
<div style="width:600px; margin-left:20px; margin-top:30px; font-size:18px; font-weight:bold; height:40px; float:left; ">
Status:<select class="select" name="Status" id="status"><?php if(isset($_SESSION['rstatus'])) { ?><option value="">Select status:</option><?php } ?><option <?php if(isset($_SESSION['rstatus'])){ if($_SESSION['rstatus']=="single") echo "selected"; } ?> value="single">Single</option><option <?php if(isset($_SESSION['rstatus'])){ if($_SESSION['rstatus']=="commited") echo "selected"; } ?> value="commited">commited</option><option <?php if(isset($_SESSION['rstatus'])){ if($_SESSION['rstatus']=="married") echo "selected"; } ?> value="married">Married</option></select>
</div>
<div style="width:600px; float:left; border:solid 1px #FFF ">
</div>
<div style="width:600px; margin-left:20px; margin-top:30px; font-size:18px; font-weight:bold; height:60px; float:left;">
Language:<textarea id="language" name="langauge" style="width:200px;  height:40px;"></textarea>
<div style="width:100px; height:40px; float:right; ">
 <ul class="roundbuttons" style="margin-right:60px">
        <li><a onclick='addlanguages(document.getElementById("language").value)'>Update</a></li>
        </ul>
</div>
</div>
<div style="width:600px; float:left; border:solid 1px #FFF ">
</div>
<div style="width:600px; margin-left:20px; margin-top:30px; font-size:18px; font-weight:bold; height:40px; float:left;">
Current city:<input type="text" value="<?php if(isset($_SESSION['currentcity'])) echo $_SESSION['currentcity']; ?>" id="ccity" name="currentcity" />

</div>
<div style="width:600px; float:left; border:solid 1px #FFF ">
</div>
<div style="width:600px; margin-left:20px; margin-top:30px; font-size:18px; font-weight:bold; height:40px; float:left; ">
Hometown:<input type="text" value="<?php if(isset($_SESSION['hometown'])) echo $_SESSION['hometown']; ?>" id="htown" name="hometown" />

</div>
<div style="width:600px; float:left; border:solid 1px #FFF ">
</div>

<div class="set-per" style="width:100px; height:40px;  float:right; ">
<button onclick="basicaccount()" class="style">
Save
</button>
 
</div>
       
</div>


    
    
    
</div>



<div class="content" style="height:800px; background-color:#CFC; width:600px" id="page-2">
    <div class="inner-account-set" >
<div style="width:500px; margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold;  float:left;">
School:<input type="text" value="" id="school" size="40px"/>
<div style="width:500px; height:60px; float:left; border:solid 1px">
</div>

<div class="set-edu" style="width:50px; margin-right:-30px;  height:40px; float:right; ">

 <ul style="">
     <li><a onclick='addschools(document.getElementById("school").value)'>Update</a></li>
        </ul>
</div>
</div>
<div style="width:600px; float:left; border:solid 1px #FFF ">
</div>


<div style="width:500px; margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold;  float:left;">
College:<input type="text" value="" id="college" size="40px"/>
<div style="width:500px; height:60px; float:left; border:solid 1px">
</div>

<div class="set-edu" style="width:50px; margin-right:-30px;  height:40px; float:right; ">
 <ul style="">
      <li><a onclick='addcolleges(document.getElementById("college").value)'>Update</a></li>
        </ul>
</div>
</div>
<div style="width:600px; float:left; border:solid 1px #FFF ">
</div>


<div style="width:500px; margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold;  float:left;">
Employer:<input type="text" value="" id="employer" size="40px"/>
<div style="width:500px; height:60px; float:left; border:solid 1px">
</div>

<div class="set-edu" style="width:50px; margin-right:-30px;  height:40px; float:right; ">
 <ul style="">
      <li><a onclick="basiceducation(document.getElementById('employer').value)">Update</a></li>
        </ul>
</div>
</div>
<div style="width:600px; float:left; border:solid 1px #FFF ">
</div>


    </div>
</div>



<div class="content" style="height:1680px; background-color:#CFC; width:600px "  id="page-3">
    <div class="inner-account-set-fav" >
<div style="width:700px; margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold;  float:left; ">
    Book:<input type="text" value="" id="books"  size="40"/>
<ul style="width:500px; display: inline-block;  height:135px; float:left; border:solid 1px; overflow: hidden">
    <?php foreach($_SESSION['books'] as $leaf){
        $result=mysql_query("select pagename,pagepic,vote from pages where pageid='".$leaf."'");
        while($row=mysql_fetch_assoc($result)){ ?>
    <li style='display: inline-block;'>
        <div style="height:75px; width:75px; border:solid 1px">
            <image src="images/75/75_<?php echo imageurl($row['pagepic']); ?>" height="75" width="75"/>
</div>
        <div style="height:20px;width:75px;  font-size:14px; font-weight:bold; overflow: hidden">
            <?php echo $row['pagename']; ?>
        </div>
<div style="height:40px;  font-size:14px; font-weight:bold; width:75px;">
<?php $votes=unserialize($row['vote']);echo "votes(".sizeof($votes).")"; ?><br/>
    <a onclick="removefav('<?php echo $leaf ?>','books')">remove</a>
</div>
    </li>
    <?php }
    } ?>
</ul>


</div>
<div style="width:700px;margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold; float:left; ">
Music Album:<input type="text" value="" id="musicalbum" size="40px"/>
<ul style="width:500px; display: inline-block;  height:135px; float:left; border:solid 1px; overflow: hidden">
    <?php foreach($_SESSION['musics'] as $leaf){
        $result=mysql_query("select pagename,pagepic,vote from pages where pageid='".$leaf."'");
        while($row=mysql_fetch_assoc($result)){ ?>
    <li style='display: inline-block;'>
        <div style="height:75px; width:75px; border:solid 1px">
            <image src="images/75/75_<?php echo imageurl($row['pagepic']); ?>" height="75" width="75"/>
</div>
        <div style="height:20px;width:75px; overflow: hidden">
            <?php echo $row['pagename']; ?>
        </div>
<div style="height:40px; width:75px;">
<?php $votes=unserialize($row['vote']);echo "votes : ".  sizeof($votes); ?><br/>
    <a onclick="removefav('<?php echo $leaf ?>','musics')">remove</a>
</div>
    </li>
    <?php }
    } ?>
</ul>


</div>
<div style="width:700px; margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold;  float:left; ">
Movies:<input type="text" value="" id="movies" size="40px"/>
<ul style="width:500px; display: inline-block;  height:135px; float:left; border:solid 1px; overflow: hidden">
    <?php foreach($_SESSION['movies'] as $leaf){
        $result=mysql_query("select pagename,pagepic,vote from pages where pageid='".$leaf."'");
        while($row=mysql_fetch_assoc($result)){ ?>
    <li style='display: inline-block;'>
        <div style="height:75px; width:75px; border:solid 1px">
            <image src="images/75/75_<?php echo imageurl($row['pagepic']); ?>" height="75" width="75"/>
</div>
        <div style="height:20px;width:75px; overflow: hidden">
            <?php echo $row['pagename']; ?>
        </div>
<div style="height:40px; width:75px;">
<?php $votes=unserialize($row['vote']);echo "votes : ".  sizeof($votes); ?><br/>
    <a onclick="removefav('<?php echo $leaf ?>','movies')">remove</a>
</div>
    </li>
    <?php }
    } ?>
</ul>

</div>
<div style="width:700px;margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold;  float:left; ">
Celebrities:<input type="text" value="" id="celebrities" size="40px"/>
<ul style="width:500px; display: inline-block;  height:135px; float:left; border:solid 1px; overflow: hidden">
    <?php foreach($_SESSION['celebrities'] as $leaf){
        $result=mysql_query("select pagename,pagepic,vote from pages where pageid='".$leaf."'");
        while($row=mysql_fetch_assoc($result)){ ?>
    <li style='display: inline-block;'>
        <div style="height:75px; width:75px; border:solid 1px">
            <image src="images/75/75_<?php echo imageurl($row['pagepic']); ?>" height="75" width="75"/>
</div>
        <div style="height:20px;width:75px; overflow: hidden">
            <?php echo $row['pagename']; ?>
        </div>
<div style="height:40px; width:75px;">
<?php $votes=unserialize($row['vote']);echo "votes : ".  sizeof($votes); ?><br/>
    <a onclick="removefav('<?php echo $leaf ?>','celebrities')">remove</a>
</div>
    </li>
    <?php }
    } ?>
</ul>

</div>
<div style="width:700px;  margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold;  float:left; ">
Games:<input type="text" value="" id="games" size="40px"/>
<ul style="width:500px; display: inline-block;  height:135px; float:left; border:solid 1px; overflow: hidden">
    <?php foreach($_SESSION['games'] as $leaf){
        $result=mysql_query("select pagename,pagepic,vote from pages where pageid='".$leaf."'");
        while($row=mysql_fetch_assoc($result)){ ?>
    <li style='display: inline-block;'>
        <div style="height:75px; width:75px; border:solid 1px">
            <image src="images/75/75_<?php echo imageurl($row['pagepic']); ?>" height="75" width="75"/>
</div>
        <div style="height:20px;width:75px; overflow: hidden">
            <?php echo $row['pagename']; ?>
        </div>
<div style="height:40px; width:75px;">
<?php $votes=unserialize($row['vote']);echo "votes : ".  sizeof($votes); ?><br/>
    <a onclick="removefav('<?php echo $leaf ?>','games')">remove</a>
</div>
    </li>
    <?php }
    } ?>
</ul>
</div>
<div style="width:700px; margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold;  float:left;">
Sports:<input type="text" value="" id="sports" size="40px"/>
<ul style="width:500px; display: inline-block;  height:135px; float:left; border:solid 1px; overflow: hidden">
    <?php foreach($_SESSION['sports'] as $leaf){
        $result=mysql_query("select pagename,pagepic,vote from pages where pageid='".$leaf."'");
        while($row=mysql_fetch_assoc($result)){ ?>
    <li style='display: inline-block;'>
        <div style="height:75px; width:75px; border:solid 1px">
            <image src="images/75/75_<?php echo imageurl($row['pagepic']); ?>" height="75" width="75"/>
</div>
        <div style="height:20px;width:75px; overflow: hidden">
            <?php echo $row['pagename']; ?>
        </div>
<div style="height:40px; width:75px;">
<?php $votes=unserialize($row['vote']);echo "votes : ".  sizeof($votes); ?><br/>
    <a onclick="removefav('<?php echo $leaf ?>','sports')">remove</a>
</div>
    </li>
    <?php }
    } ?>
</ul>

</div>
<div style="width:700px; margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold;  float:left; ">
Others:<input type="text" value="" id="others" size="40px"/>
<ul style="width:500px; display: inline-block;  height:135px; float:left; border:solid 1px; overflow: hidden">
    <?php foreach($_SESSION['other'] as $leaf){
        $result=mysql_query("select pagename,pagepic,vote from pages where pageid='".$leaf."'");
        while($row=mysql_fetch_assoc($result)){ ?>
    <li style='display: inline-block;'>
        <div style="height:75px; width:75px; border:solid 1px">
            <image src="images/75/75_<?php echo imageurl($row['pagepic']); ?>" height="75" width="75"/>
</div>
        <div style="height:20px;width:75px; overflow: hidden">
            <?php echo $row['pagename']; ?>
        </div>
<div style="height:40px; width:75px;">
<?php $votes=unserialize($row['vote']);echo "votes : ".  sizeof($votes); ?><br/>
    <a onclick="removefav('<?php echo $leaf ?>','other')">remove</a>
</div>
    </li>
    <?php }
    } ?>
</ul
></div>

</div>

</div>

<div class="content" style=" float:left; background-color:#CFC; width:600px; height:1000px" id="page-4">
    
    <div class="inner-account-set-fav" ">
        <?php $personalinfo = unserialize($_SESSION['userdetails']['personalinfo'])?>
        
<div style="width:600px;  margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold; float:left; ">
 <table>
        <tr><td>
    Body:</td><td><textarea id="body_tpe" name="body_type" style="width:500px; height:40px"><?php if(isset( $personalinfo['body'])) echo $personalinfo['body']; ?></textarea>
  
       </td></tr>
   </table>
 </div>
<div style="width:600px; float:left; margin-top:10px; border:solid 1px #FFF ">
</div>

        <div style="width:600px;  margin-left:20px; margin-top:30px;    font-size:18px; font-weight:bold; height:40px; float:left;">
          <table>
        <tr><td>
    Look:</td><td><textarea  id="look_tpe" name="look_type" style="width:500px; height:40px"><?php if(isset( $personalinfo['look'])) echo $personalinfo['look']; ?></textarea>
       </td></tr>
   </table>

 </div>
<div style="width:600px; float:left; margin-top:10px; border:solid 1px #FFF ">
</div>
        <div style="width:600px;  margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold; float:left; ">
         <table>
        <tr><td>
    Ethicity:</td><td><textarea id="ethnicity_tpe" name="ethnicity_type"  style="width:480px; height:40px"><?php if(isset( $personalinfo['ethnicity'])) echo $personalinfo['ethnicity']; ?></textarea>
     </td></tr>
   </table>

 </div>
 <div style="width:600px; float:left; margin-top:10px; border:solid 1px #FFF ">
</div>
        <div style="width:600px;  margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold; float:left; ">
         <table>
        <tr><td>
    Smoking:</td><td><textarea id="smoke_tpe" name="smoke_type"  style="width:470px; height:40px"><?php if(isset( $personalinfo['smoke'])) echo $personalinfo['smoke']; ?></textarea>
     </td></tr>
   </table>


</div>
        <div style="width:600px; float:left; margin-top:10px; border:solid 1px #FFF ">
</div>
       <div style="width:600px;  margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold; float:left; ">
        <table>
        <tr><td>
    Drinking:</td><td><textarea id="drink_tpe" name="drink_type" style="width:470px; height:40px"><?php if(isset( $personalinfo['drink'])) echo $personalinfo['drink']; ?></textarea>
      </td></tr>
   </table>


</div>
      <div style="width:600px; float:left; margin-top:10px; border:solid 1px #FFF ">
</div>
       <div style="width:600px;  margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold; float:left; ">
       <table>
        <tr><td>
    Pet:</td><td><textarea id="pet_tpe" name="pet_type" style="width:500px; height:40px"><?php if(isset( $personalinfo['pets'])) echo $personalinfo['pets']; ?></textarea>
   </td></tr>
   </table>

</div>
      <div style="width:600px; float:left; margin-top:10px; border:solid 1px #FFF ">
</div>
       <div style="width:600px;  margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold; float:left; ">
        <table>
        <tr><td>
    Sexual:</td><td><textarea id="sexual_tpe" name="sexual_type" style="width:200px; height:40px"><?php if(isset( $personalinfo['sexual'])) echo $personalinfo['sexual']; ?></textarea>
   
</td></tr>
   </table>
</div><div style="width:600px; float:left; margin-top:10px; border:solid 1px #FFF ">
</div>
        <div style="width:600px;  margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold; float:left; ">
         <table>
        <tr><td>
    Humor:</td><td> <textarea  id="humor_tpe" name="humor_type" style="width:480px; height:40px"><?php if(isset( $personalinfo['humor'])) echo $personalinfo['humor']; ?></textarea>
   
</td></tr>
   </table>
</div>
<div style="width:600px; float:left; margin-top:10px; border:solid 1px #FFF ">
</div>
       <div style="width:600px;  margin-left:20px; margin-top:30px;  font-size:18px; font-weight:bold; float:left; ">
       <table>
        <tr><td> Passions:</td><td><textarea id="passion_tpe" name="passion_type" style="width:456px; height:40px"><?php if(isset( $personalinfo['passion'])) echo $personalinfo['passion']; ?></textarea></td></tr>
   </table>

</div>
<div style="width:600px; float:left; margin-top:10px; border:solid 1px #FFF ">
</div>
<div class="set-per" >


<button onclick="personalinfo()" class="style">
Save
</button> 

</div>
       
</div>

</div>



    
    
    
<script src="js/activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables('page', ['page-1', 'page-2', 'page-3','page-4']);
</script>
<script type="text/javascript">
	var options_xml = function(type,category,appendto){
     if(!appendto)
        appendto='body';   
     var options={
                script:"ajax/search.php?type="+type+"&category="+category+"&",
		varname:"key",
                category:category,
                type:type,
                appendto:appendto
            };
            return options;
	}
	
        var as_xml = new AutoSuggest('books', options_xml('pages','books'));
        var as_xml1 = new AutoSuggest('musicalbum', options_xml('pages','musics'));
        var as_xml2 = new AutoSuggest('movies', options_xml('pages','movies'));
        var as_xml3 = new AutoSuggest('celebrities', options_xml('pages','celebrities'));
        var as_xml4 = new AutoSuggest('games', options_xml('pages','games'));
        var as_xml5 = new AutoSuggest('sports', options_xml('pages','sports'));
        var as_xml6 = new AutoSuggest('others', options_xml('pages','other'));
        
</script>
</div>
</body>
</html>
