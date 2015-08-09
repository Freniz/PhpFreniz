<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'ajax/getminiprofile.php';
?>
<?php 
    
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Freniz - My Messages</title>
<link href="css/blue-world.css" rel="stylesheet" />
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
<style type="text/css">
.invitation-button-display-list{
    background-color: #c1d8a9;
width:100%; height:30px; float:left; border:solid 1px;
}
.invitation-button-display-list input{
	border-radius: 8px;
	box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	-moz-border-radius: 8px;
	-moz-box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	font-size:12px;
	background: #0C0;
	-webkit-border-radius: 8px;
	-webkit-box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	text-decoration: none;
}
.invitation-button-display-list input:hover{
	color:#fff;
}
.maindiv-get-invitation{
	width:100%; float:left; border:solid 1px;
}
.topdiv-get-invitation{
	width:100%; height:20px; float:left; border:solid 1px;
}
.name-pic-get-invitation{
	width:100%; height:50px; float:left; border:solid 1px;
}
</style>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript">
function invitations()
{
                request.onreadystatechange=invites1;
                request.open("get","ajax/getallinvites.php",true);
                request.send(null);
}
function invites1()
{
    if((request.readyState==4) && (request.status==200))
        {
            var xml=request.responseXML;
            var ids=xml.getElementsByTagName("id");
            var suserid=xml.getElementsByTagName("suserid");
            var susername=xml.getElementsByTagName("susername");
            var suserpic=xml.getElementsByTagName("suserpic");
            var mutualfrnds=xml.getElementsByTagName("mutualfrnds");
            var suservotes=xml.getElementsByTagName("suservotes");
            var text2=xml.getElementsByTagName("text");
            var songurl=xml.getElementsByTagName("songurl");
            var imageurl=xml.getElementsByTagName("imageurl");
            for(var i=0;i<ids.length;i++){
              
                getinvitation(suserid[i].childNodes[0].nodeValue,susername[i].childNodes[0].nodeValue,suserpic[i].childNodes[0].nodeValue,mutualfrnds[i].childNodes[0].nodeValue,suservotes[i].childNodes[0].nodeValue,text2[i].childNodes[0].nodeValue,songurl[i].childNodes[0].nodeValue,imageurl[i].childNodes[0].nodeValue)
            }
        }
}
function getinvitation(userid,username,userpic,mf,votes,text,sngurl,imgurl){
	
	var create=document.getElementById('primarydiv');
	var a = document.createElement('div');
	a.className='maindiv-get-invitation';
	var b = document.createElement('div');
	b.className='topdiv-get-invitation';
	b.innerHTML='<div style="width:60px; height:20px; float:left">Mutual:'+mf+'</div><div style="width:60px; height:20px; float:left">Votes:'+votes+'</div>';
	a.appendChild(b);
	var c = document.createElement('div');
	c.className='name-pic-get-invitation';
	c.innerHTML='<div style="width:32px; height:32px; margin-right:20px; margin-top:8px; float:right; border:solid 1px"><img src="images/32/32_'+userpic+'" width="32" height="32" /></div><div style=" height:20px; float:right; margin-right:20px; margin-top:15px; border:solid 1px">'+ username+'</div><div style="width:100px; height:20px; float:left; margin-left:10px; margin-top:15px; border:solid 1px"><a onclick="displayinvites(\''+userid+'\',\''+username+'\',\''+userpic+'\',\''+mf+'\',\''+votes+'\',\''+text+'\',\''+sngurl+'\',\''+imgurl+'\');">view invitation</a></div>';
	a.appendChild(c);
	var d = document.createElement('div');
	d.className='invitation-button-display-list';
	d.innerHTML='<input type="button" onclick="addfrnd(\''+userid+'\')" value="Accept" /><input type="button" onclick="ignorerequest(\''+userid+'\')" value="Decline" />';
	a.appendChild(d);
	create.appendChild(a);
}


</script>
<script type="text/javascript">
function displayinvites(userid,username,userpic,mf,votes,text,sngurl,imgurl){
        
        var create=document.getElementById('light1');
	var a=document.createElement('div');
	a.className='inivitation-maindiv';
	var b=document.createElement('div');
	b.className='invitation-header';
	b.innerHTML='<div style="width:400px; font-size:18px; font-weight:bold; height:20px;  ">Invitation<div style="width:300px; font-size:12px; font-weight:bold; height:20px; ; float:right; "><div style="width:80px; height:20px; float:right; ">Mutual:'+mf+'</div><div style="width:80px; height:20px; float:right; ">Votes:'+votes+'</div></div></div>';
	a.appendChild(b);
	var c=document.createElement('div');
	c.className='invitation-to-div';
	c.innerHTML='<div style="width:300px; height:5px;  "></div><div style="width:280px; height:20px; font-size:14px; font-weight:bold;">From:<div style="width:200px; float:right; height:20px;">'+username+'</div></div>';
	a.appendChild(c);
	var d=document.createElement('div');
	d.className='invitation-gap-1';
		a.appendChild(d);
		var e=document.createElement('div');
	e.className='inivation-textarea-div';
	e.innerHTML='<div style="width:300px;  border:solid 1px; height:60px">'+text+'</div>';
		a.appendChild(e);
	var f=document.createElement('div');
	f.className='invitation-gap-3';
		a.appendChild(f);
		
		var g=document.createElement('div');
	g.className='invitation-songdeticate-display';
	g.innerHTML='Songs deticated:<p id="audioplayer_1"></p>';
		a.appendChild(g);
		var h=document.createElement('div');
	h.className='invitation-gap';
		a.appendChild(h);
		var j=document.createElement('div');
	j.className='invitation-gap-1-display';
		a.appendChild(j);
		var l=document.createElement('div');
	l.id='invitation-button-display';
	l.innerHTML='<input type="button" value="Accept" onclick="addfrnd(\''+userid+'\')" style="float:left" /><input type="button" value="Decline" onclick="ignorerequest(\''+userid+'\')" style="float:left" />';
		a.appendChild(l);
                create.appendChild(a);
               AudioPlayer.embed("audioplayer_1", {soundFile: sngurl});
               document.getElementById('light1').style.display='block';document.getElementById('fade1').style.display='block';
		
		
}
</script>
<script type="text/javascript">  
            AudioPlayer.setup("player2.swf", {  
                width: 290  
            });  
        </script>  
</head>

<body>
<div class="headerdiv">
<div style="width:200px; float:left; height:80px; ">
<a class="headername" href="#">Freniz</a>
</div>
<div style="width:40px; float:left; height:80px; ">
<img src="images/mood/<?php echo $_SESSION['mood'];?>" width="40" height="40"/>
</div>
<div style="width:400px; float:left; height:80px; ">

<ul>
<li><a href="profile.php?userid=<?php echo $_SESSION['userid']; ?>">Stream</a></li>
<li><a href="#">Biog</a></li>
<li><a href="message.php">Message</a></li>
<li><a href="#">Blog</a></li>
<li><a href="invitations.php">Alert</a></li>
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
<div id='maincontainer' style="width:100%; height:100%; float:left; border:solid 1px">
    <div id="primarydiv" style="width:79%; float:left; height:100%; border:solid 1px">
        <script type="text/javascript"> <?php 
            echo "invitations()";
        ?>
            </script>
    </div>
</div>
    <div id="light1" class="white_content" style="width:410px; height:220px; border:solid 6px">
</div>
<div id="fade1" onClick="document.getElementById('light1').style.display='none';  document.getElementById('fade1').style.display='none'" class="black_overlay">
        </div>
       
</body>
</html>