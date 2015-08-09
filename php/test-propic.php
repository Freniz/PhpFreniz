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
           window.onload=function(){createUploader('34',false,false);}
            
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
                create.appendChild(a);
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
   $(".popup span").css("width","150px");
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
    <img id="loading" src="images/prettyGallery/loading-gif-animation.gif" style="position:absolute; display: none; margin-left: 45%" height="32" width="32"></img>
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
<input class="search-box" id="searchusers"  type="text" value="Search..." onfocusout="searchitemsout(this)" onfocus="searchitemsin(this)" style="width:200px; height:20px" />
</div>
</div>


</div>
<div id="file-uploader-demo1">		
		<noscript>			
			<p>Please enable JavaScript to use file uploader.</p>
			<!-- or put a simple form for upload here -->
		</noscript>         
	</div>
</body>
</html>
