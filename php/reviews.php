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
<title>Freniz - <?php echo $ud['fname'].' '.$ud['lname']; ?></title>
<link href="css/style.css" rel="stylesheet" />
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<link href="css/fileuploader.css" rel="stylesheet" type="text/css">
<link href="css/blue-world.css" rel="stylesheet" type="text/css"/>
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
#request-user-pic ul{
	margin-top:3px;
	display:block;
}
#request-user-pic ul li{
	display:inline;
}
#update-pic-comment ul{
	margin-top:3px;
	display:block;
}
#update-pic-comment ul li{
	display:inline;
}
.updatepic-main-div{
	width:100%; border:solid #6F3 3px; float:left;

}
</style>

<style>

#update-stature-comment ul{
	margin-top:3px;
	display:block;
}
#update-stature-comment ul li{
	padding:5px;
	border:solid 1px;
	display:inline;}
	.main-update-stature{
		width:100%; border:solid 1px; float:left;
	}
</style>

<script type="text/javascript" src="js/ajax.js"></script>
<script>
    function getreviews()
    {
        request.onreadystatechange=displayreviews;
        request.open('get','ajax/getreviews.php',true);
        request.send(null);
    }
    function displayreviews()
    {
        if(request.readyState==4 && request.status==200){
           var xml=request.responseXML;var users_de=""; var imageid='';
           var main=document.createElement('div');
           $(xml).find('reviews').each(function(){
              $(this).find('post').each(function(){
                  var a=document.createElement('div');
                    a.innerHTML='<input type="checkbox"  style="float:left;display:none" /><div style="width:95%; border:solid 1px; float:left"><div style="width:100%; border:solid 1px; float:left"><div style="width:50px; height:50px; float:left; border:solid 1px"><img src="images/32/32_'+$(this).find('userpic').text()+'" width="50" height="50"/></div><div style="border:solid 1px; float:left">'+$(this).find('username').text()+'</div></div><div style="width:100%; margin-top:10px; height:100px; border:solid 1px; float:left">'+$(this).find('status').text()+'</div><div style="width:100%; margin-top:10px; height:20px; border:solid 1px; float:left"><div style="height:20px; border:solid 1px; float:left">'+$(this).find('date').text()+'</div></div><div id="update-stature-comment" style="width:100%; height:30px; border:solid 1px; float:left"><ul><li><a  style="float:left; font-size:14px; font-weight:bold; text-decoration:none; cursor:pointer;color:#666" onclick="approve(\''+$(this).find('id').text().trim()+'\',\'posts\')">Accept</a></li><li><a  style="float:left; margin-left:10px; font-size:14px; font-weight:bold; text-decoration:none; cursor:pointer;color:#666" onclick="deny(\''+$(this).find('id').text()+'\',\'posts\')">Deny</a></li></ul></div></div></div>';
                    main.appendChild(a);
              }); 
              $(this).find('admire').each(function(){
                  var a=document.createElement('div');
                    a.innerHTML='<input type="checkbox"  style="float:left;display:none" /><div style="width:95%; border:solid 1px; float:left"><div style="width:100%; border:solid 1px; float:left"><div style="width:50px; height:50px; float:left; border:solid 1px"><img src="images/32/32_'+$(this).find('userpic').text()+'" width="50" height="50"/></div><div style="border:solid 1px; float:left">'+$(this).find('username').text()+'</div></div><div style="width:100%; margin-top:10px; height:100px; border:solid 1px; float:left">'+$(this).find('status').text()+'</div><div style="width:100%; margin-top:10px; height:20px; border:solid 1px; float:left"><div style="height:20px; border:solid 1px; float:left">'+$(this).find('date').text()+'</div></div><div id="update-stature-comment" style="width:100%; height:30px; border:solid 1px; float:left"><ul><li><a  style="float:left; font-size:14px; font-weight:bold; text-decoration:none; cursor:pointer;color:#666" onclick="approve(\''+$(this).find('id').text().trim()+'\',\'admires\')">Accept</a></li><li><a  style="float:left; margin-left:10px; font-size:14px; font-weight:bold; text-decoration:none; cursor:pointer;color:#666" onclick="deny(\''+$(this).find('id').text()+'\',\'admires\')">Deny</a></li></ul></div></div></div>';
                    main.appendChild(a);
              }); 
              $(xml).find('image1').each(function(){
                  var a=document.createElement('div');
                  a.innerHTML='<input type="checkbox"  style="float:left;display:none" /><div style="width:95%; border:solid 1px; float:left"><div style="width:100%;  border:solid 1px; float:left"><div style="width:50px; height:50px; float:left; border:solid 1px"><img src="images/32/32_'+$(this).find('userpic').text()+'" width="50" height="50"/></div><div style="border:solid 1px; float:left">'+$(this).find('username').text()+'</div></div><div style="width:100%; border:solid 1px; float:left"></div><div style="margin-top:10px; margin-left:20%; border:solid 2px; float:left"><img src="images/200/200_'+$(this).find('url').text()+'" height="200" width="200" /></div><div style="margin-left:15%; width:80%;  border:solid #F6C 2px; float:left">'+$(this).find('description').text()+'</div><div style="width:100%; height:20px; margin-top:10px; border:solid 1px; float:left"><div style="height:20px; border:solid 1px; float:left">'+$(this).find('date').text()+'</div><div style=" height:20px; border:solid 1px; float:right">'+$(this).find('title').text()+'</div></div><div id="update-pic-comment" style="width:100%; height:20px; border:solid 1px; float:left"><ul><li><a href="#" style="float:left; font-size:14px; font-weight:bold; text-decoration:none; cursor:pointer;color:#666" onclick="approve(\''+$(this).find('id').text()+'\',\'images\')">Accept</a></li><li><a href="#" style="float:left; font-size:14px; font-weight:bold; text-decoration:none; margin-left:10px; cursor:pointer;color:#666" onclick="deny(\''+$(this).find('id').text()+'\',\'images\')">Deny</a></li></ul></div></div>';
                  main.appendChild(a);
              });
              $(xml).find('pinnedpic').each(function(){
                  var a =document.createElement('div');
                  a.innerHTML='<input type="checkbox"  style="float:left;display:none" /><div style="width:95%; border:solid 1px; float:left"><div style="width:100%;  border:solid 1px; float:left"><div style="width:50px; height:50px; float:left; border:solid 1px"><img src="images/32/32_'+$(this).find('ruserpic').text()+'" width="50" height="50"/></div><div style="border:solid 1px; float:left">'+$(this).find('rusername').text()+'</div></div><div style="width:100%; border:solid 1px; float:left"></div><div style="margin-top:10px; margin-left:20%; border:solid 2px; float:left"><img src="images/200/200_'+$(this).find('url').text()+'" height="200" width="200" /></div><div style="margin-left:15%; width:80%;  border:solid #F6C 2px; float:left">'+$(this).find('description').text()+'</div><div style="width:100%; height:20px; margin-top:10px; border:solid 1px; float:left"><div style=" height:20px; border:solid 1px; float:left">'+$(this).find('date').text()+'</div><div style=" height:20px; border:solid 1px; float:right">'+$(this).find('title').text()+'</div></div><div id="update-pic-comment" style="width:100%; height:20px; border:solid 1px; float:left"><ul><li><a href="#" style="float:left; font-size:14px; font-weight:bold; text-decoration:none; cursor:pointer;color:#666" onclick="approve(\''+$(this).find('id').text()+'\',\'pinnedpics\')">Accept</a></li><li><a href="#" style="float:left; font-size:14px; font-weight:bold; text-decoration:none; margin-left:10px; cursor:pointer;color:#666" onclick="deny(\''+$(this).find('id').text()+'\',\'pinnedpics\')">Deny</a></li></ul></div></div>';
                  main.appendChild(a);
              });
              $(xml).find('otherpinreq').each(function(){
                  var a =document.createElement('div');
                  imageid=$(this).find('id').text();
                  users_de='<input type="checkbox" style="float:left;display:none" /><div style="width:95%; border:solid 1px; float:left"><div style="width:100%;  border:solid 1px; float:left"><div style="width:50px; height:50px; float:left; border:solid 1px"><img src="images/32/32_'+$(this).find('suserpic').text()+'" width="50" height="50"/></div><div style="border:solid 1px; float:left">'+$(this).find('susername').text()+'</div></div><div style="width:100%; border:solid 1px; float:left"></div><div style="margin-top:10px; margin-left:20%; border:solid 2px; float:left"><img src="images/200/200_'+$(this).find('url').text()+'" height="200" width="200" /></div><div style="margin-left:15%; width:80%; border:solid #F6C 2px; float:left">'+$(this).find('description').text()+'</div><div style="width:100%; height:20px; margin-top:10px; border:solid 1px; float:left"><div style=" height:20px; border:solid 1px; float:left">'+$(this).find('date').text()+'</div><div style="height:20px; border:solid 1px; float:right">'+$(this).find('title').text()+'</div></div>';
                      $(this).find('user').each(function(){
                        users_de+= '<div style="width:100%; height:40px; border:solid 1px; float:left"><div style="width:32px; height:32px; border:solid 1px; float:left"><img src="images/32/32_'+$(this).find('userpic').text()+'" width="32" height="32"/></div><div style="height:20px; border:solid 1px; float:left">'+$(this).find('username').text()+'</div><div id="request-user-pic" style="margin-right:5px;float:right"><ul><li><a href="#" style="float:left; font-size:14px; font-weight:bold; text-decoration:none; cursor:pointer;color:#666" onclick="approve(\''+$(this).find('userid').text()+'\',\'otherpinreqs\',\''+imageid+'\')" >Accept</a></li><li><a href="#" style="float:left; font-size:14px; font-weight:bold; text-decoration:none; margin-left:10px; cursor:pointer;color:#666" onclick="deny(\''+$(this).find('userid').text()+'\',\'otherpinreqs\',\''+imageid+'\')">Deny</a></li></ul></div></div>';
                      });
                          a.innerHTML+=users_de+'</div>';
                  main.appendChild(a);
              });
           });
           $("#maincontainer").html(main.innerHTML);
        }
    }
    function approve(id,type,imageid){
    request.onreadystatechange=approveitem;
    if(imageid){
      request.open('get','ajax/approvereviews.php?type='+type+'&userids='+id+'&imageid='+imageid+'&action=accept',true);
    }
    else
    request.open('get','ajax/approvereviews.php?type='+type+'&ids='+id+'&action=accept',true);
    request.send(null);
    }
    function approveitem()
    {
        if(request.readyState==4 && request.status==200)
            {
                alert(request.responseText);
                var json=eval('('+request.responseText+')');
                alert(json.status);
                getreviews();
            }
    }
    function deny(id,type,imageid){
    request.onreadystatechange=denyitem;
    if(imageid){
        request.open('get','ajax/approvereviews.php?type='+type+'&userids='+id+'&imageid='+imageid+'&action=deny',true);
    }
    else
    request.open('get','ajax/approvereviews.php?type='+type+'&ids='+id+'&action=deny',true);
    alert('ajax/approvereviews.php?type='+type+'&ids='+id+'&action=deny');
    request.send(null);
    }
    function denyitem()
    {
        if(request.readyState==4 && request.status==200)
            {
                var json=eval('('+request.responseText+')');
                alert(json.status);
                getreviews();
            }
    }
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
<div id='maincontainer' style="width:100%; height:100%; float:left; border:solid 1px">
    <script>
        getreviews();
    </script>

</div>
</body>
</html>