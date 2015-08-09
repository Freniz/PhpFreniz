<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>
<?php
    $output=  json_encode(array("status"=>"comment already removed"));
    if(isset($_REQUEST['commentid']) && isset($_SESSION['userid'])){
        mysql_connect("localhost", "nizam", "ajith786") or die("coudnt connect to the database");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $result=mysql_query("select userid,imageid from image_comments where commentid='".$_REQUEST['commentid']."'");
        while($row=  mysql_fetch_assoc($result))
        {
            if($row['userid']==$_SESSION['userid'])
            {
                mysql_query("delete from image_comments where commentid='".$_REQUEST['commentid']."'");
                $output=json_encode(array("status"=>"comment removed"));
            }
            else
            {
                
                $result1=mysql_query("select userid,albumid from image where imageid='".$row['imageid']."'");
                while($row1=mysql_fetch_array($result1))
                {
                    if($row1['userid']==$_SESSION['userid'] )
                        mysql_query("delete from image_comments where commentid='".$_REQUEST['commentid']."'");
                      else
                      {
                          $result2=mysql_query("select userid from album where albumid='".$row1['albumid']."'");
                            while($row2=  mysql_fetch_assoc($result2))
                            {
                                if($row2['userid']==$_SESSION['userid'] ){
                                    mysql_query("delete from image_comments where commentid='".$_REQUEST['commentid']."'");
                                    $output=json_encode(array("status"=>"comment removed"));
                                }
                                else
                                  $output=json_encode(array("status"=>"you dont have permission to delete this comment"));  
                            }
                      }
                   }
                }
            }
            mysql_close();
        
        }
        else
            $output=json_encode(array("status"=>"please give valid information for this operation"));
        echo $output;
?>