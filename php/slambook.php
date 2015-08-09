<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once("ajax/getminiprofile.php");
?>

<html>
  <head>
    <title>Slam Book</title>

<link rel="stylesheet" href="style.css" type="text/css" charset="utf-8"/>
       <script type="text/javascript" src="js/jquery-latest.js"></script> 

<!-- Page Flip -->
<script type="text/javascript" src="js/pageflip.js"></script>

<script type="text/javascript">
	/* pageflip timing */
	var flipTime = 1000; // in ms [recommended 1000]
</script>

<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/pageflip.css"/>
<link rel="stylesheet" type="text/css" href="css/blue-world.css"/>

<script>
  $(document).ready(function() {
  
	var nice = $("html").niceScroll();  // The document page (body)
	
    
  });
</script>

<script src="js/jquery.nicescroll.min.js"></script>

<style type="text/css">
td {
	font-family:"Comic Sans MS", cursive;
	font-size:16px;
	font-weight:bold;
	color:#000;
}
.sh{
        -moz-box-shadow: 5px 5px 5px rgba(68,68,68,0.6);
        -webkit-box-shadow: 5px 5px 5px rgba(70,70,70,0.7);
        box-shadow: 5px 5px 5px rgba(68,68,68,0.6);
      border:solid 2px;

}
.page-left-des{
 /* fallback */
 background-image: -ms-linear-gradient(right, #000000 0%, #FFFFFF 5%);

/* Mozilla Firefox */ 
background-image: -moz-linear-gradient(right, #000000 0%, #FFFFFF 5%);

/* Opera */ 
background-image: -o-linear-gradient(right, #000000 0%, #FFFFFF 5%);

/* Webkit (Safari/Chrome 10) */ 
background-image: -webkit-gradient(linear, right top, left top, color-stop(0, #000000), color-stop(1, #FFFFFF));

/* Webkit (Chrome 11+) */ 
background-image: -webkit-linear-gradient(right, #000000 -2px, #FFFFFF 5%);

/* Proposed W3C Markup */ 
background-image: linear-gradient(right, #000000 0%, #FFFFFF 5%);
}
.page-right-des{
/* IE10 */ 
background-image: -ms-linear-gradient(right, #000000 0%, #FFFFFF 5%);

/* Mozilla Firefox */ 
background-image: -moz-linear-gradient(left, #000000 0%, #FFFFFF 5%);

/* Opera */ 
background-image: -o-linear-gradient(left, #000000 0%, #FFFFFF 5%);

/* Webkit (Safari/Chrome 10) */ 
background-image: -webkit-gradient(linear, left top, right top, color-stop(0, #000000), color-stop(1, #FFFFFF));

/* Webkit (Chrome 11+) */ 
background-image: -webkit-linear-gradient(left, #000000 -2px, #FFFFFF 5%);

/* Proposed W3C Markup */ 
background-image: linear-gradient(left, #000000 1px, #FFFFFF 5%);
}
</style>

<link rel="stylesheet" href="css/prettyGallery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		
		
		<script src="js/jquery.prettyGallery.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
            $(function() {
                $('#navigation a').stop().animate({'marginLeft':'-120px'},1000);

                $('#navigation > li').hover(
                    function () {
                        $('a',$(this)).stop().animate({'marginLeft':'-5px'},200);
                    },
                    function () {
                        $('a',$(this)).stop().animate({'marginLeft':'-120px'},200);
                    }
                );
            });
        </script>

        
</head>
<?php
    if(isset($_SESSION['userid'])){
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest") or die ("coudnt find database");
        $result=mysql_query("select slambook from apps where userid='".$_SESSION['userid']."'");
        $slambook=array();
        while($row=  mysql_fetch_assoc($result)){
            $slambook=unserialize($row['slambook']);
        }
?>



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
<div style="background-image:url(/images/prettyGallery/arrow.png); margin-top:-7px; width:20px; height:6px; float:right"></div>
<ul><li><a href="accountsettings.php">Account settings</a></li>
<li><a href="#2">Privacy settings</a></li>
</ul>

<div style="width:150px; height:20px; background-color:#6699FF">
<a id="letmeout" href="#3" >Letme out</a></div>
</span>
</div>

</div>

</div>
<div style="width:200px; float:left; height:20px; ">
<input class="search-box" type="text" value="Search..." onfocusout="searchitemsout(this)" onfocus="searchitemsin(this)" style="width:200px; height:20px" />
</div>
</div>


</div> 
    
    
    <div style="width:99%; height:80px; float:left; ">

<div style="width:100%; height:70px; float:left">
    <div style="width:40%; font-size:30px; font-weight:bold; font-family:'Comic Sans MS', cursive; height:35px; float:left">
  Slam Book</div>
<div style="width:200px; margin-top: 5px; float: left; height: 50px; ">
<ul style="margin-left:0px" class="prettyGallery">     
 <?php
        $i=1;$url;
        
	
	

        foreach(array_keys($slambook) as $user){
            $result1=mysql_query("select propic from user_info where userid='".$user."'");
            if($row=  mysql_fetch_assoc($result1))
                $url=imageurl ($row['propic']);
            echo "<li><a onClick=\"gotoPage('".($i*2)."')\" ><img src='/images/32/32_".$url."' width=\"45\" height=\"45\" /></a></li>";
            $i++;
    } ?>
    </ul>
</div>
  
</div>

    
    
    <div id = "pagesContainer" class="sh" >

<!-- the page DIVs at least 4, in multiples of 2. --> 

<!-- insert your DIVs here, classed "pageContent" -->
<?php foreach($slambook as $slam){
    ?>   
<div class="pageContent" >
 


<div class="page-left-des" style="width:470px; height: 700px; border: solid 3px;  float:left">
<form name="slambook" >
    <table style=" margin-left: 20px; margin-top: 20px" cellpadding="5px" cellspacing="3px">
<tr>
<td>Name:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['Name']; ?></div></td></tr>
<tr>
<td>Born On:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['Born_On']; ?></div></td></tr>
<tr>
<td>Email:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['Email']; ?></div></td></tr>
<tr>
<td>Ring me:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['Ring_Me']; ?></div></td></tr>
<tr>
<td>Ambition:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['Ambition']; ?></div></td></tr>
<tr>
<td>My Hobby:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['My_Hobby']; ?></div></td></tr>
<tr>
<td>I Believe in:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['I_Believed_in']; ?></div></td></tr>
<tr>
<td>About Friendship:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['About_Friendship']; ?></div></td></tr>
<tr>
<td>About Love:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['About_Love']; ?></div></td></tr>
<tr>
<td>i hate:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['I_hate']; ?></div></td></tr>
<tr>
<td>My Philosophy:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['My_Philosophy']; ?></div></td></tr>
</table></form>


</div>
</div>
<div class="pageContent">
 
<div class="page-right-des" style="width:470px;  height:700px; border: solid 3px;  float:left">
<form>
    <table style=" margin-left: 20px; margin-top: 20px" cellpadding="5px" cellspacing="3px">
<tr>
<td>favourite Film:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['Fav_Film']; ?></div></td></tr>
<tr>
<td>favourite Music:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['Fav_Music']; ?></div></td></tr>
<tr>
<td>favourite Actor:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['Fav_Actor']; ?></div></td></tr>
<tr>
<td>favourite Actress:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['Fav_Actress']; ?></div></td></tr>
<tr>
<td>favourite Sports:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['Fav_Sports']; ?></div></td></tr>
<tr>
<td>favourite Sportsman:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['Fav_Sportsman']; ?></div></td></tr>
<tr>
<td>favourite Dress:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['Fav_Dress']; ?></div></td></tr>
<tr>
<td>favourite Food:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['Fav_Food']; ?></div></td></tr>
<tr>
<td>favourite Place:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['Fav_Place']; ?></div></td></tr>
<tr>
<td>Close Friends:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['Close_Friends']; ?></div></td></tr>
<tr>
<td>I Feel About You:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['I_Feel_About_You']; ?></div></td></tr>
<tr>
    <td>My Advice For You:</td><td><div style="width:250px; height:50px; border:solid 1px"><?php echo $slam['My_Advice_for_You']; ?></div></td></tr>
</table></form>

</div>


</div>
 <?php } ?>
</div>
        <div style="width:100%; height: 40px; border: solid 1px"></div>
    </div>
<div>
  
</div>
    <script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$('.prettyGallery').prettyGallery({
					'navigation':'bottom',
					'itemsPerPage':5
				});
			});
		</script>
</body>
<?php } ?>
</html>