<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'ajax/getminiprofile.php';
?>
<?php 
    $pd;$pi;$votes;$privacy;
    mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
    mysql_select_db("fztest1") or die ("coudnt find database");    
   if(isset($_REQUEST['leafid']) && isset($_SESSION['userid']) ){
       $result=mysql_query("select pagename,creator,admins,pagepic,vote,date,website,views,type,category,url from pages where pageid='".$_REQUEST['leafid']."'");   
       while($row=mysql_fetch_assoc($result))
       {
           $pd=$row;
       }
      $result1=mysql_query("select info from pages_info where pageid='".$_REQUEST['leafid']."'");
      while($row1=  mysql_fetch_assoc($result1)){
          $pi=unserialize($row1['info']);
      }
      
      
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Freniz - <?php echo $pd['pagename']; ?> </title>
<link href="css/style.css" rel="stylesheet" />
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<link href="css/fileuploader.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="css/drop.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery-latest.js"></script> 
<script type="text/javascript" src="js/onload.js"></script> 
<script src="js/ajax.js" type="text/javascript"></script>
<script src="js/jquery.history.js" type="text/javascript"></script>
<script src="js/audio-player.js" type="text/javascript"></script>
<script type="text/javascript" src="js/audio-player.js"></script> 
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
<script type="text/javascript" src="js/unserialize.js"></script>
<script type="text/javascript" src="js/accountsettings.js"></script>
<script src="js/fileuploader.js" type="text/javascript"></script>

<script type="text/javascript" src="js/bsn.AutoSuggest_c_2.0.js"></script>

<link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />

    <script>        
        function createUploader(albumid){   
            var uploader = new qq.FileUploader({
                element: document.getElementById('file-uploader-demo1'),
                action: 'ajax/uploadimage.php',
		    showMessage: function(message){alert(message);},
                    params:{album : albumid},
                    onComplete:function(id, fileName, responseJSON){ getimages(albumid);},
                debug: true
            });
            
        }
        
        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load  
            
    </script>


<style>
body{
   font-size: 99%;
   background-color: #fff;
   color: #000;
   font-family: arial, helvetica, geneva, sans-serif;
   margin-left:1px;
   margin-top:0px;
}
.headerdiv{
	width:100%; height:80px; background-color:#333; border:solid 1px
}
.headername{
	font:"Comic Sans MS", cursive;
	color:#0C0;
	font-size:60px;
	text-decoration:none;
	cursor:pointer;
	
	margin-left:10px;
	
 
}
.smallheaderfont{
	font-size:12px; font-weight:bold; font-family:Verdana, Geneva, sans-serif;
}
.titleheaderfont{
	font-size:16px; font-weight:bold; font-family:Verdana, Geneva, sans-serif;
	
}
.titlenamefont{
	font-size:20px; font-weight:bold; font-family:Verdana, Geneva, sans-serif;
	
}
ul{
	display:block;
	float:right;
	
}
ul li{
	display:inline-block;
}
ul li a{
	border-radius: 8px;
	box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	-moz-border-radius: 8px;
	-moz-box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	font-size:12px;
	background: #0C0;
	-webkit-border-radius: 8px;
	-webkit-box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	text-decoration: none;
	padding: 5px 10px;
}
</style>
<style>
#sublink ul{
	display:block;
	float:right;
	
}
#sublink ul li{
	display:inline-block;
}
#sublink ul li a{
	border-radius: 8px;
	box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	-moz-border-radius: 8px;
	-moz-box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	font-size:12px;
	background: #0C0;
	-webkit-border-radius: 8px;
	-webkit-box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	text-decoration: none;
	padding: 5px 10px;
}
#mainlink ul{
	display:inline;
	float:left;
}
#mainlink li{
	display:inline;
	padding: 0px 8px 2px 0px;
}
#mainlink2 ul{
	display:inline;
	padding: spx 10px;
	width: 170px;
	
background:#999;
	
}
#mainlink2 li{
	display: block;
	padding: 0px 10px 5px 0px;
	background-color:#CCC;
}
.mainklink3 li a{
	display:block;
	width:200px;
	text-decoration:none;
	background-color:#999;
}
.mainklink3 li a:hover{
	text-decoration:none; background-color:yellow;
}
</style>

<script type="text/javascript" src="js/ajax.js"></script>
</head>

<body>
    <div class="headerdiv">
<div style="width:200px; float:left; height:80px; ">
<a class="headername" href="#">Freniz</a>
</div>
<div style="width:40px; float:left; height:80px; ">
<img src="images/mood/<?php echo $_SESSION['mood'];?>" width="40" height="40"/>
</div>
<div id="maindivtab" style="width:400px; float:left; height:80px; ">

<ul>
<li><a href="profile.php?userid=<?php echo $_SESSION['userid']; ?>">Stream</a></li>
<li><a href="profile.php?userid=<?php echo $_SESSION['userid']; ?>">Biog</a></li>
<li><a href="message.php">Message</a></li>
<li><a href="profile.php?userid=<?php echo $_SESSION['userid']; ?>&tab=blogs">Blog</a></li>
<li><a href="#">Alert</a></li>
<li><a href="#">Apps</a></li>
</ul>

</div>
<div style="width:200px;  margin-right: 10px; float:right; height:80px; ">
<div style="width:200px; float:left; height:40px; border:solid #0F0 ">
<?php echo $_SESSION['username']; ?>
</div>
<div style="width:200px; border: solid #FF9; float:left; height:40px; ">
<input type="text" style="width:200px; height:20px" />
</div>
</div>
    </div>

<div id="leaf" style="width:100%; height:100%; border:solid 1px; float:left">

<div id="upperdiv" style="width:75%; height:220px; border:solid 1px; float:left">
<div id="leafprofilepic" style="width:150px; margin:5px; height:200px; border:solid 1px; float:left">
    <img src="images/200/200_<?php echo imageurl($pd['pagepic']);  ?>" height="200" width="150"/>
</div>
<div style="width:200px; height:25px; margin-top:100px; margin-left:10px; border:solid 1px; float:left">
<?php echo $pd['pagename'];  ?>
</div>
<div style="width:45%; height:50px; border:solid 1px; float:right">
<div id="sublink" style="width:48%; height:50px; position:absolute; border:solid 1px; ">
<ul>

<li><a href="#">vote</a></li>
</ul>
</div>


</div>
<div style="width:300px; margin:5px; height:150px; border:solid 1px; float:right">
map
</div>

</div>

<div style="width:20%; height:300px; border:solid 1px; float:right">
home
<div id="mainlink2" style="width:200px; margin-top:55px; height:75%; border:solid 1px; float:right">
<ul class="mainklink3">
<li><a href="#">LeafHome</a></li>
<li><a href="leaf.php?leafid=<?php echo $_REQUEST['leafid']; ?>&tab=info" >Info</a></li>
<li><a href="#">website</a></li>
</ul>


</div>



</div>


<div id="mainlink" style="width:75%; height:50px; border:solid #0F0; float:left">
<ul>
<li><a href="#">Name's chart</a></li>
<li><a href="#">Picz</a></li>
<li><a href="#">vidz</a></li>
</ul>
</div>
    <div style="width:75%; border: solid #0066ff; float: left">
        <div style="width:100%; float:left">
        <form name="postform" >
<div style="width:100%; float:left; ">
<textarea id="message-content" name="post" style="resize:none; margin-top:0px; margin-left:0px; width:99%"  class="expand" onclick="expand()" ></textarea>
</div>

<div class="status-post-div">
<ul>
<li><a onclick="dopost('<?php echo $_REQUEST['leafid']; ?>','leaf')">Post</a></li></ul>

<div style="width:200px; float:left">
</div>

<select style="float:right"><option value="-1">Select:</option><option value="1">Friends</option><option value="2">FOF</option><option value="3">Public</option><option value="4">Private</option><option value="5">Specific</option><option value="6">Hidden</option></select>
</div>
        </form>
</div>
     <div id="userstream" style="width:100%; height:300px; border:solid 1px; float:left">
<?php if(isset($_REQUEST['tab'])){
    if($_REQUEST['tab']=='info'){
        if(sizeof($pi)>0)
        {
            foreach(array_keys($pi) as $title)
            {
                echo $title.' : '.$pi[$title].'<br>';
            }
        }
        else
            echo "No info has been provided";
    }
}
else{?>
    <script>
    getmystreams('<?php echo $_REQUEST['leafid']; ?>');
    </script>
<?php }
?>
</div>
   
    </div>
    



</div>
</body>
</html>
<?php } ?>