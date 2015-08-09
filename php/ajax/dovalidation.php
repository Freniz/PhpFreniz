<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function validate($userid,$password){
    mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $results=mysql_query("select userid,pass from userstable where userid='".$userid."' or email='".$userid."'"); 
        if(mysql_num_rows($results)){
             while($row=mysql_fetch_assoc($results))
             {
                 if($password==$row['pass']){
                     $userid=$row['userid'];
                     $result=mysql_query("select userid,type,url,adminpages from freniz where userid='".$userid."'");
                     while($row2=  mysql_fetch_assoc($result))
                     {
                        if($row2['type']=='user')
                         {
                            $results1=mysql_query("select profiletype,fname,lname,dob,sex,school,college,email,hometown,currentcity,language,rstatus,employer,religion,myphilosophy,state,country,propic,pinnedpic,books,musics,movies,celebrities,games,sports,other,playlist,mood,style,secondarypic1,secondarypic2,propicalbum,secondarypicalbum,adminpages,url,blocklist,blockedby,reviews,reqfrmme,personalinfo,country from user_info where userid='".$userid."'");
                             while($row1=  mysql_fetch_assoc($results1))
                             {
                                 $_SESSION['userid']=$userid;
                                 $_SESSION['username']=$row1['fname'].' '.$row1['lname'];
                                 $_SESSION['fname']=$row1['fname'];
                                 $_SESSION['lname']=$row1['lname'];
                                 $_SESSION['dob']=$row1['dob'];
                                 $_SESSION['sex']=$row1['sex'];
                                 $_SESSION['rstatus']=$row1['rstatus'];
                                 $_SESSION['religion']=$row1['religion'];
                                 $_SESSION['currentcity']=$row1['currentcity'];
                                 $_SESSION['hometown']=$row1['hometown'];
                                 $_SESSION['mood']=$row1['mood'];
                                  $_SESSION['theme']=$row1['style'];
                                 $_SESSION['employer']=unserialize($row1['employer']);
                                 $_SESSION['school']=unserialize($row1['school']);
                                 $_SESSION['college']=unserialize($row1['college']);
                                 $_SESSION['language']=unserialize($row1['language']);
                                 
                                 $_SESSION['blocklist']=unserialize($row1['blocklist']);
                                 $_SESSION['blockedby']=unserialize($row1['blockedby']);
                                 $_SESSION['reviews']=unserialize($row1['reviews']);
                                 $_SESSION['reqfrmme']=unserialize($row1['reqfrmme']);

                                 $_SESSION['userdetails']=$row1;
                                 $_SESSION['books']=unserialize($row1['books']);
                                 $_SESSION['musics']=unserialize($row1['musics']);
                                 $_SESSION['movies']=unserialize($row1['movies']);
                                 $_SESSION['celebrities']=unserialize($row1['celebrities']);
                                 $_SESSION['games']=unserialize($row1['games']);
                                 $_SESSION['sports']=unserialize($row1['sports']);
                                 $_SESSION['other']=unserialize($row1['other']);
                                 
                                 
                                 $_SESSION['playlist']=unserialize($row1['playlist']);
                                 
                                 
                                 $result3=mysql_query("select diary from apps where userid='".$userid."'");
                                 while($row3=  mysql_fetch_assoc($result3))
                                 {
                                     $_SESSION['diary']=unserialize($row3['diary']);
                                     
                                 }
                                 $results2=mysql_query("select friendlist,vote,voted,sentrequest,incomingrequest from friends_vote where userid='".$userid."'");
                                 while($row2=  mysql_fetch_assoc($results2))
                                 {
                                     $_SESSION['friends']=unserialize($row2['friendlist']);
                                     $_SESSION['votes']=unserialize($row2['vote']);
                                     $_SESSION['voted']=unserialize($row2['voted']);
                                     $_SESSION['sentrequest']=unserialize($row2['sentrequest']);
                                     $_SESSION['bendingrequest']=unserialize($row2['incomingrequest']);
                                 }
                                 $_SESSION['type']='user';
                                 $_SESSION['propic']=$row1['propic'];
                                 $_SESSION['password']=$password;
                                 $_SESSION['adminpages']=unserialize($row1['adminpages']);
                                 $_SESSION['url']=$row1['url'];
                                 $_SESSION['useracc']=$userid;
                                 $_SESSION['useracctype']='user';
                                 $ou=mysql_query('select onlineusers from initapp');
                                 $users=array();
                                 if(mysql_num_rows($ou)){
                                    while($row=mysql_fetch_assoc($ou))
                                    {
                                        if(isset($row['onlineusers']))
                                            $users=unserialize($row['onlineusers']);
                                        array_push($users,$userid );
                                        mysql_query("update initapp set onlineusers='".serialize($users)."'");
                                    }
                                 }
                                 else {
                                     array_push($users, $userid);
                                      mysql_query("insert into initapp(onlineusers) values('".serialize($users)."')");
                                 }
                             }
                             mysql_close();
                             return "true";
                         }
                         else if($row2['type']=='none')
                         {
                             $adminpages=unserialize($row2['adminpages']);
                             $_SESSION['userid']=$userid;    
                             $_SESSION['password']=$password;
                             $_SESSION['adminpages']=unserialize($row1['adminpages']);
                             $_SESSION['url']=$row1['url'];
                             $_SESSION['useracc']=$userid;
                             $_SESSION['useracctype']=='none';
                             if(sizeof($adminpages)>=1)
                             {
                                 validatepage(reset($adminpages));
                             }
                         }
                     }
                           
                 }
                 else
                 {
                     mysql_close();
                     return "false";
                 }
             }

     }
     else
     {
         mysql_close();
         return "false";
     }
     
}
function validatepage($pageid){
        if(isset($pageid) && isset($_SESSION['userid'])){
            mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $results=mysql_query("select pagename,url,admins,pagepic,vote from pages where pageid='".$pageid."'"); 
        if(mysql_num_rows($results)){
             while($row=mysql_fetch_assoc($results))
             {
                 if(in_array($_SESSION['userid'], unserialize($row['admins']))){
                    $_SESSION['propic']=$row['pagepic'];
                    $_SESSION['votes']=$row['vote'];
                    $_SESSION['userid']=$_REQUEST['pageid'];
                    $_SESSION['username']=$row['pagename'];
                    $_SESSION['type']='page';
                    $_SESSION['url']=$row['url'];
                    $_SESSION['friends']=array();
                    unset ($_SESSION['sentrequest']);
                    unset ($_SESSION['bendingrequest']);
                 }
             }
        }
        mysql_close();
     }
     else
     {
         return "false";
     }
     
}
?>
