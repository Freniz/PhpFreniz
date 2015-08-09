<?php
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once '../classes/Images.php';
require_once 'getminiprofile.php';
?>
<?xml version="1.0" encoding="utf-8" ?>
<streams>
<?php
    if(isset($_SESSION['userid']) && isset($_SESSION['type']) && $_SESSION['type']=='user'){
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");    
        $query="select distinct t.userid,t.ruserid,t.contentid,t.title,t.contenttype,t.contenturl,t.date  from activity t  join(select distinct userid,ruserid,contentid,title,contenttype,contenturl,max(date) date from activity where ruserid !='".$_SESSION['userid']."' ";
        
        $query=queryappend($query);
        $query.=" group by contenturl) r on t.date=r.date and t.contenttype=r.contenttype where t.ruserid !='".$_SESSION['userid']."' ";
        $query=queryappend($query,"t");
        $query.=" order by date desc";
        $result=  mysql_query($query);
        $userignore=array();
        while($row=  mysql_fetch_assoc($result))
        {
           $minipro=getminipro($row['userid']);
            if($row['contenttype']=='post'){
               $result2=mysql_query("select statusid,suserid,ruserid,status,commentcount,comments,vote,date,pt,specificlist,hiddenlist from status where statusid='".$row['contentid']."'");
               while($row2=  mysql_fetch_assoc($result2))
               {
                   $comments=unserialize($row2['comments']);
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
                                $title.=" updated it's <a href=\"post.php?postid=".$row2['statusid']."\">stature</a>";
                        }
                        else
                            $title.=" posted on <a href=\"profile.php?userid=".$minipro1['userid']."\">".$minipro1['username']."</a>'s chart";
                       }
                        else if($row['title']=='commented on'){
                            $commentedusers=array();
                            foreach($comments as $comment)
                            {
                                array_push($commentedusers, $comment['userid']);
                            }
                            $mutual=array_intersect($commentedusers, $_SESSION['friends']);
                            if(count($mutual)>1)
                                $title.=" and ".(count($mutual)-1). " other friends ";
                            $title.= " Commented on <a href='profile.php?userid=".$minipro1['userid']."' > ".$minipro1['username']."</a>'s <a href='post.php?postid=".$row2['statusid']."'>post</a>";
                           
                        }
                        else if($row['title']=='voted on'){
                            $mutual=array_intersect(unserialize($row2['vote']), $_SESSION['friends']);
                            if(count($mutual)>1)
                                $title.=" and ".(count($mutual)-1). " other friends ";
                            $title.= " voted on <a href='profile.php?userid=".$minipro1['userid']."' > ".$minipro1['username']."</a>'s <a href='post.php?postid=".$row2['statusid']."'>post</a>";
                            
                        }
                                            ?>
    <stream>
        <type>post</type>
        <title><?php echo htmlSpecialChars($title); ?></title>
        <contentid><?php echo $row2['statusid']; ?></contentid>
        <suserid><?php echo $row['userid']; ?></suserid>
        <susername><?php echo $minipro['username'];  ?></susername>
        <suserpic><?php echo $minipro['propic']; ?></suserpic>
        <ruserid><?php echo $minipro1['userid']; ?></ruserid>
        <rusername><?php echo $minipro1['username']; ?></rusername>
        <sex><?php echo $minipro['sex']; ?></sex>
        <status><?php echo $row2['status']; ?></status>
        <comments>
            <?php foreach($comments as $id=>$comment){$minipro2=  getminipro($comment['userid']); ?>
            <comment>
                <comment-id><?php echo $id; ?></comment-id>
                <comment-userid><?php echo $minipro2['userid']; ?></comment-userid>
                <comment-username><?php echo $minipro2['username'];?></comment-username>
                <comment-userpic><?php echo $minipro2['propic'];?></comment-userpic>
                <comment-message><?php echo $comment['comment'];?></comment-message>
                <comment-date><?php echo $comment['date'];?></comment-date>
            </comment>
            <?php } ?>
        </comments>
        <vote><?php echo $row2['vote']; ?></vote>
        <vote-contains><?php $votes=  unserialize($row2['vote']);if(!in_array($_SESSION['userid'], $votes)) echo 'no'; else echo 'yes'; ?></vote-contains>
        <date><?php echo $row2['date']; ?></date>
    </stream>
    
                        
                        <?php
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
                                $title.=" updated it's <a href=\"blog.php?blogid=".$row2['blogid']."\">blog</a>";
                        
                        }
                        else if($row['title']=='voted on'){
                            $mutual=array_intersect(unserialize($row2['vote']), $_SESSION['friends']);
                            if(count($mutual)>1)
                                $title.=" and ".(count($mutual)-1). " other friends ";
                            $title.= " voted on <a href='profile.php?userid=".$minipro1['userid']."' > ".$minipro1['username']."</a>'s <a href='blog.php?blogid=".$row2['blogid']."'>blog</a>";
                            
                        }
                        
                          ?>
    <stream>
        <type>blog</type>
        <title><?php echo htmlSpecialChars($title); ?></title>
        <contentid><?php echo $row2['blogid']; ?></contentid>
        <suserid><?php echo $row['userid']; ?></suserid>
        <susername><?php echo $minipro['username'];  ?></susername>
        <suserpic><?php echo $minipro['propic']; ?></suserpic>
        <blog><?php echo $row2['blog']; ?></blog>
        <vote><?php echo $row2['vote']; ?></vote>
        <vote-contains><?php $votes=  unserialize($row2['vote']);if(!in_array($_SESSION['userid'], $votes)) echo 'no'; else echo 'yes'; ?></vote-contains>
        <date><?php echo $row2['date']; ?></date>
    </stream>
    
                        
                        <?php
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
                            $title.=" write an <a href=\"admire.php?admireid=".$row2['testyid']."\">admire</a> on <a href=\"profile.php?userid=".$minipro1['userid']."\">".$minipro1['username']."</a>'s chart";
                        
                        }
                        
                        else if($row['title']=='voted on'){
                            $mutual=array_intersect(unserialize($row2['vote']), $_SESSION['friends']);
                            if(count($mutual)>1)
                                $title.=" and ".(count($mutual)-1). " other friends ";
                            $title.= " voted on <a href='profile.php?userid=".$minipro1['userid']."' > ".$minipro1['username']."</a>'s <a href='admire.php?admireid=".$row2['testyid']."'>admire</a>";
                            
                        }
                        ?>
    <stream>
        <type>admire</type>
        <title><?php echo htmlSpecialChars($title); ?></title>
        <contentid><?php echo $row2['testyid']; ?></contentid>
        <suserid><?php echo $row['userid']; ?></suserid>
        <susername><?php echo $minipro['username'];  ?></susername>
        <suserpic><?php echo $minipro['propic']; ?></suserpic>
        <ruserid><?php echo $minipro1['userid']; ?></ruserid>
        <rusername><?php echo $minipro1['username']; ?></rusername>
        <sex><?php echo $minipro['sex']; ?></sex>
        <message><?php echo $row2['message']; ?></message>
        <vote><?php echo $row2['vote']; ?></vote>
        <vote-contains><?php $votes=  unserialize($row2['vote']);if(!in_array($_SESSION['userid'], $votes)) echo 'no'; else echo 'yes'; ?></vote-contains>
        <date><?php echo $row2['date']; ?></date>
    </stream>
    
                        
                        <?php
                    }
               }
         }
         else if($row['contenttype']=='image'){
             $result2=mysql_query("select imageid,url,pinnedpeople,vote,userid,albumid,title,description,date,pt,specificlist,hiddenlist,comments from image where imageid='".$row['contentid']."'");
             while($row2=  mysql_fetch_assoc($result2))
             {
                 $comments=unserialize($row2['comments']);
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
                            $title.=" added a <a href=\"image.php?imageid=".$row2['imageid']."\">image</a> on <a href=\"profile.php?userid=".$minipro1['userid']."\">".$minipro1['username']."</a>'s chart";
                        
                        }
                        else if($row['title']=='commented on'){
                            $commentedusers=array();
                            foreach($comments as $comment)
                            {
                                array_push($commentedusers, $comment['userid']);
                            }
                            $mutual=array_intersect($commentedusers, $_SESSION['friends']);
                            if(count($mutual)>1)
                                $title.=" and ".(count($mutual)-1). " other friends ";
                            $title.= " Commented on <a href='profile.php?userid=".$minipro1['userid']."' > ".$minipro1['username']."</a>'s <a href='image.php?imageid=".$row2['imageid']."'>photo</a>";
                            
                        }
                        else if($row['title']=='voted on'){
                            $mutual=array_intersect(unserialize($row2['vote']), $_SESSION['friends']);
                            if(count($mutual)>1)
                                $title.=" and ".(count($mutual)-1). " other friends ";
                            $title.= " voted on <a href='profile.php?userid=".$minipro1['userid']."' > ".$minipro1['username']."</a>'s <a href='image.php?imageid=".$row2['imageid']."'>photo</a>";
                            
                        }
                        else if($row['title']=='pinned'){
                            $mutual=array_intersect(unserialize($row2['pinnedpeople']), $_SESSION['friends']);
                            if(count($mutual)>1)
                                $title.=" and ".(count ($mutual)-1)." other friends are ";
                            $title.=" pinned in <a href='profile.php?userid=".$minipro1['userid']."' > ".$minipro1['username']."</a>'s <a href='image.php?imageid=".$row2['imageid']."'>photo</a>";
                            
                        }
                           ?>
    <stream>
        <type>image</type>
        <title><?php echo htmlSpecialChars($title); ?></title>
        <contentid><?php echo $row2['imageid']; ?></contentid>
        <albumid><?php echo $row2['albumid']; ?></albumid>
        <albumname><?php echo $row3['name']; ?></albumname>
        <suserid><?php echo $row['userid']; ?></suserid>
        <susername><?php echo $minipro['username'];  ?></susername>
        <suserpic><?php echo $minipro['propic']; ?></suserpic>
        <ruserid><?php echo $minipro1['userid']; ?></ruserid>
        <rusername><?php echo $minipro1['username']; ?></rusername>
        <sex><?php echo $minipro['sex']; ?></sex>
        <imageurl><?php echo $row2['url']; ?></imageurl>
        <imagetitle><?php echo $row2['title']; ?></imagetitle>
        <imagedes><?php echo $row2['description']; ?></imagedes>
        <comments>
            <?php foreach($comments as $id=>$comment){$minipro2=  getminipro($comment['userid']); ?>
            <comment>
                <comment-id><?php echo $id; ?></comment-id>
                <comment-userid><?php echo $minipro2['userid']; ?></comment-userid>
                <comment-username><?php echo $minipro2['username'];?></comment-username>
                <comment-userpic><?php echo $minipro2['propic'];?></comment-userpic>
                <comment-message><?php echo $comment['comment'];?></comment-message>
                <comment-date><?php echo $comment['date'];?></comment-date>
            </comment>
            <?php } ?>
        </comments>
        <vote><?php echo $row2['vote']; ?></vote>
        <vote-contains><?php $votes=  unserialize($row2['vote']);if(!in_array($_SESSION['userid'], $votes)) echo 'no'; else echo 'yes'; ?></vote-contains>
        <date><?php echo $row2['date']; ?></date>
    </stream>
    
                        
                        <?php
                    }
                 }
             }
         }
         else if($row['contenttype']=='video'){
               $result2=mysql_query("select videoid,suserid,ruserid,title,embeddcode,commentcount,vote,date,pt,specificlist,hiddenlist from video where videoid='".$row['contentid']."'");
               while($row2=  mysql_fetch_assoc($result2))
               {
                   //$comments=unserialize($row2['comments']);
                    $privacy=$row2['pt'];
                    $specific=  unserialize($row2['specificlist']);
                    $hiddenlist=  unserialize($row2['hiddenlist']);
                    $minipro1=getminipro($row2['ruserid']);
                    $rusrfrnds=$minipro1['friends'];
                    if((($privacy=='public'||($privacy=='friends' && in_array($row2['ruserid'],$_SESSION['friends']))||($privacy=='fof' && count(array_intersect($rusrfrnds, $_SESSION['friends'])>=1) )||($privacy=='specific' && in_array($_SESSION['userid'], $specific)))&& !in_array($row2['ruserid'], $_SESSION['blocklist']) && !in_array($row2['ruserid'], $_SESSION['blockedby']) && !in_array($_SESSION['userid'], $hiddenlist))|| $_SESSION['userid']==$row2['ruserid']){
                        $userpic=$minipro['propic'];
                        $title="<a href=\"profile.php?userid=".$minipro['userid']."\">".$minipro['username']."</a>";
                        if($row['title']=='post a video on'){
                        if($row2['suserid']==$row2['ruserid'])
                        {
                            if($minipro['sex']=='female')
                            $title.=" posted a <a href=\"video.php?videoid=".$row2['videoid']."\">video</a>";
                            else if($minipro['sex']=='male')
                                $title.=" posted a  <a href=\"video.php?videoid=".$row2['videoid']."\">video</a>";
                            else
                                $title.=" posted a  <a href=\"post.php?postid=".$row2['videoid']."\">video</a>";
                        }
                        else
                            $title.=" posted a video on <a href=\"profile.php?userid=".$minipro1['userid']."\">".$minipro1['username']."</a>'s chart";
                       }
                        else if($row['title']=='commented on'){
                            $commentedusers=array();
                            foreach($comments as $comment)
                            {
                                array_push($commentedusers, $comment['userid']);
                            }
                            $mutual=array_intersect($commentedusers, $_SESSION['friends']);
                            if(count($mutual)>1)
                                $title.=" and ".(count($mutual)-1). " other friends ";
                            $title.= " Commented on <a href='profile.php?userid=".$minipro1['userid']."' > ".$minipro1['username']."</a>'s <a href='video.php?videoid=".$row2['videoid']."'>video</a>";
                           
                        }
                        else if($row['title']=='voted on'){
                            $mutual=array_intersect(unserialize($row2['vote']), $_SESSION['friends']);
                            if(count($mutual)>1)
                                $title.=" and ".(count($mutual)-1). " other friends ";
                            $title.= " voted on <a href='profile.php?userid=".$minipro1['userid']."' > ".$minipro1['username']."</a>'s <a href='video.php?videoid=".$row2['videoid']."'>video</a>";
                            
                        }
                                            ?>
    <stream>
        <type>video</type>
        <title><?php echo htmlSpecialChars($title); ?></title>
        <contentid><?php echo $row2['videoid']; ?></contentid>
        <suserid><?php echo $row['userid']; ?></suserid>
        <susername><?php echo $minipro['username'];  ?></susername>
        <suserpic><?php echo $minipro['propic']; ?></suserpic>
        <ruserid><?php echo $minipro1['userid']; ?></ruserid>
        <rusername><?php echo $minipro1['username']; ?></rusername>
        <sex><?php echo $minipro['sex']; ?></sex>
        <videotitle><?php echo $row2['title']; ?></videotitle>
        <url><?php echo $row2['embeddcode']; ?></url>
        <vote><?php echo $row2['vote']; ?></vote>
        <vote-contains><?php $votes=  unserialize($row2['vote']);if(!in_array($_SESSION['userid'], $votes)) echo 'no'; else echo 'yes'; ?></vote-contains>
        <date><?php echo $row2['date']; ?></date>
    </stream>
    
                        
                        <?php
                    }
                    
               }
         }
         else if($row['contenttype']=='user'){
             $title="<a href=\"profile.php?userid=".$minipro['userid']."\">".$minipro['username']."</a>";
             if($row['title']==' now friends' && !in_array($row['ruserid'], $_SESSION['friends']) && !in_array($row['ruserid'], $userignore) && !in_array($minipro['userid'], $userignore))
             {
                 array_push($userignore, $row['userid']);
                 array_push($userignore, $row['ruserid']);
                 $recendaddedusers=array();
                 if($row['contentid']>=0)
                 {
                   $recendaddedusers=array_slice($minipro['friends'], -($row['contentid']+1));
                   
                 }
                 else{
                 $minipro2=getminipro($row['ruserid']);
                 $userpic=$minipro['propic'];
                 $mutual=array_intersect($minipro2['friends'],$_SESSION['friends']);
                 if(count($mutual)>1)
                    $title.=" and ".(count($mutual)-1). " other friends ";
                 $recendaddedusers=array($row['ruserid']);
                 
                 }
                 $title.=" is now friends with ";        
                  ?>
    <stream>
        <type>friends</type>
        <title><?php echo htmlSpecialChars($title); ?></title>
        <suserid><?php echo $minipro['userid']; ?></suserid>
        <susername><?php echo $minipro['username'];  ?></susername>
        <suserpic><?php echo $minipro['propic']; ?></suserpic>
        <rusers>
            <?php foreach($recendaddedusers as $user){ $minipro2=  getminipro($user); ?>
            <ruser>
        <ruserid><?php echo $minipro2['userid']; ?></ruserid>
        <rusername><?php echo $minipro2['username']; ?></rusername>
        <userpic><?php echo $minipro2['propic']; ?></userpic>
            </ruser>
        <?php } ?>
        </rusers>
        <sex><?php echo $minipro['sex']; ?></sex>
        
    </stream>
    
                        
                        <?php
             }
             
         }
         else if ($row['contenttype']=='propic'){
             $title="<a href=\"profile.php?userid=".$minipro['userid']."\">".$minipro['username']."</a>";
             if(!in_array($minipro['userid'], $_SESSION['blocklist']) && !in_array($minipro['userid'], $_SESSION['blockedby'])){
                 $query4="select userid from activity where userid!='".$minipro['userid']."' and (";
                     $i=0;
                     $recendmodifiedusers=array($minipro['userid']);
                     foreach($_SESSION['friends'] as $user){
                         $i++;
                         if($i!=count($_SESSION['friends']))
                             $query4.=" userid='$user' or ";
                         else
                             $query4.=" userid='$user'";
                             
                     }
                     $query4.=") and contenttype='propic' and contenturl='propic.php' and date>date_sub(now(),interval 5 day)";
                     if(count($_SESSION['friends'])>1)
                     {
                         $result4=mysql_query($query4);
                         while($row4=  mysql_fetch_assoc($result4))
                         {
                             array_push($recendmodifiedusers, $row4['userid']);
                         }
                         $recendmodifiedusers=array_unique($recendmodifiedusers);
                         if(count($recendmodifiedusers)>1)
                         $title.=" and ".(count($recendmodifiedusers)-1)." friends recendly updated their profile picture";
                         else{
                             $title.= " updated ";
                             switch($minipro['sex']){
                             case 'male':
                                 $title.="his ";
                                 break;
                             case 'female':
                                 $title.="her ";
                                 break;
                             default :
                                 $title.= "its ";
                                 break;
                             }
                             $title.= "profile picture";
                         }
                     }
                     ?>
        <stream>
            <type>propic</type>
            <suserid><?php echo $minipro['userid']; ?></suserid>
            <susername><?php echo $minipro['username']; ?></susername>
            <suserpic><?php echo $minipro['propic']; ?></suserpic>
            <title><?php echo htmlSpecialChars($title); ?></title>
            <users>
                <?php foreach ($recendmodifiedusers as $user){
                    $minipro1=getminipro($user);?>
                <user>
                    <userid><?php echo $minipro1['userid']; ?></userid>
                    <username><?php echo $minipro1['username']; ?></username>
                    <userpic><?php echo $minipro1['propic']; ?></userpic>
                </user>
                <?php 
                } ?>
            </users>
        </stream>
    <?php
                 
             }
         }
        else if ($row['contenttype']=='basic info'){
             $title="<a href=\"profile.php?userid=".$minipro['userid']."\">".$minipro['username']."</a>";
             if(!in_array($minipro['userid'], $_SESSION['blocklist']) && !in_array($minipro['userid'], $_SESSION['blockedby'])){
                 $query4="select userid from activity where userid!='".$minipro['userid']."' and (";
                     $i=0;
                     $recendmodifiedusers=array($minipro['userid']);
                     foreach($_SESSION['friends'] as $user){
                         $i++;
                         if($i!=count($_SESSION['friends']))
                             $query4.=" userid='$user' or ";
                         else
                             $query4.=" userid='$user'";
                             
                     }
                     $query4.=") and contenttype='basic info' and contenturl='basicinfo.php' and date>date_sub(now(),interval 5 day)";
                     if(count($_SESSION['friends'])>1)
                     {
                         $result4=mysql_query($query4);
                         while($row4=  mysql_fetch_assoc($result4))
                         {
                             array_push($recendmodifiedusers, $row4['userid']);
                         }
                         $recendmodifiedusers=array_unique($recendmodifiedusers);
                         if(count($recendmodifiedusers)>1)
                         $title.=" and ".(count($recendmodifiedusers)-1)." friends recendly updated their basic info";
                         else{
                             $title.= " updated ";
                             switch($minipro['sex']){
                             case 'male':
                                 $title.="his ";
                                 break;
                             case 'female':
                                 $title.="her ";
                                 break;
                             default :
                                 $title.= "its ";
                                 break;
                             }
                             $title.= "basic info";
                         }
                     }
                     ?>
        <stream>
            <type>basic info</type>
            <suserid><?php echo $minipro['userid']; ?></suserid>
            <susername><?php echo $minipro['username']; ?></susername>
            <suserpic><?php echo $minipro['propic']; ?></suserpic>
            <title><?php echo htmlSpecialChars($title); ?></title>
            <users>
                <?php foreach ($recendmodifiedusers as $user){
                    $minipro1=getminipro($user);?>
                <user>
                    <userid><?php echo $minipro1['userid']; ?></userid>
                    <username><?php echo $minipro1['username']; ?></username>
                    <userpic><?php echo $minipro1['propic']; ?></userpic>
                </user>
                <?php 
                } ?>
            </users>
        </stream>
    <?php
                 
             }
         }
         else if ($row['contenttype']=='personal info'){
             $title="<a href=\"profile.php?userid=".$minipro['userid']."\">".$minipro['username']."</a>";
             if(!in_array($minipro['userid'], $_SESSION['blocklist']) && !in_array($minipro['userid'], $_SESSION['blockedby'])){
                 $query4="select userid from activity where userid!='".$minipro['userid']."' and (";
                     $i=0;
                     $recendmodifiedusers=array($minipro['userid']);
                     foreach($_SESSION['friends'] as $user){
                         $i++;
                         if($i!=count($_SESSION['friends']))
                             $query4.=" userid='$user' or ";
                         else
                             $query4.=" userid='$user'";
                             
                     }
                     $query4.=") and contenttype='personal info' and contenturl='personalinfo.php' and date>date_sub(now(),interval 5 day)";
                     if(count($_SESSION['friends'])>1)
                     {
                         $result4=mysql_query($query4);
                         while($row4=  mysql_fetch_assoc($result4))
                         {
                             array_push($recendmodifiedusers, $row4['userid']);
                         }
                         $recendmodifiedusers=array_unique($recendmodifiedusers);
                         if(count($recendmodifiedusers)>1)
                         $title.=" and ".(count($recendmodifiedusers)-1)." friends recendly updated their personal info";
                         else{
                             $title.= " updated ";
                             switch($minipro['sex']){
                             case 'male':
                                 $title.="his ";
                                 break;
                             case 'female':
                                 $title.="her ";
                                 break;
                             default :
                                 $title.= "its ";
                                 break;
                             }
                             $title.= "personal info";
                         }
                     }
                     ?>
        <stream>
            <type>personal info</type>
            <suserid><?php echo $minipro['userid']; ?></suserid>
            <susername><?php echo $minipro['username']; ?></susername>
            <suserpic><?php echo $minipro['propic']; ?></suserpic>
            <title><?php echo htmlSpecialChars($title); ?></title>
            <users>
                <?php foreach ($recendmodifiedusers as $user){
                    $minipro1=getminipro($user);?>
                <user>
                    <userid><?php echo $minipro1['userid']; ?></userid>
                    <username><?php echo $minipro1['username']; ?></username>
                    <userpic><?php echo $minipro1['propic']; ?></userpic>
                </user>
                <?php 
                } ?>
            </users>
        </stream>
    <?php
                 
             }
         }
         
         else if ($row['contenttype']=='mood'){
             $title="<a href=\"profile.php?userid=".$minipro['userid']."\">".$minipro['username']."</a>";
             if(!in_array($minipro['userid'], $_SESSION['blocklist']) && !in_array($minipro['userid'], $_SESSION['blockedby'])){
                 $query4="select userid from activity where userid!='".$minipro['userid']."' and (";
                     $i=0;
                     $recendmodifiedusers=array($minipro['userid']);
                     foreach($_SESSION['friends'] as $user){
                         $i++;
                         if($i!=count($_SESSION['friends']))
                             $query4.=" userid='$user' or ";
                         else
                             $query4.=" userid='$user'";
                             
                     }
                     $query4.=") and contenttype='mood' and contenturl='mood.php' and date>date_sub(now(),interval 5 day)";
                     if(count($_SESSION['friends'])>1)
                     {
                         $result4=mysql_query($query4);
                         while($row4=  mysql_fetch_assoc($result4))
                         {
                             array_push($recendmodifiedusers, $row4['userid']);
                         }
                         $recendmodifiedusers=array_unique($recendmodifiedusers);
                         if(count($recendmodifiedusers)>1)
                         $title.=" and ".(count($recendmodifiedusers)-1)." friends recendly updated their mood";
                         else
                         {    
                             $title.= " updated";
                             switch($minipro['sex']){
                             case 'male':
                                 $title.=" his ";
                                 break;
                             case 'female':
                                 $title.=" her ";
                                 break;
                             default :
                                 $title.= " its ";
                                 break;
                             }
                             $title.="mood";
                         }
                         
                     }
                     ?>
        <stream>
            <type>mood</type>
            <suserid><?php echo $minipro['userid']; ?></suserid>
            <susername><?php echo $minipro['username']; ?></susername>
            <suserpic><?php echo $minipro['propic']; ?></suserpic>
            <title><?php echo htmlSpecialChars($title); ?></title>
            <users>
                <?php foreach ($recendmodifiedusers as $user){
                    $minipro1=getminipro($user);?>
                <user>
                    <userid><?php echo $minipro1['userid']; ?></userid>
                    <username><?php echo $minipro1['username']; ?></username>
                    <userpic><?php echo $minipro1['propic']; ?></userpic>
                    <mood><?php echo $minipro1['mood']; ?></mood>
                </user>
                <?php 
                } ?>
            </users>
        </stream>
    <?php
                 
             }
         }
         else if ($row['contenttype']=='education info'){
             $title="<a href=\"profile.php?userid=".$minipro['userid']."\">".$minipro['username']."</a>";
             if(!in_array($minipro['userid'], $_SESSION['blocklist']) && !in_array($minipro['userid'], $_SESSION['blockedby'])){
                 $query4="select userid from activity where userid!='".$minipro['userid']."' and (";
                     $i=0;
                     $recendmodifiedusers=array($minipro['userid']);
                     foreach($_SESSION['friends'] as $user){
                         $i++;
                         if($i!=count($_SESSION['friends']))
                             $query4.=" userid='$user' or ";
                         else
                             $query4.=" userid='$user'";
                             
                     }
                     $query4.=") and contenttype='education info' and contenturl='educationinfo.php' and date>date_sub(now(),interval 5 day)";
                     if(count($_SESSION['friends'])>1)
                     {
                         $result4=mysql_query($query4);
                         while($row4=  mysql_fetch_assoc($result4))
                         {
                             array_push($recendmodifiedusers, $row4['userid']);
                         }
                         $recendmodifiedusers=array_unique($recendmodifiedusers);
                         if(count($recendmodifiedusers)>1)
                         $title.=" and ".(count($recendmodifiedusers)-1)." friends recendly updated their Edcation and Occupation info";
                         else{
                             $title.= " updated ";
                             switch($minipro['sex']){
                             case 'male':
                                 $title.="his ";
                                 break;
                             case 'female':
                                 $title.="her ";
                                 break;
                             default :
                                 $title.= "its ";
                                 break;
                             }
                             $title.= "Education and Occupationinfo";
                         }
                     }
                     ?>
        <stream>
            <type>education info</type>
            <suserid><?php echo $minipro['userid']; ?></suserid>
            <susername><?php echo $minipro['username']; ?></susername>
            <suserpic><?php echo $minipro['propic']; ?></suserpic>
            <title><?php echo htmlSpecialChars($title); ?></title>
            <users>
                <?php foreach ($recendmodifiedusers as $user){
                    $minipro1=getminipro($user);?>
                <user>
                    <userid><?php echo $minipro1['userid']; ?></userid>
                    <username><?php echo $minipro1['username']; ?></username>
                    <userpic><?php echo $minipro1['propic']; ?></userpic>
                </user>
                <?php 
                } ?>
            </users>
        </stream>
    <?php
                 
             }
         }
         
     }
    }
    
    
    
    
    function queryappend($query,$char=null){
        $l=count($_SESSION['friends']);
        $i=0;
        if($l>0)
            $query.=" and ( ";
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
    
    
    
?>
</streams>