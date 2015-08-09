<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'ajax/getminiprofile.php';
?>
<?php 
    mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
    mysql_select_db("fztest1") or die ("coudnt find database");    
    ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Freniz - </title>
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

.update-stature-comment ul{
	margin-top:3px;
	display:block;
}
.update-stature-comment ul li{
	display:inline;}
	.main-update-stature{
		width:100%; border:solid 1px; float:left;
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
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript">
function displaypost(userpic,title,status,commentcount,votes,date){
	var main=document.getElementById('maincontainer');
	var a=document.createElement('div');
	a.className='main-update-stature';
	a.innerHTML='<div style="width:100%; border:solid 1px; float:left"><div style="height:50px;width:50px;float:left"><img src="images/50/50_"'+userpic+' width="50" height="50"></div><div style="float:right;width:80%">'+title+'</div> </div><div style="width:100%; margin-top:10px; height:100px; border:solid 1px; float:left">'+status+'</div><div style="width:100%; margin-top:10px; height:20px; border:solid 1px; float:left"><div style="width:100px; font-size:10px; height:20px; border:solid 1px; float:left">'+date+'</div></div><div class="update-stature-comment" style="width:100%; height:30px; border:solid 1px; float:left"><ul><li><a href="#" style="float:left; font-size:14px; font-weight:bold;text-decoration:none; cursor:pointer;color:#666">Vote</a></li></ul><div style="margin-top:-15px;"><ul style="margin-top:3px;"><li><a href="#" style="float:right; font-size:14px; font-weight:bold; text-decoration:none; color:#666; cursor:pointer;">Comment</a></li></ul></div></div>';
	main.appendChild(a);
	
}
function displayblog(userpic,title,text,date){
	var main=document.getElementById('maincontainer');
	var a=document.createElement('div');
	a.className='main-update-stature';
	a.innerHTML='<div style="width:100%; border:solid 1px; float:left"><div style="height:50px;width:50px;float:left"><img src="images/50/50_"'+userpic+' width="50" height="50"></div><div style="float:right;width:80%">'+title+'</div> </div><div style="width:100%; margin-top:10px; height:100px; border:solid 1px; float:left">'+text+'</div><div style="width:100%; margin-top:10px; height:20px; border:solid 1px; float:left"><div style="width:100px; font-size:10px; height:20px; border:solid 1px; float:left">'+date+'</div></div><div id="update-stature-comment" style="width:100%; height:30px; border:solid 1px; float:left"><ul><li><a href="#" style="float:left; font-size:14px; font-weight:bold;text-decoration:none; cursor:pointer;color:#666">Vote</a></li></ul></div><div style="width:100%; float:left; border:solid #0CC 1px"><div style="width:100%; float:left; border:solid 1px"><input type="text" style="width:99%; height:20px" /></div><div id="comment-div" style="width:100%; float:left; border:solid #C09 1px"></div></div>';
	main.appendChild(a);
	
}

</script>
</head>

<body>
<div class="headerdiv">
<div style="width:200px; float:left; height:70px; ">
<a class="headername" href="#">Freniz</a>
</div>
<div style="width:40px; float:left; border:solid #FFF; height:70px; ">
<img src="images/mood/<?php echo $_SESSION['mood'];?>" width="40" height="40"/>
</div>
<div style="width:400px; float:left; height:80px; ">

<ul>
<li><a href="#">Stream</a></li>
<li><a href="#">Biog</a></li>
<li><a href="#">Message</a></li>
<li><a href="#">Blog</a></li>
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
<div style="width:35%; float:left; border:solid 1px; height:400px"></div>
<div id='maincontainer' style="width:60%; float:right; border:solid 1px">
    <script type="text/javascript">
    <?php /*
        $query="select distinct t.userid,t.ruserid,t.contentid,t.title,t.contenttype,t.contenturl,t.date  from activity t  join(select distinct userid,ruserid,contentid,title,contenttype,contenturl,max(date) date from activity where ruserid !='".$_SESSION['userid']."' and (";
        $query=queryappend($query);
        function queryappend($query,$char=null){
        $l=count($_SESSION['friends']);
        $i=0;
        foreach($_SESSION['friends'] as $user)
            {
                if(++$i!=$l)
                {
                    if(isset($char))
                    $query.=" ".$char.".userid='".$user."' or ";
                    else
                       $query.=" userid='".$user."' or "; 
                }
                else
                {
                    if(isset($char))
                    $query.=" ".$char.".userid='".$user."' ) ";
                    else
                       $query.=" userid='".$user."' ) ";
                }
            }
            return $query;
        }
        $query.="group by contenturl) r on t.date=r.date and t.contenttype=r.contenttype where t.ruserid !='".$_SESSION['userid']."' and (";
        $query=queryappend($query,"t");
        $query.=" order by date desc";
        $result=  mysql_query($query);
        $userignore=array();
        while($row=  mysql_fetch_assoc($result))
        {
           $minipro=getminipro($row['userid']);
            if($row['contenttype']=='post'){
               $result2=mysql_query("select statusid,suserid,ruserid,status,commentcount,vote,date,pt,specificlist,hiddenlist from status where statusid='".$row['contentid']."'");
               while($row2=  mysql_fetch_assoc($result2))
               {
                    $privacy=$row2['pt'];
                    $specific=  unserialize($row2['specificlist']);
                    $hiddenlist=  unserialize($row2['hiddenlist']);
                    $minipro1=getminipro($row2['ruserid']);
                    $rusrfrnds=$minipro1['friends'];
                    if((($privacy=='public'||($privacy=='friends' && in_array($row2['ruserid'],$_SESSION['friends']))||($privacy=='fof' && count(array_intersect($rusrfrnds, $_SESSION['friends'])>=1) )||($privacy=='specific' && in_array($_SESSION['userid'], $specific)))&& !in_array($row2['ruserid'], $_SESSION['blocklist']) && !in_array($row2['ruserid'], $_SESSION['blockedby']) && !in_array($_SESSION['userid'], $hiddenlist))|| $_SESSION['userid']==$row2['ruserid']){
                        $userpic=$minipro['propic'];
                        $title="<a href=\"profile.php?userid=".$minipro['userid']."\">".$minipro['username']."</a>";
                        if($row['title']=='posted on'){
                        if($row2['suserid']==$row2['ruserid'])
                        {
                            if($minipro['sex']=='female')
                            $title.=" updated her <a href=\"post.php?postid=".$row2['statusid']."\">stature</a>";
                            else if($minipro['sex']=='male')
                                $title.=" updated his <a href=\"post.php?postid=".$row2['statusid']."\">stature</a>";
                            else
                                $title.=" updated it\'s <a href=\"post.php?postid=".$row2['statusid']."\">stature</a>";
                        }
                        else
                            $title.=" posted on <a href=\"profile.php?userid=".$minipro1['userid']."\">".$minipro1['username']."</a>\'s chart";
                        echo "displaypost('".$userpic."','".$title."','".$row2['status']."','".$row2['commentcount']."','".$row2['vote']."','".$row2['date']."');";
                        }
                        else if($row['title']=='commented on'){
                            $result3=mysql_query("select userid from comment where statusid='".$row2['statusid']."'");
                            $commentedusers=array();
                            while($row3=  mysql_fetch_assoc($result3))
                            {
                                array_push($commentedusers, $row3['userid']);
                            }
                            $mutual=array_intersect($commentedusers, $_SESSION['friends']);
                            if(count($mutual)>1)
                                $title.=" and ".(count($mutual)-1). " other friends ";
                            $title.= " Commented on <a href=\'profile.php?userid=".$minipro1['userid']."\' > ".$minipro1['username']."</a>\'s <a href=\'post.php?postid=".$row2['statusid']."\'>post</a>";
                            echo "displaypost('".$userpic."','".$title."','".$row2['status']."','".$row2['commentcount']."','".$row2['vote']."','".$row2['date']."');";
                        }
                        else if($row['title']=='voted on'){
                            $mutual=array_intersect(unserialize($row2['vote']), $_SESSION['friends']);
                            if(count($mutual)>1)
                                $title.=" and ".(count($mutual)-1). " other friends ";
                            $title.= " voted on <a href=\'profile.php?userid=".$minipro1['userid']."\' > ".$minipro1['username']."</a>\'s <a href=\'post.php?postid=".$row2['statusid']."\'>post</a>";
                            echo "displaypost('".$userpic."','".$title."','".$row2['status']."','".$row2['commentcount']."','".$row2['vote']."','".$row2['date']."');";
                        }
                    }
               }
         }
         else if($row['contenttype']=='blog'){
               $result2=mysql_query("select blogid,userid,blog,vote,date,pt,specificlist,hiddenlist from blog where blogid='".$row['contentid']."'");
               while($row2=  mysql_fetch_assoc($result2))
               {
                    $privacy=$row2['pt'];
                    $specific=  unserialize($row2['specificlist']);
                    $hiddenlist=  unserialize($row2['hiddenlist']);
                    $minipro1=getminipro($row2['userid']);
                    $rusrfrnds=$minipro1['friends'];
                    if((($privacy=='public'||($privacy=='friends' && in_array($row2['userid'],$_SESSION['friends']))||($privacy=='fof' && count(array_intersect($rusrfrnds, $_SESSION['friends'])>=1) )||($privacy=='specific' && in_array($_SESSION['userid'], $specific)))&& !in_array($row2['userid'], $_SESSION['blocklist']) && !in_array($row2['userid'], $_SESSION['blockedby']) && !in_array($_SESSION['userid'], $hiddenlist))|| $_SESSION['userid']==$row2['userid']){
                        $userpic=$minipro['propic'];
                        $title="<a href=\"profile.php?userid=".$minipro['userid']."\">".$minipro['username']."</a>";
                        if($row['title']=='write blog'){
                          if($minipro['sex']=='female')
                            $title.=" updated her <a href=\"blog.php?blogid=".$row2['blogid']."\">blog</a>";
                            else if($minipro['sex']=='male')
                                $title.=" updated his <a href=\"blog.php?blogid=".$row2['blogid']."\">blog</a>";
                            else
                                $title.=" updated it\'s <a href=\"blog.php?blogid=".$row2['blogid']."\">blog</a>";
                        echo "displayblog('".$userpic."','".$title."','".$row2['blog']."','".$row2['date']."');";
                        }
                        else if($row['title']=='voted on'){
                            $mutual=array_intersect(unserialize($row2['vote']), $_SESSION['friends']);
                            if(count($mutual)>1)
                                $title.=" and ".(count($mutual)-1). " other friends ";
                            $title.= " voted on <a href=\'profile.php?userid=".$minipro1['userid']."\' > ".$minipro1['username']."</a>\'s <a href=\'blog.php?blogid=".$row2['blogid']."\'>blog</a>";
                            echo "displayblog('".$userpic."','".$title."','".$row2['blog']."','".$row2['date']."');";
                        }
                    }
               }
         }
         else if($row['contenttype']=='admire'){
               $result2=mysql_query("select testyid,suserid,ruserid,message,vote,date,pt,specificlist,hiddenlist from testimonial where testyid='".$row['contentid']."'");
               while($row2=  mysql_fetch_assoc($result2))
               {
                    $privacy=$row2['pt'];
                    $specific=  unserialize($row2['specificlist']);
                    $hiddenlist=  unserialize($row2['hiddenlist']);
                    $minipro1=getminipro($row2['ruserid']);
                    $rusrfrnds=$minipro1['friends'];
                    if((($privacy=='public'||($privacy=='friends' && in_array($row2['ruserid'],$_SESSION['friends']))||($privacy=='fof' && count(array_intersect($rusrfrnds, $_SESSION['friends'])>=1) )||($privacy=='specific' && in_array($_SESSION['userid'], $specific)))&& !in_array($row2['ruserid'], $_SESSION['blocklist']) && !in_array($row2['ruserid'], $_SESSION['blockedby']) && !in_array($_SESSION['userid'], $hiddenlist))|| $_SESSION['userid']==$row2['ruserid']){
                        $userpic=$minipro['propic'];
                        $title="<a href=\"profile.php?userid=".$minipro['userid']."\">".$minipro['username']."</a>";
                        if($row['title']=='write an admire on'){
                            $title.=" write an <a href=\"admire.php?admireid=".$row2['testyid']."\">admire</a> on <a href=\"profile.php?userid=".$minipro1['userid']."\">".$minipro1['username']."</a>\'s chart";
                        echo "displayblog('".$userpic."','".$title."','".$row2['message']."','".$row2['date']."');";
                        }
                        
                        else if($row['title']=='voted on'){
                            $mutual=array_intersect(unserialize($row2['vote']), $_SESSION['friends']);
                            if(count($mutual)>1)
                                $title.=" and ".(count($mutual)-1). " other friends ";
                            $title.= " voted on <a href=\'profile.php?userid=".$minipro1['userid']."\' > ".$minipro1['username']."</a>\'s <a href=\'admire.php?admireid=".$row2['testyid']."\'>admire</a>";
                            echo "displayblog('".$userpic."','".$title."','".$row2['message']."','".$row2['date']."');";
                        }
                    }
               }
         }
         else if($row['contenttype']=='image'){
             $result2=mysql_query("select imageid,url,pinnedpeople,vote userid,albumid,title,description,date,pt,specificlist,hiddenlist from image where imageid='".$row['contentid']."'");
             while($row2=  mysql_fetch_assoc($result2))
             {
                 $result3=mysql_query("select albumid,name,userid from album where albumid='".$row2['albumid']."'");
                 while($row3=  mysql_fetch_assoc($result3)){
                    $privacy=$row2['pt'];
                    $specific=  unserialize($row2['specificlist']);
                    $hiddenlist=  unserialize($row2['hiddenlist']);
                    $minipro1=getminipro($row3['userid']);
                    $rusrfrnds=$minipro1['friends'];
                    if((($privacy=='public'||($privacy=='friends' && in_array($row3['userid'],$_SESSION['friends']))||($privacy=='fof' && count(array_intersect($rusrfrnds, $_SESSION['friends'])>=1) )||($privacy=='specific' && in_array($_SESSION['userid'], $specific)))&& !in_array($row3['userid'], $_SESSION['blocklist']) && !in_array($row3['userid'], $_SESSION['blockedby']) && !in_array($_SESSION['userid'], $hiddenlist))|| $_SESSION['userid']==$row3['userid']){
                        $userpic=$minipro['propic'];
                        $title="<a href=\"profile.php?userid=".$minipro['userid']."\">".$minipro['username']."</a>";
                        if($row['title']=='post image'){
                            if($row2['userid']==$row3['userid']){
                                $title.=" added a <a href=\"image.php?imageid=".$row2['imageid']."\">image</a>";
                            }
                            else
                            $title.=" added a <a href=\"image.php?imageid=".$row2['imageid']."\">image</a> on <a href=\"profile.php?userid=".$minipro1['userid']."\">".$minipro1['username']."</a>\'s chart";
                        echo "displayblog('".$userpic."','".$title."');";
                        }
                        else if($row['title']=='commented on'){
                            $result4=mysql_query("select userid from image_comments where imageid='".$row2['imageid']."'");
                            $commentedusers=array();
                            while($row4=  mysql_fetch_assoc($result3))
                            {
                                array_push($commentedusers, $row4['userid']);
                            }
                            $mutual=array_intersect($commentedusers, $_SESSION['friends']);
                            if(count($mutual)>1)
                                $title.=" and ".(count($mutual)-1). " other friends ";
                            $title.= " Commented on <a href=\'profile.php?userid=".$minipro1['userid']."\' > ".$minipro1['username']."</a>\'s <a href=\'image.php?imageid=".$row2['imageid']."\'>photo</a>";
                            
                        }
                        else if($row['title']=='voted on'){
                            $mutual=array_intersect(unserialize($row2['vote']), $_SESSION['friends']);
                            if(count($mutual)>1)
                                $title.=" and ".(count($mutual)-1). " other friends ";
                            $title.= " voted on <a href=\'profile.php?userid=".$minipro1['userid']."\' > ".$minipro1['username']."</a>\'s <a href=\'image.php?imageid=".$row2['imageid']."\'>photo</a>";
                            echo "displayblog('".$userpic."','".$title."');";
                        }
                        else if($row['title']=='pinned in'){
                            $mutual=array_intersect(unserialize($row2['pinnedpeople']), $_SESSION['friends']);
                            if(count($mutual)>1)
                                $title.=" and ".(count ($mutual)-1)." other friends are ";
                            $title.=" pinned in <a href=\'profile.php?userid=".$minipro1['userid']."\' > ".$minipro1['username']."</a>\'s <a href=\'image.php?imageid=".$row2['imageid']."\'>photo</a>";
                            echo "displayblog('".$userpic."','".$title."');";
                        }
                    }
                 }
             }
         }
         else if($row['contenttype']=='user'){
             $title="<a href=\"profile.php?userid=".$minipro['userid']."\">".$minipro['username']."</a>";
             if($row['title']==' now friends' && !in_array($row['ruserid'], $_SESSION['friends']) && !in_array($row['ruserid'], $userignore))
             {
                 array_push($userignore, $row['ruserid']);
                 $minipro2=getminipro($row['ruserid']);
                 $userpic=$minipro['propic'];
                 $mutual=array_intersect($minipro2['friends'],$_SESSION['friends']);
                 if(count($mutual)>1)
                    $title.=" and ".(count($mutual)-1). " other friends ";
                 $title.=" is now friends with <a href=\'profile.php?userid=".$minipro2['userid']."\'>".$minipro2['username']."</a>";        
                 echo "displayblog('".$userpic."','".$title."');";
             }
             
         }
       
     }*/
     ?>
    getstreams();
    </script>
    
    
    
</div>
</body>
</html>