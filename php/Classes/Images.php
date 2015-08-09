<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Images
{
function __construct()
 {
     mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
    mysql_select_db("fztest1") or die ("coudnt find database");    
    
}
function getimages($albumid)
{
    $images=array();
    $albumname;
    $result1=mysql_query("select name from album where albumid='".$albumid."'");
    while($row1=  mysql_fetch_assoc($result1)){
        $albumname=$row1['name'];
    }
    $result=mysql_query("select imageid,url,pinnedpeople,vote,userid,date,title,description,pt,specificlist,hiddenlist,notifyusers,reqpinusers,accepted,pinmereq from image where albumid='".$albumid."'");
    while($row=  mysql_fetch_assoc($result)){
        $image=array();
        $image['albumname']=$albumname;
        $image['albumid']=$albumid;
        foreach($row as $key => $value)
        {
            
                if($key!="pinnedpeople" && $key!="vote" && $key!="specificlist" && $key!="hiddenlist" && $key!="notifyusers" && $key!="reqpinusers" && $key!="pinmereq")
                {
                  $image[$key]=$value;  
                }
                else
                    $image[$key]=unserialize ($value);
        }
        $images[$row['imageid']]=$image;
    }
    return $images;
}

function getComments($imageid,$from,$limit)
{
    $comments=array();
    $result=mysql_query("select commentid,imageid,userid,comment,vote,date from image_comments where imageid='$imageid' order by commentid desc limit $from,$limit");
    while($row=  mysql_fetch_assoc($result)){
        $comments[$row['commentid']]=$row;
    }
    return $comments;
}

function getArrayOfImages($imageids)
{
    $images=array();
    $query="select imageid,url,pinnedpeople,vote,userid,date,title,description,pt,specificlist,hiddenlist,notifyusers,reqpinusers,accepted,pinmereq from image where ";
    $i=0;
    foreach($imageids as $id)
    {
        $i++;
        if($i!=count($imageids))
        $query.=" imageid='$id' or ";
        else
            $query.=" imageid='$id'";
    }
    $result=mysql_query($query);
    while($row=  mysql_fetch_assoc($result)){
        $image=array();
        foreach($row as $key => $value)
        {
            
                if($key!="pinnedpeople" && $key!="vote" && $key!="specificlist" && $key!="hiddenlist" && $key!="notifyusers" && $key!="reqpinusers" && $key!="pinmereq")
                {
                  $image[$key]=$value;  
                }
                else
                    $image[$key]=unserialize ($value);
        }
        $images[$row['imageid']]=$image;
    }
    return $images;
}


function editImageData($imagearray)
{
    foreach($imagearray as $id => $image)
    {
        $title;$description;
        if($image['title']=="" || !isset($image['title']))
            $title='Title';
        else
            $title=$image['title'];
        if($image['description']=="" || !isset($image['description']))
            $description='Description';
        else
            $description=$image['description'];
        mysql_query("update image set title='".mysql_real_escape_string($title)."',description='".mysql_real_escape_string($description)."' where imageid='$id'");
    }
}

function approvepinreview($imageids){
    $query="select imageid,reqpinusers,pinnedpeople,albumid,userid from image where ";
    $i=0;
    foreach($imageids as $id)
    {
        $i++;
        if($i!=  count($imageids))
        $query.=" imageid='$id' or ";
        else
            $query.=" imageid='$id'";
                
    }
    $result=mysql_query($query);
    while($row=  mysql_fetch_assoc($result)){
        $reqpinusers=array_diff(unserialize($row['reqpinusers']), array($_SESSION['userid']));
        $pinnedpeople=unserialize($row['pinnedpeople']);
        array_push($pinnedpeople, $_SESSION['userid']);
        $query1="select userid from album where albumid='".$row['albumid']."'";
        $result1=mysql_query($query1);
        while ($row1=  mysql_fetch_array($result1)){
            mysql_query("update image set reqpinusers='".serialize($reqpinusers)."',pinnedpeople='".  serialize($pinnedpeople)."' where imageid='".$row['imageid']."'");
            mysql_query("insert into activity (userid,ruserid,contentid,title,contenttype,contenturl,date) values ('".$_SESSION['userid']."','".$row1['userid']."','".$row['imageid']."','pinned','image','image.php?imageid=".$row['imageid']."',now())");
            }
        
    }
}
function approveimages($imageids)
{
    $query="select imageid,userid,albumid from image where ";
    $i=0;
    foreach ($imageids as $id){
        $i++;
        if($i!=count($imageids))
            $query.=" image id='$id' or";
        else
            $query.="imageid='$id'";
    }
    $result=mysql_query($query);
    while($row=  mysql_fetch_assoc($result)){
        mysql_query ("update image set accepted='yes' where imageid='".$row['imageid']."'");
        $result1=mysql_query("select userid from album where albumid='".$row['albumid']."'");
        while($row1= mysql_fetch_assoc($result1)){
            mysql_query("insert into activity (userid,ruserid,contentid,title,contenttype,contenturl,date) values ('".$row['userid']."','".$row1['userid']."','".$row['imageid']."','post image','image','image.php?imageid=".$row['imageid']."',now())");
        }
    }
        
}

function denypinreview($imageids){
    $query="select imageid,reqpinusers from image where ";
    $i=0;
    foreach($imageids as $id)
    {
        $i++;
        if($i!=  count($imageids))
        $query.=" imageid='$id' or ";
        else
            $query.=" imageid='$id'";
                
    }
    $result=mysql_query($query);
    while($row=  mysql_fetch_assoc($result)){
        $reqpinusers=array_diff(unserialize($row['reqpinusers']), array($_SESSION['userid']));
        mysql_query("update image set reqpinusers='".serialize($reqpinusers)."' where imageid='".$row['imageid']."'");        
    }
}
function denyimages($imageids)
{
    $query="select imageid,url from image where ";
    $i=0;
    foreach($imageids as $id)
    {
        $i++;
        if($i!=  count($imageids))
        $query.=" imageid='$id' or ";
        else
            $query.=" imageid='$id'";
                
    }
    $result=mysql_query($query);
    while($row=  mysql_fetch_assoc($result)){
        unlink('../images/'.$row['url']);
        unlink('../images/original/'.$row['url']);
        unlink('../images/32/32_'.$row['url']);
        unlink('../images/50/50_'.$row['url']);
        unlink('../images/75/75_'.$row['url']);
        unlink('../images/200/200_'.$row['url']);
        unlink('../images/500/500_'.$row['url']);
        mysql_query("delete from image where imageid='".$row['imageid']."'");        
    }
}


function pinmereq($imgid){
    $result=mysql_query("select userid,albumid,pinmereq,pinnedpeople from image where imageid='$imgid'");
    $output=  json_encode(array('stauts'=>'You dont have permission for this operation'));
    while($row=  mysql_fetch_assoc($result)){
        $suserid=$row['userid'];
        $pinmereq=unserialize($row['pinmereq']);
        $pinnedpeople=unserialize($row['pinnedpeople']);
        $result2=mysql_query("select userid from album where albumid='".$row['albumid']."'");
        while($row2=  mysql_fetch_assoc($result2)){
            $ruserid=$row2['userid'];
            if(in_array($ruserid, $_SESSION['friends']) && $suserid!=$_SESSION['userid']){
                $result3=mysql_query("select userid,reviews from user_info where userid='".$_SESSION['userid']."' or userid='".$ruserid."'");
                while($row3=  mysql_fetch_assoc($result3)){
                    $reviews=unserialize($row3['reviews']);
                    if($row3['userid']==$_SESSION['userid']){
                        if(isset($reviews['pinmereq'])){
                            array_push ($reviews['pinmereq'], $imgid);
                            $reviews['pinmereq']=array_unique($reviews['pinmereq']);
                        }
                        else
                            $reviews['pinmereq']=array($imgid);
                    }
                    else if($row3['userid']==$ruserid)
                    {
                        if(!isset($reviews['otherpinreq']))
                            $reviews['otherpinreq']=array();
                        if(isset($reviews['otherpinreq'][$imgid])){
                            array_push($reviews['otherpinreq'][$imgid],$_SESSION['userid']);
                            $reviews['otherpinreq'][$imgid]=array_unique($reviews['otherpinreq'][$imgid]);
                        }
                        else
                            $reviews['otherpinreq'][$imgid]=array($_SESSION['userid']);
                    }
                    mysql_query("update user_info set reviews='".serialize($reviews)."' where userid='".$row3['userid']."'");
                }
                array_push($pinmereq, $_SESSION['userid']);
                $pinmereq=array_unique($pinmereq);
                mysql_query("update image set pinmereq='".serialize($pinmereq)."' where imageid='$imgid'");
                $output=json_encode(array("status"=>"success"));
            }
            else if($suserid==$_SESSION['userid']){
                $result3=mysql_query("select pinnedpic from user_info where userid='$suserid'");
                while($row3=  mysql_fetch_assoc($result3)){
                    $pinnedpics=unserialize($row3['pinnedpic']);
                    array_push($pinnedpics, $imgid);
                    mysql_query("update user_info set pinnedpic='".serialize(array_unique($pinnedpics))."' where userid='$suserid'");
                    array_push($pinnedpeople, $suserid);
               }
                mysql_query("update image set pinnedpeople='".serialize(array_unique($pinnedpeople))."' where imageid='$imgid'");
                $output=json_encode(array('status'=>"success"));
            }
            else
                $output=json_encode(array('stauts'=>'You dont have permission for this operation'));
        }
    }
    return $output;
}

function approveOtherPinReq($userids,$imageid){
    $result1=mysql_query("select pinnedpeople,pinmereq from image where imageid='$imageid'");
    while($row1=  mysql_fetch_assoc($result1)){
        $pinnedpeople=unserialize($row1['pinnedpeople']);
        $pinmereq=unserialize($row1['pinmereq']);
        $pinnedpeople=array_unique(array_merge($pinnedpeople,$userids));
        $pinmereq=array_diff($pinmereq, $pinnedpeople);
        mysql_query("update image set pinnedpeople='".serialize($pinnedpeople)."',pinmereq='".serialize($pinmereq)."' where imageid='$imageid'");
        foreach($userids as $userid)
        mysql_query("insert into activity (userid,ruserid,contentid,title,contenttype,contenturl,date) values ('".$userid."','".$_SESSION['userid']."','".$imageid."','pinned','image','image.php?imageid=".$imageid."',now())");
    }
    $query="select userid,reviews,pinnedpic from user_info where ";
    $i=0;
    foreach($userids as $user)
    {
        $i++;
        if($i!=count($userids))
            $query.=" userid='$user' or ";
        else
            $query.=" userid='$user'";
            
    }
    $result=mysql_query($query);
    while($row=  mysql_fetch_assoc($result)){
        $reviews=unserialize($row['reviews']);
        $pinnedpic=unserialize($row['pinnedpic']);
        array_push($pinnedpic, $imageid);
        $pinnedpic=array_unique($pinnedpic);
        if(isset($reviews['pinmereq']))
        $reviews['pinmereq']=array_diff($reviews['pinmereq'], array($imageid));
        mysql_query("update user_info set reviews='".serialize($reviews)."',pinnedpic='".serialize($pinnedpic)."' where userid='".$row['userid']."'");
        
    }
}
function denyOtherPinReq($userids,$imageid){
    $result1=mysql_query("select pinmereq from image where imageid='$imageid'");
    while($row1=  mysql_fetch_assoc($result1)){
        $pinmereq=unserialize($row1['pinmereq']);
        $pinmereq=array_diff($pinmereq, $userids);
        mysql_query("update image set pinmereq='".serialize($pinmereq)."' where imageid='$imageid'");
    }
    $query="select userid,reviews from user_info where ";
    $i=0;
    foreach($userids as $user)
    {
        $i++;
        if($i!=count($userids))
            $query.=" userid='$user' or ";
        else
            $query.=" userid='$user'";
            
    }
    $result=mysql_query($query);
    while($row=  mysql_fetch_assoc($result)){
        $reviews=unserialize($row['reviews']);
        if(isset($reviews['pinmereq']))
        $reviews['pinmereq']=array_diff($reviews['pinmereq'], array($imageid));
        mysql_query("update user_info set reviews='".serialize($reviews)."' where userid='".$row['userid']."'");
        
    }
}


function cropImage( $source,  $dest,$resolutions,$x=null,$y=null,$nw=null, $nh=null) {
        $size = getimagesize($source);
	$w = $size[0];
	$h = $size[1];
        if(isset($x) && isset($y) && isset($nw) && isset ($nh) && $nw!=0 && $nh!=0){
        $base_h;$base_w;
        if($w>=500 || $h>=500){
        if($w>$h)
        {
            $base_w=500;
            $base_h=($h*$base_w)/$w;
        }
        else
        {
            $base_h=500;
            $base_w=($w*$base_h)/$h;
        }
        }
 else {
    $base_h=$h;
    $base_w=$w;
}

        $x=($x/$base_w)*$w;
        $y=($y/$base_h)*$h;
        $nw=($nw/$base_w)*$w;
        $nh=($nh/$base_h)*$h;
        }
 else {
    $x=0;$y=0;$nw=$w;$nh=$h;
}
echo "$x<br>$y<br>$nw<br>$nh<br>";
print_r($resolutions);
        switch($size['mime']) {
		case 'image/gif':
		$simg = imagecreatefromgif($source);
                    $create='imagepng';
		break;
		case 'image/png':
                case 'image/x-png':
		$simg = imagecreatefrompng($source);
                    $create='imagepng';
		break;
                default :
		$simg = imagecreatefromjpeg($source);
                    $create='imagejpeg';
		break;
		
	}
	$dimg = imagecreatetruecolor($nw, $nh);
	imagecopyresampled($dimg,$simg,0,0,$x,$y,$nw,$nh,$nw,$nh);
	$create($dimg,$dest,100);
        imagedestroy($simg);
        imagedestroy($dimg);
        $c=new compressimage($dest,$resolutions);
}
}

?>
