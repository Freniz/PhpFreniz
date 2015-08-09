<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'ajax/getminiprofile.php';
?>
<?php 
    $pd;$pi;$votes;$privacy;$songurl;
    mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
    mysql_select_db("fztest1") or die ("coudnt find database");    
   if(isset($_REQUEST['leafid']) && isset($_SESSION['userid']) ){
       $result=mysql_query("select pageid,pagename,creator,admins,pagepic,vote,date,website,views,type,category,url from pages where pageid='".$_REQUEST['leafid']."'");   
       while($row=mysql_fetch_assoc($result))
       {
           $pd=$row;
       }
       if($pd['type']!='songs' && $pd['type']!='default'){
      $result1=mysql_query("select info,tabs from pages_info where pageid='".$_REQUEST['leafid']."'");
      while($row1=  mysql_fetch_assoc($result1)){
          $pi=unserialize($row1['info']);
          $tabs=unserialize($row1['tabs']);
      }
       }
       else
       {
      $result1=mysql_query("select info,songurl from pages_info where pageid='".$_REQUEST['leafid']."'");
      while($row1=  mysql_fetch_assoc($result1)){
          $pi=unserialize($row1['info']);
          $songurl=$row1['songurl'];
      }
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
<script type="text/javascript" src="js/jquery.textarea-expander.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
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
<script type="text/javascript">
    function searchitemsin(element) {
  
	element.value = '';
  
   }
   function searchitemsout(element) {
   	element.value = 'Search...';
     }
    </script>
<script type="text/javascript" src="js/audio-player.js"></script>
<script type="text/javascript">  
            AudioPlayer.setup("player.swf", {  
                width: 290  
            });  
        </script>  
<style>
    body{
   font-size: 99%;
   background-color: #CCF7CC;
   color: #000;
   font-family: arial, helvetica, geneva, sans-serif;
   margin-left:1px;
   margin-top:0px;
}


.headerdiv{
	width:100%; height:80px; background-color:#333; border:solid 1px
}
.headername{
	font-family:"Bleeding cowboys";
        text-shadow: 1px 1px #0C0, -1px -1px #444;
	color:#0C0;
        text-shadow: black 0.1em 0.1em 0.2em;
	font-size:60px;
	text-decoration:none;
	cursor:pointer;
	
	margin-left:10px;
	
 
}
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
#profilepic{
    -moz-box-shadow: 3px 3px 4px rgba(0,0,0,1.5);
        -webkit-box-shadow: 3px 3px 4px rgba(0,0,0,1.5);
        box-shadow: 3px 3px 4px rgba(0,0,0,1.5);
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

.status-post-div ul{
	float:left;
	display:block;
	width:100px;
	margin-top:10px;
}
.status-post-div ul li{
	display:inline;
	border-radius: 8px;
	box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	-moz-border-radius: 8px;
	padding:2px 10px;
	-moz-box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	background: #0C0;
	-webkit-border-radius: 8px;
	-webkit-box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	
}
.status-post-div ul li a{
	text-decoration:none;
        cursor: pointer;
}
.status-post-div ul li a:hover{
	color:#FFF;
}
.status-post-div{
	display:none;
	width:100%;
        float: left;
	background-color:#FFF;
	margin-left:-1px;
	margin-top:0px;
	border:solid 2px;
	border: solid 1px;
	background-color:#C1D8A9;
}

.leaf-tab-nav-button ul{
	display:inline;
	width:200px;
	
}
.leaf-tab-nav-button ul li{
	display:block;
	border:solid #FFF 2px;
	padding:4px;
	background-color:#66FF99;
}
.leaf-tab-nav-button ul li:hover{
	
	background-color:#99FF99;
}
.leaf-tab-nav-button ul li a{
	text-decoration:none; cursor:pointer;
	font-size:18px;
	padding:4px;
	font-weight:bold;
	color:#000;
}
.leaf-tab-nav-button ul li a:hover{
	color:#FFF;
}
.search-box{
    padding: 2px;
     border-radius: 8px;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px; 
        background-color: #333;
        color: #FFF;
}
#top-menu-bar ul {
  font-family: Arial, Verdana;
  font-size: 14px;
  margin: 0;
  padding: 0;
  list-style: none;
}
#top-menu-bar ul li {
  display: block;
  position: relative;
  float: left;
}
#top-menu-bar li ul { display: none; }
#top-menu-bar ul li a {
  display: block;
  text-decoration: none;
  color: #FFF;
  border-top: 3px solid #ffffff;
  padding: 5px 15px 5px 15px;
  margin-left: 1px;
  white-space: nowrap;
}
#top-menu-bar ul li a:hover { background: #0C0;
-webkit-box-shadow: 3px 3px 4px rgba(0,0,0,.5);
-moz-box-shadow: 3px 3px 4px rgba(0,0,0,.5);
box-shadow: 3px 3px 4px rgba(0,0,0,.5);
-webkit-border-radius: 8px; 
border: none;}
#top-menu-bar li:hover ul {
  display: block;
  position: absolute;
  border: none;
}
#top-menu-bar li:hover li {
  float: none;
  font-size: 11px;
  border: none;
}
#top-menu-bar li:hover a { background: #0C0; border: solid 1px #000;}
#top-menu-bar li:hover li a:hover { background: #95A9B1; }
</style>

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
   <li><a href="">Alert</a>
   </li>
    <li><a href="profile.php?userid=<?php echo $_SESSION['userid']; ?>&tab=blogs">Blog</a>
   </li> 
  <li><a href="">Apps</a>
    <ul>
    <li><a href="">Music</a></li>
    <li><a href="">Diary</a></li>
    <li><a href="">Slambook</a></li>
    </ul>
  </li>
</ul>
</div>

</div>
<div style="width:200px;  margin-right: 10px; float:right; height:80px; ">
<div style="width:200px; float:left; font-size: 18px; font-weight: bold; color: #fff; height:40px; border:solid #0F0 ">
<?php echo $_SESSION['username']; ?>
</div>
<div style="width:200px; float:left; height:20px; ">
<input class="search-box" type="text" value="Search..." onfocusout="searchitemsout(this)" onfocus="searchitemsin(this)" style="width:200px; height:20px" />
</div>
</div>


</div>
<div style="width:100%; float:left; border:solid 1px">

<div id="leaf-side-nav-div" style="width:200px; float:left; border:solid 1px">
<div class="leaf-tab-nav-button" style="width:200px; float:left; border:solid 1px">
<ul>
<li><a href="#">Place in name</a></li>
<li><a href="#">Name's Chart</a></li>
<li><a href="leaf.php?leafid=<?php echo $_REQUEST['leafid']; ?>&tab=info" >Leaf Info</a></li>
<li><a href="#">Name's Blog</a></li>
<li><a href="#">Contact Info</a></li>
<li><a href="#">Pictures</a></li>
<li><a href="#">Videos</a></li>
<li><a href="#">Websites</a></li>
<?php foreach ($tabs as $key=>$tab){ ?>
<li><a href="leaf.php?leafid=<?php echo $_REQUEST['leafid'] ?>&tab=<?php echo $key; ?>"><?php echo $key; ?></a></li>
<?php } ?>
</ul>


</div>
</div>

<div id="leaf-main-div" style="width:75%; float:right; border:solid #CC0 3px">
<div style="width:200px; margin-top:30px; height:60px; float:left; border:solid 1px">
    <div id="sublink" style="width:200px; height:50px; position:absolute; border:solid 1px; ">
<ul>
<?php if($_SESSION['type']=='user' && $pd['type']=='songs' && !in_array($pd['pageid'], $_SESSION['playlist'])){ ?>
    <li><a onclick="addtoplaylist('<?php echo $pd['pageid']; ?>')">Add to My Playlist</a></li>
    <?php } if(!in_array($_SESSION['userid'], unserialize($pd['vote']))) {?>
<li><a onclick="voteleaf('<?php echo $pd['pageid']; ?>')">vote</a></li>
<?php } else {?>
<li><a onclick="withdrawleaf('<?php echo $pd['pageid']; ?>')">withdraw</a></li>
<?php } ?>
</ul>
</div>
</div>
    <?php if($pd['type']=='songs'){ ?>
    <div style="width:40%; top:248px; height:30px; position:absolute; float:left; border:solid 1px">
 <p id="audioplayer_1" style=" background-color:#333">Alternative content</p>
<script type="text/javascript">  
        AudioPlayer.embed("audioplayer_1", {soundFile: "<?php if(isset($songurl)) echo $songurl;  ?>"});
		AudioPlayer.open("audioplayer_1",2);
        </script> 
</div>
<?php } ?>
<div id="leaf-userpic" style="width:200px; margin:10px; height:200px; float:right; border:solid 1px">
    <img src="images/200/200_<?php echo imageurl($pd['pagepic']);  ?>" height="200" width="150"/>
</div>
<div id="leaf-username" style="margin-top:110px; font-size: 20px; font-weight: bold; height:30px; float:right; border:solid 1px">
  <?php echo $pd['pagename'];  ?>  
</div>
<div  style="width:97%; margin-left:5px;float:left; border:solid 2px">
</div>

<div id="leaf-chart-div" style="width:100%; float:left; border:solid 1px">
<form name="postform" >
<div style="width:100%; margin-top: 10px; float:left; ">
<textarea id="message-content" name="post" style="resize:none; margin-top:0px; margin-left:0px; width:99%"  class="expand" onclick="expand()" ></textarea>
</div>
<div class="status-post-div">
<ul>
<li><a onclick="dopost('<?php echo $_REQUEST['leafid']; ?>','leaf')">Post</a></li></ul>
<div style="width:200px; float:left">
</div>
<select style="float:right"><option value="-1">Select:</option><option value="1">Friends</option><option value="2">FOF</option><option value="3">Public</option><option value="4">Private</option><option value="5">Specific</option><option value="6">Hidden</option></select>
</div>
 <div  style="width:97%; margin-left:5px; margin-top:5px;float:left; border:solid 2px">
</div>  
</form>
</div>
<div id="userstream"  style="width:95%;  float:left; border:solid #C06 2px">
    <?php if(isset($_REQUEST['tab'])){
    if($_REQUEST['tab']=='info'){
        if(sizeof($pi)>0)
        { ?>
            <div style="width:200px; margin:10px; float:right; border:solid 1px">
             <ul>
                <?php foreach (array_keys($pi) as $title){
                    ?>
            <li > <a href="#<?php echo $title; ?>" ><?php echo $title; ?></a> </li>
             <?php } ?></ul>
            </div> 
<?php
            foreach(array_keys($pi) as $title)
            {
                
                ?>
<div style="width:100%; float:left; border:solid 1px">

<div id="title-descrip" style="width:100%; float:left; border:solid 1px">
<div id="<?php echo $title; ?>" style="height:30px; width:100px; float:left; border:solid 1px">
    <?php echo $title; ?>
</div>
<div id="des" style="width:100%; height:100px; float:left; border:solid 1px">
    <?php echo $pi[$title];?>
</div>
</div></div>

    
    
        <?php
                
            }
        }
        else
            echo "No info has been provided";
    }
    else if(array_key_exists($_REQUEST['tab'], $tabs))
    {
        switch($tabs[$_REQUEST['tab']]['type'])
        {
            case 'links':
                foreach ($tabs[$_REQUEST['tab']]['urls'] as $link)
                    echo "<a href='$link'>$link</a><br/>";
                break;
        }
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