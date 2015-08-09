<?php
set_time_limit(0);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
mysql_connect('localhost','root','') or die(mysql_error());
    mysql_select_db("fztest2") or die ("coudnt find database");    

$query= "select distinct code from admin1codesascii"; 
  $result=  mysql_query($query);
  while ($row = mysql_fetch_assoc($result)) {

      /*mysql_query("CREATE TABLE `activity_".$row['iso_alpha2']."` (
  `userid` varchar(30) NOT NULL,
  `ruserid` varchar(30) NOT NULL,
  `contentid` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `contenttype` varchar(30) NOT NULL,
  `contenturl` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  KEY `userid` (`userid`),
  KEY `ruserid` (`ruserid`),
  FOREIGN KEY (`userid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`ruserid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB ;");  
      echo mysql_error();
      mysql_query("CREATE TABLE `album_".$row['iso_alpha2']."` (
  `albumid` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `date` datetime default NULL,
  `pt` varchar(20) NOT NULL default 'public',
  `specificlist` blob NOT NULL,
  `hiddenlist` blob NOT NULL,
  `canupload` varchar(20) NOT NULL default 'private',
  `ignorelist` blob NOT NULL,
  PRIMARY KEY  (`albumid`),
  KEY `userid` (`userid`),
  FOREIGN KEY (`userid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 ;");
      echo mysql_error();
    mysql_query("CREATE TABLE `apps_".$row['iso_alpha2']."` (
  `userid` varchar(30) NOT NULL,
  `slambook` blob,
  `diary` blob,
  `inivitation` blob,
  PRIMARY KEY  (`userid`),
  FOREIGN KEY (`userid`) REFERENCES `user_info_".$row['iso_alpha2']."` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB ;");
    echo mysql_error();
    mysql_query("CREATE TABLE `blog_".$row['iso_alpha2']."` (
  `blogid` int(11) NOT NULL auto_increment,
  `userid` varchar(30) NOT NULL,
  `blog` blob NOT NULL,
  `vote` blob NOT NULL,
  `date` datetime default NULL,
  `pt` varchar(20) NOT NULL default 'public',
  `specificlist` blob NOT NULL,
  `hiddenlist` blob NOT NULL,
  PRIMARY KEY  (`blogid`),
  KEY `userid` (`userid`),
  FOREIGN KEY (`userid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB ;");
    echo mysql_error();
    mysql_query("CREATE TABLE `comment_".$row['iso_alpha2']."` (
  `commentid` int(11) NOT NULL auto_increment,
  `statusid` int(11) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `comment` blob,
  `vote` blob,
  `date` datetime default NULL,
  PRIMARY KEY  (`commentid`),
  KEY `statusid` (`statusid`),
  KEY `userid` (`userid`),
  FOREIGN KEY (`statusid`) REFERENCES `status_".$row['iso_alpha2']."` (`statusid`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`userid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB ;");
    echo mysql_error();
    mysql_query("CREATE TABLE `friends_vote_".$row['iso_alpha2']."` (
  `userid` varchar(30) NOT NULL,
  `friendlist` blob,
  `incomingrequest` blob,
  `sentrequest` blob,
  `vote` blob,
  `voted` blob NOT NULL,
  KEY `userid` (`userid`),
  FOREIGN KEY (`userid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB ;");
    echo mysql_error();
    mysql_query("CREATE TABLE `image_".$row['iso_alpha2']."` (
  `imageid` int(11) NOT NULL auto_increment,
  `url` varchar(300) NOT NULL,
  `pinnedpeople` blob,
  `vote` blob,
  `userid` varchar(30) NOT NULL,
  `albumid` int(11) NOT NULL,
  `date` datetime default NULL,
  `title` varchar(100) default 'Image',
  `description` text,
  `pt` varchar(20) NOT NULL default 'public',
  `specificlist` blob NOT NULL,
  `hiddenlist` blob NOT NULL,
  `notifyusers` blob NOT NULL,
  `reqpinusers` blob NOT NULL,
  `accepted` varchar(20) default 'not',
  `pinmereq` blob NOT NULL,
  `comments` blob NOT NULL,
  PRIMARY KEY  (`imageid`),
  KEY `userid` (`userid`),
  KEY `albumid` (`albumid`),
  FOREIGN KEY (`userid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`albumid`) REFERENCES `album_".$row['iso_alpha2']."` (`albumid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=392 ;
");
    echo mysql_error();
    mysql_query("CREATE TABLE `image_comments_".$row['iso_alpha2']."` (
  `commentid` int(11) NOT NULL auto_increment,
  `imageid` int(11) NOT NULL,
  `comment` blob NOT NULL,
  `userid` varchar(30) NOT NULL,
  `vote` blob,
  `date` datetime default NULL,
  PRIMARY KEY  (`commentid`),
  KEY `imageid` (`imageid`),
  KEY `userid` (`userid`),
  FOREIGN KEY (`imageid`) REFERENCES `image_".$row['iso_alpha2']."` (`imageid`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`userid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 ;
");
    echo mysql_error();
    mysql_query("CREATE TABLE `invites_".$row['iso_alpha2']."` (
  `inviteid` int(11) NOT NULL auto_increment,
  `suserid` varchar(30) NOT NULL,
  `ruserid` varchar(30) NOT NULL,
  `text` text,
  `songurl` varchar(200) default NULL,
  `imageurl` varchar(100) default NULL,
  PRIMARY KEY  (`inviteid`),
  KEY `suserid` (`suserid`),
  KEY `ruserid` (`ruserid`),
  FOREIGN KEY (`suserid`) REFERENCES `user_info_".$row['iso_alpha2']."` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`ruserid`) REFERENCES `user_info_".$row['iso_alpha2']."` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB ;
");
    echo mysql_error();
    mysql_query("CREATE TABLE `message_".$row['iso_alpha2']."` (
  `messageid` int(11) NOT NULL auto_increment,
  `suserid` varchar(30) NOT NULL,
  `ruserid` varchar(30) NOT NULL,
  `message` blob NOT NULL,
  `read1` int(1) default NULL,
  `date` datetime default NULL,
  `ruservisi` varchar(20) NOT NULL default 'visible',
  `suservisi` varchar(20) NOT NULL default 'visible',
  PRIMARY KEY  (`messageid`),
  KEY `suserid` (`suserid`),
  KEY `ruserid` (`ruserid`),
  FOREIGN KEY (`suserid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`ruserid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 ;");
    echo mysql_error();
    mysql_query("CREATE TABLE `notification_".$row['iso_alpha2']."` (
  `userid` varchar(30) NOT NULL,
  `notifications` blob NOT NULL,
  PRIMARY KEY  (`userid`),
  FOREIGN KEY (`userid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB ;");
    echo mysql_error();
    mysql_query("CREATE TABLE `page_info_".$row['iso_alpha2']."` (
  `pageid` varchar(30) default NULL,
  `description` text,
  `about` text,
  `releasedate` date default NULL,
  `ISBN` varchar(20) default NULL,
  `publisher` varchar(100) default NULL,
  `author` varchar(100) default NULL,
  `starring` varchar(300) default NULL,
  `directedby` varchar(100) default NULL,
  `producedby` varchar(100) default NULL,
  `genere` varchar(300) default NULL,
  `members` varchar(300) default NULL,
  `recordlabel` varchar(300) default NULL,
  `location` varchar(300) default NULL,
  `bday` date default NULL,
  `awards` text,
  `gender` varchar(20) default NULL,
  `email` varchar(50) default NULL,
  `biography` text,
  `founded` date default NULL,
  `mission` text,
  `region` varchar(200) default NULL,
  `country` varchar(100) default NULL,
  `overview` text,
  `nearby` text,
  `address` text,
  `city` varchar(300) default NULL,
  `zip` varchar(30) default NULL,
  `phone` varchar(20) default NULL,
  KEY `pageid` (`pageid`),
  FOREIGN KEY (`pageid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB ;");
    echo mysql_error();
    mysql_query("CREATE TABLE `pageprivacy_".$row['iso_alpha2']."` (
  `pageid` varchar(30) NOT NULL,
  `post` varchar(20) NOT NULL default 'public',
  PRIMARY KEY  (`pageid`)
) ENGINE=InnoDB ;");
    echo mysql_error();
    mysql_query("CREATE TABLE `pages_".$row['iso_alpha2']."` (
  `pageid` varchar(30) default NULL,
  `pagename` varchar(200) default NULL,
  `creator` varchar(30) NOT NULL,
  `admins` blob,
  `pagepic` varchar(100) default '3',
  `vote` blob,
  `date` datetime default NULL,
  `website` text,
  `views` int(11) default '0',
  `type` varchar(30) default NULL,
  `category` varchar(100) default NULL,
  `url` varchar(200) NOT NULL,
  `bannedusers` blob NOT NULL,
  `canpost` varchar(20) default 'public',
  `subcategory` varchar(100) default NULL,
  `bids` decimal(10,0) default '0',
  `place` varchar(30) default NULL,
  UNIQUE KEY `url` (`url`),
  KEY `creator` (`creator`),
  KEY `pageid` (`pageid`),
  FOREIGN KEY (`creator`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`pageid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`url`) REFERENCES `freniz` (`url`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB ;");
    echo mysql_error();
    mysql_query("CREATE TABLE `pages_info_".$row['iso_alpha2']."` (
  `pageid` varchar(30) NOT NULL,
  `info` blob,
  `tabs` blob,
  `songurl` text,
  PRIMARY KEY  (`pageid`),
  FOREIGN KEY (`pageid`) REFERENCES `pages_".$row['iso_alpha2']."` (`pageid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB ;");
    echo mysql_error();
    mysql_query("CREATE TABLE `privacy_".$row['iso_alpha2']."` (
  `userid` varchar(30) NOT NULL,
  `contactdetails` varchar(20) NOT NULL default 'public',
  `religion` varchar(20) NOT NULL default 'public',
  `dob` varchar(20) NOT NULL default 'public',
  `aboutme` varchar(20) NOT NULL default 'public',
  `relationship` varchar(20) NOT NULL default 'public',
  `livingin` varchar(20) NOT NULL default 'public',
  `hometown` varchar(20) NOT NULL default 'public',
  `languages` varchar(20) NOT NULL default 'public',
  `education` varchar(20) NOT NULL default 'public',
  `occupation` varchar(20) NOT NULL default 'public',
  `friendlist` varchar(20) NOT NULL default 'public',
  `status` varchar(20) NOT NULL default 'public',
  `fav` varchar(20) NOT NULL default 'public',
  `message` varchar(30) NOT NULL default 'public',
  `request` varchar(20) NOT NULL default 'public',
  `invite` varchar(20) NOT NULL default 'public',
  `post` varchar(20) NOT NULL default 'friends',
  `postignore` blob NOT NULL,
  `postvisi` varchar(20) NOT NULL default 'public',
  `postspeci` blob NOT NULL,
  `posthidden` blob NOT NULL,
  `testy` varchar(20) NOT NULL default 'friends',
  `testyignore` blob NOT NULL,
  `testyvisi` varchar(20) NOT NULL default 'public',
  `testyspeci` blob NOT NULL,
  `testyhidden` blob NOT NULL,
  `blogvisi` varchar(20) NOT NULL default 'public',
  `blogspeci` blob NOT NULL,
  `bloghidden` blob NOT NULL,
  `advancedprivacypost` varchar(20) default 'on',
  `autoacceptusers` blob NOT NULL,
  `blockactivityusers` blob NOT NULL,
  `hidestreams` blob NOT NULL,
  `hideusersstream` blob NOT NULL,
  `advancedprivacyimage` varchar(20) default 'on',
  `advancedprivacyadmire` varchar(20) default 'on',
  `advancedprivacypin` varchar(20) default 'on',
  PRIMARY KEY  (`userid`),
  FOREIGN KEY (`userid`) REFERENCES `user_info_".$row['iso_alpha2']."` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB ;
");
    echo mysql_error();
   /* mysql_query("CREATE TABLE `status_".$row['iso_alpha2']."` (
  `statusid` int(11) NOT NULL auto_increment,
  `suserid` varchar(30) NOT NULL,
  `ruserid` varchar(30) NOT NULL,
  `vote` blob,
  `date` datetime default NULL,
  `status` text NOT NULL,
  `commentcount` int(11) NOT NULL default '0',
  `pt` varchar(20) NOT NULL default 'public',
  `specificlist` blob,
  `hiddenlist` blob,
  `notifyusers` blob NOT NULL,
  `accepted` varchar(20) default 'not',
  `comments` blob NOT NULL,
  PRIMARY KEY  (`statusid`),
  KEY `suserid` (`suserid`),
  KEY `ruserid` (`ruserid`),
  FOREIGN KEY (`suserid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`ruserid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 ;
");
    echo mysql_error();
    mysql_query("CREATE TABLE `testimonial_".$row['iso_alpha2']."` (
  `testyid` int(11) NOT NULL auto_increment,
  `suserid` varchar(30) NOT NULL,
  `ruserid` varchar(30) NOT NULL,
  `message` blob NOT NULL,
  `vote` blob,
  `date` datetime default NULL,
  `pt` varchar(20) NOT NULL default 'public',
  `specificlist` blob NOT NULL,
  `hiddenlist` blob NOT NULL,
  `accpeted` varchar(20) default 'not',
  PRIMARY KEY  (`testyid`),
  KEY `suserid` (`suserid`),
  FOREIGN KEY (`suserid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 ;
");
    echo mysql_error();
    mysql_query("CREATE TABLE `user_info_".$row['iso_alpha2']."` (
  `userid` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `dob` date default NULL,
  `sex` varchar(6) NOT NULL,
  `school` blob,
  `college` blob,
  `email` varchar(50) NOT NULL,
  `hometown` varchar(100) default NULL,
  `currentcity` varchar(100) default NULL,
  `language` blob,
  `rstatus` varchar(10) default NULL,
  `employer` blob,
  `religion` varchar(30) default NULL,
  `myphilosophy` varchar(300) default NULL,
  `musics` blob,
  `books` blob,
  `movies` blob,
  `games` blob,
  `celebrities` blob,
  `other` blob,
  `state` varchar(50) default NULL,
  `country` varchar(50) default NULL,
  `date` datetime default NULL,
  `propic` varchar(100) default '1',
  `pinnedpic` blob,
  `sports` blob,
  `playlist` blob,
  `mood` varchar(30) NOT NULL default 'happy.png',
  `secondarypic1` varchar(100) NOT NULL default '4',
  `secondarypic2` varchar(100) NOT NULL default '5',
  `propicalbum` int(11) default '0',
  `pinnedpicalbum` int(11) default '0',
  `profiletype` varchar(30) default 'public',
  `adminpages` blob,
  `url` varchar(200) NOT NULL,
  `pt` varchar(20) NOT NULL default 'public',
  `blocklist` blob NOT NULL,
  `blockedby` blob NOT NULL,
  `reviews` blob NOT NULL,
  `reqfrmme` blob NOT NULL,
  `secondarypicalbum` int(11) default NULL,
  PRIMARY KEY  (`userid`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `url` (`url`),
  FOREIGN KEY (`userid`) REFERENCES `freniz` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`url`) REFERENCES `freniz` (`url`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB ;");
    echo mysql_error();
    mysql_query("CREATE TABLE `userstable_".$row['iso_alpha2']."` (
  `userid` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=InnoDB ;");
    echo mysql_error();
    mysql_query("insert into userstable_".$row['iso_alpha2']." values('default','ajith786','freniz2k1@gmail.com');");
    echo mysql_error();
    mysql_query("insert into user_info_".$row['iso_alpha2']."(userid,fname,lname,sex,email,url,blocklist,blockedby,reviews,reqfrmme) values('default','default','default','male','default@freniz.com','freniz.com','a:0:{}','a:0:{}','a:0:{}','a:0:{}');");
    echo mysql_error();
    mysql_query("insert into album_".$row['iso_alpha2']." values('1','default','default',now(),'public','a:0:{}','a:0:{}','private','a:0:{}');");
    echo mysql_error();
    mysql_query("insert into image_".$row['iso_alpha2']." (imageid,url,userid,albumid,date,specificlist,hiddenlist,notifyusers,reqpinusers,pinmereq,comments) values('1','default.jpg','default','1',now(),'a:0:{}','a:0:{}','a:0:{}','a:0:{}','a:0:{}','a:0:{}');");
    echo mysql_error();
    mysql_query("insert into image_".$row['iso_alpha2']." (imageid,url,userid,albumid,date,specificlist,hiddenlist,notifyusers,reqpinusers,pinmereq,comments) values('2','default_album.jpg','default','1',now(),'a:0:{}','a:0:{}','a:0:{}','a:0:{}','a:0:{}','a:0:{}');");
    echo mysql_error();
    mysql_query("insert into image_".$row['iso_alpha2']." (imageid,url,userid,albumid,date,specificlist,hiddenlist,notifyusers,reqpinusers,pinmereq,comments) values('3','default_page.jpg','default','1',now(),'a:0:{}','a:0:{}','a:0:{}','a:0:{}','a:0:{}','a:0:{}');");
    echo mysql_error();
    */
     
 /*mysql_query('drop table userstable_'.$row['iso_alpha2']);
 mysql_query('drop table activity_'.$row['iso_alpha2']);
 mysql_query('drop table album_'.$row['iso_alpha2']);
 mysql_query('drop table comment_'.$row['iso_alpha2']); 
 mysql_query('drop table pageprivacy_'.$row['iso_alpha2']);
   */
      /*mysql_query('alter table user_info_'.$row['iso_alpha2'].' add personalinfo blob');*/
      
      $tablename=explode(".", $row['code']);
      $tablename=implode("_", $tablename);
      mysql_query("create table usernames_$tablename (username varchar(100) primary key,userids text)engine=innodb default charset=utf8");
 
     echo "create table usernames_$tablename (username varchar(100) primary key,userids text)engine=innodb default charset=utf8";
}

?>
