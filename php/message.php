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

    

<style>
.bodycontainer{
	margin:-5px;
		width:100%;
	float:left;
	height:100%; 
	padding:0;
	z-index:5000;
	border:solid #090;
}
#message{
	width:70%; float:left; border:solid #C60;
}
.messageheader{
	width:99%; text-align:center; font-size:16px; font-weight:bold; float:left;
	
}
.messagecontent-main{
	width:70%; margin-left: 50px; text-align:justify;  font-size:18px; float:left; 
}
.messagecontent{
	width:70%; margin-left: 50px; text-align:justify; font-size:18px; float:left; 
}
.messageusername{
	text-align:right;margin-top: 4px; font-size:18px; float:left;  
}
.messageuserpic{
	width:32px; float:left; margin: 3px; border:solid #66F; height:32px;
}
.messagedate{
	width:20%; float:right; margin-left: 10px; color: #000; font-size:12px; font-weight:bold;
}
.messageclose{
	width:20px; float:left; text-align:center;
}
.messagemaindiv{
	width:93%; float:left; margin-left: 30px;  border-bottom: solid #dddfdc;
}
.messagetopdiv-read{
	width:99%; float:left;  
}
.messagetopdiv{
    width:99%; float:left; background-color: papayawhip; 
}
.message-gap{
    float: left; width: 100%;
}
</style>
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
	font-family:"Bleeding cowboys";
        text-shadow: 1px 1px #0C0, -1px -1px #444;
	color:#0C0;
        text-shadow: black 0.1em 0.1em 0.2em;
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
.message-input-div{
    width:90%; height: 30px; margin-left:80px; margin-top: 15px; float:left; border-bottom:solid #dddfdc ;
}
.message-tab-nav-button ul{
	display:inline;
	width:200px;
	
}
.message-tab-nav-button ul li{
	display:block;
	border:solid #FFF 2px;
	padding:4px;
	background-color:#66FF99;
}
.message-tab-nav-button ul li:hover{
	
	background-color:#99FF99;
}
.message-tab-nav-button ul li a{
	text-decoration:none; cursor:pointer;
	font-size:18px;
	padding:4px;
	font-weight:bold;
	color:#000;
}
.message-tab-nav-button ul li a:hover{
	color:#FFF;
}
</style>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript">
function sentitems()
{
    request.onreadystatechange=sentmessages;
    request.open("get","ajax/sentmessages.php",true);
    request.send(null);
}
function sentmessages()
{
    if(request.readyState==4 && request.status==200)
        {
            var xml=request.responseXML;
            var suserid=xml.getElementsByTagName("ruserid");
            var from=xml.getElementsByTagName("to");
            var propic=xml.getElementsByTagName("propic");
            var message=xml.getElementsByTagName("msg");
            var read=xml.getElementsByTagName("read");
            var date=xml.getElementsByTagName("date");
            for(var i=0;i<suserid.length;i++)
                {
                    var main=document.getElementById('primarydiv');
                    var msgread=read[i].childNodes[0].nodeValue;
                     var a1=document.createElement('div');
                    if(msgread==0){
                     a1.className='messagetopdiv';   
                    }
                    else{
                         a1.className='messagetopdiv-read';
                    }
                    a1.innerHTML='<input type="checkbox" value='+suserid[i].childNodes[0].nodeValue+' style="float:left; display:none; margin:10px;">';
                    var a2=document.createElement('a');
                    a2.href='message.php?userid='+suserid[i].childNodes[0].nodeValue;
                    var a=document.createElement('div');
                    a.className='messagemaindiv';
                    var b=document.createElement('div');
                    b.className='messageclose';
                    b.innerHTML='<a style="text-decoration:none; cursor:pointer;" onclick="deleteallmessages(\''+suserid[i].childNodes[0].nodeValue+'\')">x</a>';
                    a1.appendChild(b);
                    var b1=document.createElement('div');
                    b1.className='messageclose';
                    b1.innerHTML=read[i].childNodes[0].nodeValue;
                    a.appendChild(b1);
                    
                    var c=document.createElement('div');
                    c.className='messagedate';
                    c.innerHTML=date[i].childNodes[0].nodeValue;
                    a.appendChild(c);
                    var d=document.createElement('div');
                    d.className='messageuserpic';
                    d.style.backgroundImage="url('images/32/32_"+propic[i].childNodes[0].nodeValue+"')";
                    a.appendChild(d);
                    var e=document.createElement('div');
                    e.className='messageusername';
                    e.innerHTML=from[i].childNodes[0].nodeValue;
                    a.appendChild(e);
                     var e4=document.createElement('div');
                    e4.className='message-gap';
                     a.appendChild(e4);
                    var f=document.createElement('div');
                    f.className='messagecontent';
                    f.innerHTML=message[i].childNodes[0].nodeValue;
                    a.appendChild(f);
                    a2.appendChild(a);
                    a1.appendChild(a2);
                    main.appendChild(a1);
                    
                }
              
        }
       
}
    
function getmessages()
{
        request.onreadystatechange=mymessages;
        request.open("get","ajax/getmessages.php",true);
        request.send(null);

}
function mymessages()
{
    if(request.readyState==4 && request.status==200)
        {
            var xml=request.responseXML;
            var suserid=xml.getElementsByTagName("suserid");
            var from=xml.getElementsByTagName("from");
            var propic=xml.getElementsByTagName("propic");
            var message=xml.getElementsByTagName("msg");
            var read=xml.getElementsByTagName("read");
            var date=xml.getElementsByTagName("date");
            for(var i=0;i<suserid.length;i++)
                {
                    var main=document.getElementById('primarydiv');
                    var msgread=read[i].childNodes[0].nodeValue;
                     var a1=document.createElement('div');
                    if(msgread==0){
                     a1.className='messagetopdiv';   
                    }
                    else{
                         a1.className='messagetopdiv-read';
                    }
                    a1.innerHTML='<input type="checkbox" value='+suserid[i].childNodes[0].nodeValue+' style="float:left; display:none; margin:10px;">';
                    var a2=document.createElement('a');
                    a2.href='message.php?userid='+suserid[i].childNodes[0].nodeValue;
                    var a=document.createElement('div');
                    a.className='messagemaindiv';
                    var b=document.createElement('div');
                    b.className='messageclose';
                    b.innerHTML='<a style="text-decoration:none; cursor:pointer;" onclick="deleteallmessages(\''+suserid[i].childNodes[0].nodeValue+'\')">x</a>';
                    a1.appendChild(b);
                    var b1=document.createElement('div');
                    b1.className='messageclose';
                    a.appendChild(b1);
                    
                    var c=document.createElement('div');
                    c.className='messagedate';
                    c.innerHTML=date[i].childNodes[0].nodeValue;
                    a.appendChild(c);
                    var d=document.createElement('div');
                    d.className='messageuserpic';
                    d.style.backgroundImage="url('images/32/32_"+propic[i].childNodes[0].nodeValue+"')";
                    a.appendChild(d);
                    var e=document.createElement('div');
                    e.className='messageusername';
                    e.innerHTML=from[i].childNodes[0].nodeValue;
                    a.appendChild(e);
                      var e4=document.createElement('div');
                    e4.className='message-gap';
                     a.appendChild(e4);
                    var f=document.createElement('div');
                    f.className='messagecontent-main';
                    f.innerHTML=message[i].childNodes[0].nodeValue;
                    a.appendChild(f);
                    a2.appendChild(a);
                    a1.appendChild(a2);
                    main.appendChild(a1);
                    
                }
        }
}

function getusermessages(userid)
{
    request.onreadystatechange=function(){usermessages(userid)};
        request.open("get","ajax/getusermessages.php?userid="+userid,true);
        request.send(null);
}
function usermessages(userid)
{
    if(request.readyState==4 && request.status==200)
        {
            var xml=request.responseXML;
            var ids=xml.getElementsByTagName("id");
            var suserid=xml.getElementsByTagName("suserid");
            var from=xml.getElementsByTagName("from");
            var propic=xml.getElementsByTagName("propic");
            var message=xml.getElementsByTagName("msg");
            var read=xml.getElementsByTagName("read");
            var date=xml.getElementsByTagName("date");
            var main1=document.getElementById('primarydiv');
            var main=document.createElement('div');
            for(var i=0;i<suserid.length;i++)
                {
                 
                    var a1=document.createElement('div');
                    a1.className='messagetopdiv-read';
                    a1.innerHTML='<input type="checkbox" value='+ids[i].childNodes[0].nodeValue+' style="float:left; display:none; margin:10px;">';
                    var a=document.createElement('div');
                    a.className='messagemaindiv';
                    var b=document.createElement('div');
                    b.className='messageclose';
                    b.innerHTML='<a style="text-decoration:none; cursor:pointer;" onclick="deletemessage(\''+ids[i].childNodes[0].nodeValue+'\')">x</a>';
                    a.appendChild(b);
                    var c=document.createElement('div');
                    c.className='messagedate';
                    c.innerHTML=date[i].childNodes[0].nodeValue;
                    a.appendChild(c);
                    var e=document.createElement('div');
                    e.className='messageusername';
                    e.innerHTML='<a href="#" >'+from[i].childNodes[0].nodeValue+'</a>';
                    a.appendChild(e);
                     var e4=document.createElement('div');
                    e4.className='message-gap';
                     a.appendChild(e4);
                    var f=document.createElement('div');
                    f.className='messagecontent';
                    f.innerHTML=message[i].childNodes[0].nodeValue;
                    a.appendChild(f);
                    a1.appendChild(a);
                    main.appendChild(a1);
                }
                  var c1=document.createElement('div');
                c1.className='message-input-div';
                c1.innerHTML='<input id="reply-message" onfocusout="repmessout(this)" onfocus="repmessin(this)" onkeydown="sendmessageuser(\''+userid+'\',event)" type="text" value="Reply..." style="width:100%; color:#000; height:25px"/>';
                main.appendChild(c1);
                main1.innerHTML=main.innerHTML;
        }
        

}

    function repmessin(element) {
      if(element.value=='Reply...'){
  	element.value = '';
      }
  
   }
   function repmessout(element) {
       if(element.value==''){
   	element.value = 'Reply...';}
     }
function sendmessageuser(userid,e){
var keynum;
if(window.event) // IE8 and earlier
	{
	keynum = e.keyCode;
	}
else if(e.which) // IE9/Firefox/Chrome/Opera/Safari
	{
	keynum = e.which;
	}
        if(keynum==13){
    var value=$("#reply-message").val();
   
    request.onreadystatechange=function(){sendreplymessage(userid)};
    request.open("post","ajax/sendmessage.php",true);
    request.setRequestHeader("content-type","application/x-www-form-urlencoded");
    var userid=escape(userid);
    var message=escape(value);
    var parameters="userid="+userid+"&message="+message;
    request.setRequestHeader("connection","close");
    request.setRequestHeader("content-length",parameters.length);
    request.send(parameters);
}


}
function sendreplymessage(userid)
{
     if(request.readyState==4 && request.status==200)
        {
            var json=eval('('+request.responseText+')');
            document.getElementById("reply-message").value='Reply...';
            getusermessages(userid);
           
        }
}
function deletemessage(msgid)
{
        request.onreadystatechange=delmsg;
        request.open("get","ajax/deletemessage.php?messageid="+msgid,true);
        request.send(null);
}
function delmsg()
{
    if(request.readyState==4 && request.status==200)
        {
            var json=eval('('+request.responseText+')');
            alert(json.status);
        }
}
function deleteallmessages(usrid)
{
        request.onreadystatechange=delallmsgs;
        request.open("get","ajax/deleteallmessages.php?userid="+usrid,true);
        request.send(null);
}
function delallmsgs()
{
    if(request.readyState==4 && request.status==200)
        {
            var json=eval('('+request.responseText+')');
            alert(json.status);
        }
}
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
<div style="float:left; height:80px; ">
<div id="top-menu-bar" style="height:30px; margin-top: 20px; margin-left: 30px; float:left; ">
<ul>
  <li><a href="profile.php?userid=<?php echo $_SESSION['userid']; ?>">Streams</a></li>
  <li><a href="profile.php?userid=<?php echo $_SESSION['userid']; ?>">Biog</a>
  </li>
  <li><a href="message.php">Messages</a>
   </li>
   <li><a href="">Alert</a>
   </li>
    <li><a href="profile.php?userid=<?php echo $_SESSION['userid']; ?>&tab=blogs">Blog</a>
   </li>
  <li><a href="">Music</a></li>
  <li><a href="">Apps</a>
    <ul>
     <li><a href="">Diary</a></li>
   <li><a href="">Slambook</a></li>
    </ul>
  </li>
</ul>
</div>
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
<div id='maincontainer' style="width:100%; height: 100%; float:left; border:solid 1px">
    <div id="primarydiv" style="width:79%; float:left;  border:solid 1px">
        <script type="text/javascript"> <?php if(isset($_REQUEST['userid'])) echo "getusermessages('".$_REQUEST['userid']."')";
        else if(isset($_REQUEST['tab']) && $_REQUEST['tab']=='sent')
            echo "sentitems()";
        else
            echo "getmessages()";
        ?>
            </script>
    </div>
    <div id="message-sec-div" style="width:20%; float:right; ">
        <div class="message-tab-nav-button" style="width:200px; float:right; border:solid 1px">
<ul>
<li><a href="message.php">Inbox</li>
<li><a href="message.php?tab=sent">Send Items</a></li>

</ul>


</div>
    </div>
    
</div>
</body>
</html>