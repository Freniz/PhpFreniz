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
        
        $results=mysql_query("select profiletype,fname,lname,dob,sex,school,college,email,hometown,currentcity,language,rstatus,employer,religion,myphilosophy,state,country,propic,pinnedpic,style,books,musics,movies,celebrities,games,sports,other,playlist,mood,secondarypic1,secondarypic2,propicalbum,adminpages,url,pt,blocklist,blockedby from user_info where userid='".$_REQUEST['userid']."'");
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
<link href="css/<?php echo $ud['style'] ?>" rel="stylesheet" type="text/css"/>
<link href="css/style.css" rel="stylesheet" />
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<link href="css/fileuploader.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="css/drop.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery-latest.js"></script> 
<script type="text/javascript" src="js/onload.js"></script> 
<script src="js/ajax.js" type="text/javascript"></script>
<script src="js/jquery.history.js" type="text/javascript"></script>
<script src="js/audio-player.js" type="text/javascript"></script>


<script type="text/javascript" src="js/chat.js"></script>
<script type="text/javascript" src="js/unserialize.js"></script>
<script type="text/javascript" src="js/accountsettings.js"></script>
<script src="js/fileuploader.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.textarea-expander.js"></script>
<script type="text/javascript" src="js/bsn.AutoSuggest_c_2.0.js"></script>

<style type="text/css">
.edit-phot-main{
	width:100%; border:solid 1px; float:left;
}
#musictab{
 /* Path to Image */
right:1px;  /* change this to left: 1px; to put it on the left of the screen */
bottom:0px;
border:solid 1px;
height:28px;
width:100%;
margin:0;
padding:0;
position:fixed;
z-index:5000;
background-color:#333;
    -moz-box-shadow: 0px 0px 5px 5px rgba(68,68,68,0.6);
        -webkit-box-shadow: 0px 0px 5px 5px rgba(68,68,68,0.6);
        -ms-box-shadow:0px 0px 5px 5px rgba(68,68,68,0.6);
	    box-shadow: 0px 0px 5px 5px rgba(68,68,68,0.6);

}
</style>







<link rel="stylesheet" href="css/prettyGallery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		
		<script src="http://www.google.com/jsapi" type="text/javascript"></script>
		<script type="text/javascript" charset="utf-8">
			google.load("jquery", "1.5.1");
		</script>
		<script src="js/jquery.prettyGallery.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
			function showBox(val) {
                            var sp=document.getElementById(val);
                            sp.style.display='block';
			}

function hideBox(val) {
    
	 var sp=document.getElementById(val);
                            sp.style.display='none';
}
</script>
                <style type="text/css">

	span.span_edit {
            position: absolute;
               width: 40px;
               display: none;
		color: red;
              
		font-weight: bold;
	}
        #sp{
            background-color: #dddfdc;
        }
        #sp a{
            text-decoration: none; cursor: pointer; color: #000;
        }
         #sp a:hover{
            text-decoration: underline;color: #000;
        }
        #sp1{
            background-color: #dddfdc;
        }
        #sp1 a{
            text-decoration: none; cursor: pointer; color: #000;
        }
         #sp1 a:hover{
            text-decoration: underline;color: #000;
        }
         #proic{
            background-color: #dddfdc;
        }
        #proic a{
            text-decoration: none; cursor: pointer; color: #000;
	
        }
		
         #proic a:hover{
            text-decoration: underline;color: #000;
        }
</style>
<script src="js/php_serialize.js" type="text/javascript" charset="utf-8"></script>








<link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />

    <script>        
        function createUploader(albumid,multiple,drag){   
            var uploader = new qq.FileUploader({
                element: document.getElementById('file-uploader-demo1'),
                action: 'ajax/uploadimage.php',
                multiple:multiple,
		    showMessage: function(message){alert(message);},
                    params:{album : albumid},
                    onComplete:function(id, fileName, responseJSON){ getimages(albumid);},
                debug: true,
                drag:drag
            });
            
        }
        
        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load  
            
    </script>

<script type="text/javascript">
    
    function createmessage(){
	
	var create=document.getElementById('light1');
	var a=document.createElement('div');
	a.className='messheader';
	a.innerHTML='Happy to send messages to your freniz';
	create.appendChild(a);
    var b=document.createElement('div');
	b.className='messgap_1';
	create.appendChild(b);
	 var c=document.createElement('div');
	c.className='mess-to-div';
	c.innerHTML='To:<input type="text" value=""  style="width:200px; ; height:20px" />';
	create.appendChild(c);
	 var d=document.createElement('div');
	d.className='messgap_1';
	create.appendChild(d);
	 var e=document.createElement('div');
	e.className='mess-textarea-div';
	e.innerHTML='<textarea style="height:60px; width:300px"></textarea>';
	create.appendChild(e);
	 var f=document.createElement('div');
	f.className='messgap_2';
	create.appendChild(f);
	 var g=document.createElement('div');
	g.className='messbutton';
	g.innerHTML="<input onClick=\"document.getElementById('light1').style.display='none';  document.getElementById('fade1').style.display='none'\" style='float:left;  margin-left:20px' value='Cancel' type='button' /><input style='float:right; margin-right:20px;' value='Send' type='button' />";
	create.appendChild(g);
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
	l.innerHTML='<input type="button" value="Accept" onclick="addfrnd(\''+userid+'\')" style="float:left" /><input type="button" value="Decline" onclick="ignorerequest(\''+userid+'\')" style="float:left" /><input type="button" value="Later" style="float:left" />';
		a.appendChild(l);
                create.innerHTML=a.innerHTML;
               AudioPlayer.embed("audioplayer_1", {soundFile: sngurl});
		
		
}
</script>
<script type="text/javascript">  
            AudioPlayer.setup("player2.swf", {  
                width: 290  
            });  
        </script>  
<script type="text/javascript">
function createinvitation(userid,username){
	
	var create=document.getElementById('light1');
	var a=document.createElement('div');
	a.className='inivitation-maindiv';
	var b=document.createElement('div');
	b.className='invitation-header';
	b.innerHTML='Invitation';
	a.appendChild(b);
	var c=document.createElement('div');
	c.className='invitation-to-div';
	c.innerHTML='To:'+username;
	a.appendChild(c);
	var d=document.createElement('div');
	d.className='invitation-gap';
		a.appendChild(d);
		var e=document.createElement('div');
	e.className='inivation-textarea-div';
        e.innerHTML='<textarea id="invitation-textarea" style="width:300px; height:60px"></textarea>';
		a.appendChild(e);
	var f=document.createElement('div');
	f.className='invitation-gap';
		a.appendChild(f);
		
		var g=document.createElement('div');
	g.className='invitation-songdeticate';
	g.innerHTML='Songs to deticate:<input id="invitation-songdeticate" type="text" style="width:200px"  />';
		a.appendChild(g);
		var h=document.createElement('div');
	h.className='invitation-gap';
		a.appendChild(h);
		var i=document.createElement('div');
	i.className='invitation-setbackground';
        i.innerHTML='Set background:<input id="invitation-setbackground" type="hidden" value="miffy.jpg" />';
		a.appendChild(i);
		var j=document.createElement('div');
	j.className='invitation-gap-1';
		a.appendChild(j);
		var l=document.createElement('div');
	l.id='invitation-button';
        l.innerHTML='<input type="button" value="Send" onclick="meeran(\''+userid+'\');"  style="float:left" />';
		a.appendChild(l);
		create.innerHTML=a.innerHTML;
		
			
}
function meeran(userid)
{
 
    var text=$('#invitation-textarea').val();
        var songurl=$('#invitation-songdeticate').val();
        var imageurl=$('#invitation-setbackground').val();
        sendfrndreq(userid,text,songurl,imageurl );
        
}
</script>



<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$('.prettyGallery').prettyGallery({
					'navigation':'bottom',
					'itemsPerPage':4
				});
			});
		</script>
<script src="js/jquery.nicescroll.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

	var nice = $("html").niceScroll();  // The document page (body)
	
	$("#div1").html($("#div1").html()+' '+nice.version);
    
    $("#boxscroll").niceScroll({cursorborder:"",cursorcolor:"#000",boxzoom:false}); // First scrollable DIV
    
    // Customizable cursor
    // $("#boxscroll").niceScroll({touchbehavior:false,cursorcolor:"#00F",cursoropacitymax:0.7,cursorwidth:11,cursorborder:"1px solid #2848BE",cursorborderradius:"8px"}).cursor.css({"background-image":"url(img/mac6scroll.png)"}); // MAC like scrollbar
 // hw acceleration enabled when using wrapper
    
  });
</script>


<style>
    

</style>
<style>

</style>
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
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript">
    
    function filenotfound()
    {
        alert('file not found');
    }
    
    
    
    
window.onload=function(){
    document.getElementById("loading").style.display='none';
}
$(document).ready(function(){
    $("#loading").css('display','block');
});
</script>


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
<style>
span-edit{
	width:120px; display:none; position:absolute; top:51px; left:203px; background:#999;
}
span-setting{
	width:150px; display:none; float:right; margin-top:22px; margin-right:-140px; background:#999;
}
.mood li{
	cursor:pointer;
}
</style>
</head>

<body>
    <img id="loading" src="images/prettyGallery/loading-gif-animation.gif" style="position:absolute; display: none; margin-left: 45%" height="32" width="32"></img>
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
    
<?php if(!in_array($_REQUEST['userid'], unserialize($ud['blocklist'])) && !in_array($_REQUEST['userid'], unserialize($ud['blockedby']))){?>
<div id='maincontainer' style="width:1000px; margin-left:auto; margin-right:auto; height:100%; ">
<div id="primarydiv" style="width:76%; float:left; height:100%; ">
<div  style="width:200px; height:100%; margin-top: 40px; float:left; ">
  <div class="titlenamefont" id="Title-name-items"style=" margin-top: -35px; margin-left: 15px; padding: 3px 8px 3px 8px;  float:left; ">
<?php echo $ud['fname'].' '.$ud['lname']; ?>
    
</div>  
<div id="secondarydiv" style="width:200px; margin-top: 5px; height:100%; float:left; ">

    <?php if($privacy['dob']=='public'||($privacy['dob']=='friends' && in_array($_REQUEST['userid'], $_SESSION['friends']))||($privacy['dob']=='fof' && (count(array_intersect(unserialize($fv['friendlist']),$_SESSION['friends']))>=1 || in_array($_REQUEST['userid'], $_SESSION['friends'])) )|| $_SESSION['userid']==$_REQUEST['userid']) {?>
<div class="smallheaderfont" style="width:200px; height:40px; float:left; ">
B'day:
<div style="width:200px; text-align: center; height:20px;  ">
    <?php echo $ud['dob']; ?>
</div>
 <div style=" width:180px; margin-left: 10px; border-bottom: solid #dddfdc; "></div> 
</div>
    <?php } ?>
    
<div class="smallheaderfont" style="width:200px; height:40px; float:left;">
Sex:
<div style="width:200px; text-align: center; height:20px; ">
    <?php echo $ud['sex']; ?>
</div>
<div style=" width:180px;  margin-left: 10px; border-bottom: solid #dddfdc; "></div> 
</div>
    <?php if($privacy['relationship']=='public'||($privacy['relationship']=='friends' && in_array($_REQUEST['userid'], $_SESSION['friends']))||($privacy['relationship']=='fof' && (count(array_intersect(unserialize($fv['friendlist']),$_SESSION['friends']))>=1 || in_array($_REQUEST['userid'], $_SESSION['friends'])) )|| $_SESSION['userid']==$_REQUEST['userid']) {?>
<div class="smallheaderfont" style="width:200px; height:40px; float:left; ">
R'status:
<div style="width:200px; text-align: center; height:20px;  ">
    <?php echo $ud['rstatus']; ?>
</div>
<div style=" width:180px; margin-left: 10px; border-bottom: solid #dddfdc; "></div> 
</div>
    <?php } ?>
    <?php if($privacy['religion']=='public'||($privacy['religion']=='friends' && in_array($_REQUEST['userid'], $_SESSION['friends']))||($privacy['relion']=='fof' && (count(array_intersect(unserialize($fv['friendlist']),$_SESSION['friends']))>=1 || in_array($_REQUEST['userid'], $_SESSION['friends'])) )|| $_SESSION['userid']==$_REQUEST['userid']) {?>
<div class="smallheaderfont" style="width:200px; height:40px; float:left; ">
Religion:
<div style="width:200px; text-align: center; height:20px;  ">
    <?php echo $ud['religion']; ?>
</div>
<div style=" width:180px;  margin-left: 10px; border-bottom: solid #dddfdc; "></div> 
</div>
    <?php } ?>
    <?php if($privacy['livingin']=='public'||($privacy['livingin']=='friends' && in_array($_REQUEST['userid'], $_SESSION['friends']))||($privacy['livingin']=='fof' && (count(array_intersect(unserialize($fv['friendlist']),$_SESSION['friends']))>=1 || in_array($_REQUEST['userid'], $_SESSION['friends'])) )|| $_SESSION['userid']==$_REQUEST['userid']) {?>
<div class="smallheaderfont" style="width:200px; height:40px; float:left; ">
Currentcity:
<div style="width:200px; text-align: center; height:20px;  ">
    <?php echo $ud['currentcity']; ?>
</div>
<div style=" width:180px; margin-left: 10px; border-bottom: solid #dddfdc; "></div> 
</div>
    <?php } ?>
    <?php if($privacy['hometown']=='public'||($privacy['hometown']=='friends' && in_array($_REQUEST['userid'], $_SESSION['friends']))||($privacy['hometown']=='fof' && (count(array_intersect(unserialize($fv['friendlist']),$_SESSION['friends']))>=1 || in_array($_REQUEST['userid'], $_SESSION['friends'])) )|| $_SESSION['userid']==$_REQUEST['userid']) {?>
<div class="smallheaderfont" style="width:200px; height:40px; float:left; ">
Hometown:
<div style="width:200px; text-align: center; height:20px;  ">
    <a style=" text-decoration: none; cursor: pointer; color: green" href="#"><?php echo $ud['hometown'];?></a>
</div>
<div style=" width:180px; margin-left: 10px; border-bottom: solid #dddfdc; "></div> 
</div>
    <?php } ?>
    <?php if($privacy['languages']=='public'||($privacy['hometown']=='languages' && in_array($_REQUEST['userid'], $_SESSION['friends']))||($privacy['languages']=='fof' && (count(array_intersect(unserialize($fv['friendlist']),$_SESSION['friends']))>=1 || in_array($_REQUEST['userid'], $_SESSION['friends'])) )|| $_SESSION['userid']==$_REQUEST['userid']) {?>
<div class="smallheaderfont" style="width:200px; height:40px; float:left; ">
Language:
<div style="width:200px; height:20px; ">
</div>
<div style=" width:180px;  margin-left: 10px; border-bottom: solid #dddfdc; "></div> 
</div>
    <?php } ?>
    <?php if($privacy['education']=='public'||($privacy['education']=='friends' && in_array($_REQUEST['userid'], $_SESSION['friends']))||($privacy['education']=='fof' && (count(array_intersect(unserialize($fv['friendlist']),$_SESSION['friends']))>=1 || in_array($_REQUEST['userid'], $_SESSION['friends'])) )|| $_SESSION['userid']==$_REQUEST['userid']) {?>
<div class="titleheaderfont" style="width:200px; height:20px; float:left; ">
Education:
<div style=" width:100px;   margin-left: 0px; border-bottom: solid #000; "></div> 
</div>
<div class="smallheaderfont" style="width:200px; height:40px; float:left;">
School:
<div style="width:200px; height:20px; ">
</div>
<div style=" width:180px;  margin-left: 10px; border-bottom: solid #dddfdc; "></div> 
</div>
<div class="smallheaderfont" style="width:200px; height:40px; float:left; ">
College:
<div style="width:200px; height:20px;  ">
</div>
<div style=" width:180px; margin-left: 10px; border-bottom: solid #dddfdc; "></div> 
</div>
    <?php } ?>
    <?php if($privacy['occupation']=='public'||($privacy['occupation']=='friends' && in_array($_REQUEST['userid'], $_SESSION['friends']))||($privacy['occupation']=='fof' && (count(array_intersect(unserialize($fv['friendlist']),$_SESSION['friends']))>=1 || in_array($_REQUEST['userid'], $_SESSION['friends'])) )|| $_SESSION['userid']==$_REQUEST['userid']) {?>
<div class="titleheaderfont" style="width:200px; height:20px; float:left; ">
Occupation:
<div style=" width:105px;   margin-left: 0px; border-bottom: solid #000; "></div> 
</div>
<div class="smallheaderfont" style="width:200px; height:40px; float:left; ">
Worked In:
<div style="width:200px; height:20px; float:left; ">
</div>
<div style=" width:180px; margin-top: 23px; margin-left: 10px; border-bottom: solid #dddfdc; "></div> 
</div>
    <?php } ?>
    <?php if($privacy['fav']=='public'||($privacy['fav']=='friends' && in_array($_REQUEST['userid'], $_SESSION['friends']))||($privacy['fav']=='fof' && (count(array_intersect(unserialize($fv['friendlist']),$_SESSION['friends']))>=1 || in_array($_REQUEST['userid'], $_SESSION['friends'])) )|| $_SESSION['userid']==$_REQUEST['userid']) {?>
<div class="titleheaderfont" style="width:200px; height:20px; float:left;">
Favourites:
<div style=" width:105px; margin-top: 0px;  margin-left: 0px; border-bottom: solid #000; "></div> 
</div>
    <div class="smallheaderfont" style="width:200px; float:left; ">
Book:
<div style="width:200px;  ">
    <ul class="prettyGallery">
	
		<?php
$leafs=unserialize($ud['books']);
$i=0;
  foreach($leafs as $leaf){
      if($i<11){
          $leaf_mini_mini=getminipro($leaf);
          echo '<li><a class="user-navigate" href="leaf.php?leafid='.$leaf.'"><img src="images/50/50_"'.$leaf_mini_mini['propic'].' width="45" height="45" alt="'.$leaf_mini_mini['username'].'" /></a></li>';
          
           }
           else
           {
               echo '<li><a class="user-navigate" href="#"><img src="images/prettyGallery/seemore.jpg" width="45" height="45" alt="T 1" /></a></li>';
               break;
           }
           $i++;
      }
?>
</ul>
</div>
<div style=" width:180px; margin-top: 20px;  margin-left: 10px; border-bottom: solid #dddfdc "></div> 
</div>
<div class="smallheaderfont" style="width:200px;  float:left; ">
Music Album:
<div style="width:200px;  ">
    <ul class="prettyGallery">
	
		<?php
$leafs=unserialize($ud['musics']);
$i=0;
  foreach($leafs as $leaf){
      if($i<11){
          $leaf_mini_mini=getminipro($leaf);
          echo '<li><a class="user-navigate" href="leaf.php?leafid='.$leaf.'"><img src="images/50/50_"'.$leaf_mini_mini['propic'].' width="45" height="45" alt="'.$leaf_mini_mini['username'].'" /></a></li>';
          
           }
           else
           {
               echo '<li><a class="user-navigate" href="#"><img src="images/prettyGallery/seemore.jpg" width="45" height="45" alt="T 1" /></a></li>';
               break;
           }
           $i++;
      }
?>
</ul>
</div>
<div style=" width:200px; margin-top: 20px;   margin-left: 1px; border-bottom: solid #dddfdc; "></div> 
</div>

<div class="smallheaderfont" style="width:200px;  float:left; ">
Movies:
<div style="width:200px;   ">
    <ul class="prettyGallery">
	
		<?php
$leafs=unserialize($ud['movies']);
$i=0;
  foreach($leafs as $leaf){
      if($i<11){
          $leaf_mini=getminipro($leaf);
          echo '<li><a class="user-navigate" href="leaf.php?leafid='.$leaf.'"><img src="images/50/50_"'.$leaf_mini['propic'].' width="45" height="45" alt="'.$leaf_mini['username'].'" /></a></li>';
          
           }
           else
           {
               echo '<li><a class="user-navigate" href="#"><img src="images/prettyGallery/seemore.jpg" width="45" height="45" alt="T 1" /></a></li>';
               break;
           }
           $i++;
      }
?>
</ul>
</div>
<div style=" width:200px; margin-top: 20px;   margin-left: 1px; border-bottom: solid #dddfdc; "></div> 
</div>
<div class="smallheaderfont" style="width:200px;  float:left; ">
Celebrities:
<div style="width:200px;  ">
    <ul class="prettyGallery">
	
		<?php
$leafs=unserialize($ud['celebrities']);
$i=0;
  foreach($leafs as $leaf){
      if($i<11){
          $leaf_mini=getminipro($leaf);
          echo '<li><a class="user-navigate" href="leaf.php?leafid='.$leaf.'"><img src="images/50/50_"'.$leaf_mini['propic'].' width="45" height="45" alt="'.$leaf_mini['username'].'" /></a></li>';
          
           }
           else
           {
               echo '<li><a class="user-navigate" href="#"><img src="images/prettyGallery/seemore.jpg" width="45" height="45" alt="T 1" /></a></li>';
               break;
           }
           $i++;
      }
?>
</ul>
</div>
<div style=" width:200px; margin-top: 20px;   margin-left: 1px; border-bottom: solid #dddfdc; "></div> 
</div>
<div class="smallheaderfont" style="width:200px;  float:left; ">
Games:
<div style="width:200px;   ">
    <ul class="prettyGallery">
	
		<?php
$leafs=unserialize($ud['games']);
$i=0;
  foreach($leafs as $leaf){
      if($i<11){
          $leaf_mini=getminipro($leaf);
          echo '<li><a class="user-navigate" href="leaf.php?leafid='.$leaf.'"><img src="images/50/50_"'.$leaf_mini['propic'].' width="45" height="45" alt="'.$leaf_mini['username'].'" /></a></li>';
          
           }
           else
           {
               echo '<li><a class="user-navigate" href="#"><img src="images/prettyGallery/seemore.jpg" width="45" height="45" alt="T 1" /></a></li>';
               break;
           }
           $i++;
      }
?>
</ul>
</div>
<div style=" width:200px; margin-top: 20px;   margin-left: 1px; border-bottom: solid #dddfdc; "></div> 
</div>
<div class="smallheaderfont" style="width:200px; float:left; ">
Sports:
<div style="width:200px; ">
    <ul class="prettyGallery">
	
		<?php
$leafs=unserialize($ud['sports']);
$i=0;
  foreach($leafs as $leaf){
      if($i<11){
          $leaf_mini=getminipro($leaf);
          echo '<li><a class="user-navigate" href="leaf.php?leafid='.$leaf.'"><img src="images/50/50_"'.$leaf_mini['propic'].' width="45" height="45" alt="'.$leaf_mini['username'].'" /></a></li>';
          
           }
           else
           {
               echo '<li><a class="user-navigate" href="#"><img src="images/prettyGallery/seemore.jpg" width="45" height="45" alt="T 1" /></a></li>';
               break;
           }
           $i++;
      }
?>
</ul>
</div>
<div style=" width:200px; margin-top: 20px;   margin-left: 1px; border-bottom: solid #dddfdc; "></div> 
</div>
<div class="smallheaderfont" style="width:200px; float:left; ">
Extras:
<div style="width:200px;  ">
    <ul class="prettyGallery">
	
		<?php
$leafs=unserialize($ud['other']);
$i=0;
  foreach($leafs as $leaf){
      if($i<11){
          $leaf_mini_mini=getminipro($leaf);
          echo '<li><a class="user-navigate" href="leaf.php?leafid='.$leaf.'"><img src="images/50/50_"'.$leaf_mini_mini['propic'].' width="45" height="45" alt="'.$leaf_mini_mini['username'].'" /></a></li>';
          
           }
           else
           {
               echo '<li><a class="user-navigate" href="#"><img src="images/prettyGallery/seemore.jpg" width="45" height="45" alt="T 1" /></a></li>';
               break;
           }
           $i++;
      }
?>
</ul>
</div>
<div style=" width:200px; margin-top: 20px;   margin-left: 1px; border-bottom: solid #dddfdc; "></div> 
</div>

<?php } ?>


</div>

</div>
<div id="tridiv" style="width:68%; margin-top: 10px; height:100%; float:right; ">

<div style="width:430px; height:230px; float:left; ">
<div onmouseout="hideBox('proic')" onmouseover="showBox('proic')" style="width:200px; margin:10px; height:200px; float:left; border:solid 1px">
 <span class="span_edit" id="proic"><a href="#">Edit</a></span>   <img id="profilepic" height="200" src='images/200/200_<?php echo imageurl($ud['propic']) ?>' />
</div>
<div style="width:200px; margin-right:6px; height:230px; float:right; ">
<div  onmouseout="hideBox('sp')" onmouseover="showBox('sp')"  id="secondarypic1" style="width:200px; height:100px; margin:5px; float:left; overflow: hidden; border:solid 1px">
<span class="span_edit" id="sp"><a href="#">Edit</a></span><img src='images/200/200_<?php echo imageurl($ud['secondarypic1']) ?>' />
</div>
<div onmouseout="hideBox('sp1')" onmouseover="showBox('sp1')" id="secondarypic2" style="width:200px; height:100px; margin:5px; float:left; overflow: hidden; border:solid 1px">
<span class="span_edit" id="sp1"><a href="#">Edit</a></span><img src='images/200/200_<?php echo imageurl($ud['secondarypic2']) ?>'/>
</div>

</div>

</div>

<div class="pin-prof-pic" >
<?php $pinnedpics=  unserialize($ud['pinnedpic']);
    $i=0;
    foreach($pinnedpics as $pic)
    {
        if($i<14)
        {
            $iprivacy=getimageprivacy($pic);
            $minipro=getminipro($iprivacy['userid']);
            if($iprivacy['pt']=='public' || ($iprivacy['pt']=='friends' && in_array($_SESSION['userid'], $minipro['friends'])) ||($iprivacy['pt']=='fof' && (count(array_intersect($_SESSION['friends'], $minipro['friends']))>=1 || in_array($_SESSION['userid'], $minipro['friends']))) || in_array($_REQUEST['userid'], $_SESSION['friends']) || $_SESSION['userid']==$_REQUEST['userid'] || $_SESSION['userid']==$minipro['userid'] ) {
                echo "<img src='images/75/75_".$iprivacy['url']."' height='70' width='70' />";
        }
        $i++;
        }
        
    }


?>
</div>

<div id="stature-div" class="titleheaderfont" style="width:90%; padding: 3px; margin:5px;  float:left">
    <b style="margin-left: 5px">Stature</b>
<div style=" width:70px; margin-top: 0px;  margin-left: 3px; border-bottom: solid #000; "></div> 
<div style="width:98%;overflow: hidden; margin-left: 10px; margin-top: 5px; font-family: cursive; font-size: 12px; font-weight: bold;">
    <p ><?php $results2=mysql_query("select status from status where suserid='".$_REQUEST['userid']."' and ruserid='".$_REQUEST['userid']."' order by date desc limit 0,1");
    while($row3=  mysql_fetch_assoc($results2))
        echo htmlspecialchars ($row3['status']);
    ?></p>
</div>
</div>
<div id="subdivtab" style="width:100%; border-top:solid 1px; border-bottom:solid 1px; float:left; height:30px; ">
<ul class="sub-link-tab" >
<li><a class="user-navigate" href="profile.php?userid=<?php echo $_REQUEST['userid']; ?>">Streams</a></li>
<li><a class="user-navigate" href="profile.php?userid=<?php echo $_REQUEST['userid']; ?>&tab=scribbles">Scribbles</a></li>
<li><a class="user-navigate" href="profile.php?userid=<?php echo $_REQUEST['userid']; ?>&tab=albums">Albums</a></li>
<li><a class="user-navigate" href="profile.php?userid=<?php echo $_REQUEST['userid']; ?>&tab=blogs">Blogs</a></li>
<li><a class="user-navigate" href="profile.php?userid=<?php echo $_REQUEST['userid']; ?>&tab=admire">Admirations</a></li>
<li><a class="user-navigate" href="profile.php?userid=<?php echo $_REQUEST['userid']; ?>&tab=videos">Videos</a></li>
</ul>
</div>
   
    <div id="main-content">
        <?php if(isset($_REQUEST['tab'])) {
    if($_REQUEST['tab']=='albums'){ ?>
        getalbums('<?php echo $_REQUEST['userid']; ?>');
<?php } else if($_REQUEST['tab']=='blogs'){ if($_SESSION['userid']==$_REQUEST['userid']) { ?>

   <input onclick="document.getElementById('light4').style.display='block';document.getElementById('fade4').style.display='block';" style="float:right" type="button" value="create"/>
<?php } } else if($_REQUEST['tab']=='admire'){ if($_SESSION['userid']!=$_REQUEST['userid']) {?>
    <input onclick="document.getElementById('light5').style.display='block';document.getElementById('fade5').style.display='block';" style="float:right" type="button" value="create"/>

<?php } }
else if($_REQUEST['tab']=='videos'){ if($_SESSION['userid']==$_REQUEST['userid']) {?>
    <input onclick="document.getElementById('light6').style.display='block';document.getElementById('fade6').style.display='block';" style="float:right" type="button" value="Add video"/>

<?php } } } else { ?>
    <div style="width:100%; float:left">
        <form name="postform" >
<div style="width:100%; margin-top: 10px; float:left; ">
<textarea id="message-content" name="post" style="resize:none; margin-top:0px; margin-left:0px; width:99%"  class="expand" onclick="expand()" ></textarea>
</div>

<div class="status-post-div">
<ul>
<li><a onclick="dopost('<?php echo $_REQUEST['userid'];?>','user')">Post</a></li></ul>

<div style="width:200px; float:left">
</div>

<select style="float:right"><option value="-1">Select:</option><option value="1">Friends</option><option value="2">FOF</option><option value="3">Public</option><option value="4">Private</option><option value="5">Specific</option><option value="6">Hidden</option></select>
</div>
        </form>
</div>


<?php }
?>
<div id="userstream" style="width:100%; float:left;">
   
</div>
    </div>
    <script type="text/javascript">
<?php if(isset($_REQUEST['tab'])) {
    switch ($_REQUEST['tab']){
    case 'albums': ?>
        getalbums('<?php echo $_REQUEST['userid']; ?>');
<?php break; case 'blogs': ?>
    getblogs('<?php echo $_REQUEST['userid']; ?>'); 
<?php break; case 'admire': ?>
    getadmire('<?php echo $_REQUEST['userid']; ?>');
<?php break; case 'scribbles':
    echo "getmystreams('".$_REQUEST['userid']."','scribbles');";
    break;
default:
    echo "getmystreams('".$_REQUEST['userid']."','posts');";
    break;
    }
    
    } else {?>
    getmystreams('<?php echo $_REQUEST['userid']; ?>','posts');
<?php }
?>
</script>
</div>



</div>
<div id="fourthdiv" style="width:20%; float:right;  ">
    <div style="width:100%; right: 0px;height:50px;  float:right">
<div id="sidedivtab" style="width:350px; height:50px; margin-left: -160px;   float:left">
<?php if($_SESSION['userid']!= $_REQUEST['userid']){ ?>
<ul>
  <?php $frnds=$_SESSION['friends'];
if(in_array($_REQUEST['userid'], $frnds)){
?>
<li ><a  onclick="removefrnd('<?php echo $_REQUEST['userid']; ?> ')">Remove </a></li>
<?php } else if(in_array($_REQUEST['userid'], $_SESSION['sentrequest'])){ ?>
<li ><a  onclick="cancelfrndreq('<?php echo $_REQUEST['userid']; ?>')">Cancel Req </a></li>
<?php } else if(in_array($_REQUEST['userid'], $_SESSION['bendingrequest'])){ ?>
<li ><a  onclick="getinvites('<?php echo $_REQUEST['userid']; ?>');document.getElementById('light1').style.display='block';document.getElementById('fade1').style.display='block';">Respond to Req </a></li>
<?php }else{ ?>
<?php if(($privacy['request']=='public'||($privacy['request']=='fof' && count(array_intersect(unserialize($fv['friendlist']),$_SESSION['friends']))>=1  )) && !in_array($_REQUEST['userid'], $_SESSION['friends'])) {?>  
<li><a onclick="createinvitation('<?php echo $_REQUEST['userid'] ?>','<?php echo $ud['fname'].' '.$ud['lname'] ?>');document.getElementById('light1').style.display='block';document.getElementById('fade1').style.display='block';">Add Me</a></li>
<?php } ?>
<?php } ?>
<?php if(($privacy['message']=='public'||($privacy['message']=='friends' && in_array($_REQUEST['userid'], $_SESSION['friends']))||($privacy['message']=='fof' && (count(array_intersect(unserialize($fv['friendlist']),$_SESSION['friends']))>=1 || in_array($_REQUEST['userid'], $_SESSION['friends']) )  ))) {?>  
<li><a onclick="document.getElementById('light3').style.display='block';document.getElementById('fade3').style.display='block';">Mess</a></li>
<?php } ?>
<li><a href="#">Apps</a></li>
<?php 
if(in_array($_SESSION['userid'], $votes)){
?>
<li ><a onclick="withdrawuservote('<?php echo $_REQUEST['userid']; ?>')">Withdraw</a></li>
<?php }else{ ?>
<li ><a  onclick="voteuser('<?php echo $_REQUEST['userid']; ?>')">Vote</a></li>
<?php } ?></ul>
    <?php } ?>
</div>
</div>
<div id="friends-div" style="width:200px; font-size: 18px; font-weight: bold; margin-top:0px;  max-height: 340px;   float:right; ">
My Freniz
<div style="width:32px; height:32px; margin-right: 5px; margin-top: 5px; float:right;"><img src="images/mood/<?php echo $ud['mood']; ?>" height="32" width="32"/></div>
<?php if($_SESSION['userid']!=$_REQUEST['userid']) { ?>
<div style="width:150px; font-size: 12px; height:20px; float:left;"> Mutual : <?php echo count(array_intersect($_SESSION['friends'], unserialize($fv['friendlist']))) ; ?></div>
<?php } ?>
<?php if(($privacy['friendlist']=='public'||($privacy['friendlist']=='friends' && in_array($_REQUEST['userid'], $_SESSION['friends']))||($privacy['friendlist']=='fof' && (count(array_intersect(unserialize($fv['friendlist']),$_SESSION['friends']))>=1 || in_array($_REQUEST['userid'], $_SESSION['friends']) )  ))|| $_SESSION['userid']==$_REQUEST['userid']) {?>  
<div id="boxscroll" >
<?php $frnds1=unserialize($fv['friendlist']);

foreach($frnds1 as $user){
    $minipro=getminipro($user);?>
    <div style="height:50px; width:200px;">
<div style="height:32px; float:right; margin:5px; width:32px; border:solid 1px">
    <img src="images/32/32_<?php echo $minipro['propic']; ?>" height="32" width="32" />
</div>
<div style="height:50px; float:right; width:120px">
<div style=" font-size: 12px; font-weight: bold;  width:120px; ">
    <a class="user-navigate" href="profile.php?userid=<?php echo $minipro['userid']; ?>"><?php echo $minipro['username']; ?></a>
</div>
<div style="height:25px; font-size: 12px; width:120px;">
    <?php if($minipro['userid']!=$_SESSION['userid']){ ?>
        <div style="height:25px; width:60px; float: left">
            <a>Mutual : <?php echo count(array_intersect($_SESSION ['friends'], $minipro['friends'])); ?></a>
</div>
    <?php } ?>
    <div style="height:25px; width:60px; float: left ">
     <a>votes : <?php echo count($minipro['votes']); ?></a>
</div>
</div>
</div>
<div id="simley"style='height:30px; width:30px; margin:3px; ' >
    <img src="images/mood/<?php echo $minipro['mood']; ?>" height="30" width="30"/>
</div>
        <div style=" width:180px; margin-top: 15px; margin-left: 10px; border-bottom: solid 1px; "></div>    
</div>
<?php }
?>
</div>
<?php } ?>
</div>


</div>


</div>
<?php }?>
    <div id="light1" class="white_content" style=" border:solid 6px;width:400px">
</div>
<div id="fade1" onClick="document.getElementById('light1').style.display='none';  document.getElementById('fade1').style.display='none'" class="black_overlay">
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
    <div id="fade3" onClick="document.getElementById('light3').style.display='none';  document.getElementById('fade3').style.display='none'" class="black_overlay">
        </div>
        
        
         <div id="light4" style="width:550px; height:240px; " class="white_content">
        
       
<div style="width:500px; height:200px; margin-left:20px; margin-top:20px; ">

<form name="blogmessage" onsubmit="createblogstatus()">
<div style="width:300px; height:20px; margin-top:10px; margin-left:60px; float:left;">
<input type="text" id="blg_title" size="40" />
</div>
<div style="width:300px; height:100px; margin-top:10px; margin-left:60px; float:left;">
<textarea rows="4" cols="50" id="blg" >
</textarea>
</div>
<div style="width:300px; height:20px; margin-top:10px; margin-left:60px; float:left;">
<input type="file" id="blg_url" value="Upload" size="40" />
</div>

<div style="width:300px;  margin-left:40px;">

  <ul class="roundbuttons sendmessagewidth" style="margin-left:40px;">
  <li><input type="button" name="cancel" value="cancel" onClick="document.getElementById('light4').style.display='none';   document.getElementById('fade4').style.display='none';"  /></li>
  <li><input type="button" name="send" value="send" onclick="createblogstatus()" /></li>
  </ul>


</div>
</form>
</div>
        
        </div>
    <div id="fade4" onClick="document.getElementById('light4').style.display='none';  document.getElementById('fade4').style.display='none'" class="black_overlay">
        </div>
        
        
        <div id="light5" style="width:550px; height:240px; " class="white_content">
        
       
<div style="width:500px; height:200px; margin-left:20px; margin-top:20px; ">

<form name="admiremess" onsubmit="createadmirestatus(<?php echo $_REQUEST['userid'] ?>)">

<div style="width:300px; height:100px; margin-top:10px; margin-left:60px; float:left;">
<textarea rows="4" cols="50" name="admr" >
</textarea>
</div>


<div style="width:300px; ">

  <ul class="roundbuttons sendmessagewidth">
  <li><input type="button" name="admire-cancel" value="cancel" onClick="document.getElementById('light5').style.display='none';   document.getElementById('fade5').style.display='none';"  /></li>
  <li><input type="button" name="admire-send" value="send" onclick="createadmirestatus('<?php echo $_REQUEST['userid'] ?>')" /></li>
  </ul>


</div>
</form>
</div>
     
        </div>
    <div id="fade5" onClick="document.getElementById('light5').style.display='none';  document.getElementById('fade5').style.display='none'" class="black_overlay">
        </div>
    
     <div id="light6" style="width:550px; height:240px; " class="white_content">
        
       
<div style="width:500px; height:200px; margin-left:20px; margin-top:20px; ">

<form name="video-upd" onsubmit="addvideos()">

<div style="width:300px; height:100px; margin-top:10px; margin-left:60px; float:left;">
<textarea rows="4" cols="50" name="video-addr" >
</textarea>
</div>

<div style="width:300px; ">

  <ul class="roundbuttons sendmessagewidth">
  <li><input type="button" name="video-cancel" value="cancel" onClick="document.getElementById('light6').style.display='none';   document.getElementById('fade6').style.display='none';"  /></li>
  <li><input type="button" name="video-send" value="send" onclick="addvideos()" /></li>
  </ul>


</div>
</form>
</div>
        
        </div>
    <div id="fade6" onClick="document.getElementById('light6').style.display='none';  document.getElementById('fade6').style.display='none'" class="black_overlay">
        </div>
 <div style="width:100%; float:left; height:60px; border:solid 1px #F9C;">
 </div>           
        
        <div id="musictab">


  <div style=" float:left; width:40%; ">
   <p id="audioplayer_1" style=" background-color:#333">Alternative content</p>
        </div> 
        <div style="height:20px; float:left; color:#FFF; font-weight:bold; font-size:14px; margin-top:5px; width:100px; ">
        (c)Freniz.com
  </div>  
        <script type="text/javascript">  
        AudioPlayer.embed("audioplayer_1", {soundFile: "ff.mp3"});
		AudioPlayer.open("audioplayer_1",2);
        </script> 
       
</div>
 <script type="text/javascript">
     var options_xmlsearch = function(type,appendto){
     if(!appendto)
        appendto='body'; 
                
     var options={
                script:"ajax/search.php?type="+type+"&",
		varname:"key",
                type:type,
                appendto:appendto
            };
            return options;
	}
        var as_xmlsearch = new AutoSuggest('searchusers', options_xmlsearch('all'));
</script>
</body>
</html>
