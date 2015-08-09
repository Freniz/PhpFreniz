<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/style.css" rel="stylesheet" />
<script type="text/javascript" src="js/audio-player.js"></script>
<script type="text/javascript" src='js/ajax.js'></script>
<script type="text/javascript">  
            AudioPlayer.setup("player3.swf", {  
                width: 290  
            });  
            var valid;
            
            
            function validateurl1()
            {
                alert(2);
                AudioPlayer.getPlayer('audioplayer_1').open();
            }
            
            function validateurl()
            {
                valid=true;
                AudioPlayer.embed("audioplayer_1", {soundFile: document.getElementById('songurl').value});
                alert(1);
                validateurl1()
            }
            
            
        </script>  
</head>

<body>
<div  style=" width:1000px; float:left; border:solid 1px">
<div class="headerfont" style="width:200px; height:100; float:left; border:solid 1px">
Music World
</div>

<div class="headerfont" style="width:700px; margin-top:50px;height:200px; float:left; border:solid 1px">
Songs
  <div style="float:left; margin-left:50px;">
<table class="subfont" style="width:600px">
        <tr>
        <td>Song Name:</td><td><input type="text" id="songname" name="username" size="60"/></td></tr>
        <tr>
        <td>URL:</td><td><input type="text" id='songurl' name="password" size="60"/></td></tr>
        </table>
  </div> 
<div style="width:300px; height: 30px; margin-top: 20px; float: left; border: solid 1px">
    <p id="audioplayer_1" style=" background-color:#333"></p>
</div>
  <div>
  <div style=" width:100px; margin-right:60px; margin-top:20px; height:40px; float:right">
 <ul class="roundbuttons singlerdwidth" >
        <li><a onclick="createsong()">Add</a></li><li><a onclick="validateurl()">validate</a></li>
        </ul>
</div>

  </div>    

</div>

<div class="headerfont" style="width:800px; float:left">
<ul>
<?php mysql_connect('localhost', 'nizam', 'ajith786');
 mysql_select_db('fztest1');
 $query="select pageid,pagename,url from pages where ";
 $i=0;
 foreach($_SESSION['playlist'] as $song){
 $i++;
 if($i!=count($_SESSION['playlist']))
     $query.=" pageid='$song' or";
 else
     $query.=" pageid='$song'";
 }
$result=  mysql_query($query);
while($row=  mysql_fetch_assoc($result)){
    
?>
    <li>
        <?php echo "<a href='leaf.php?leafid=".$row['pageid']."' >".$row['pagename']."</a>"; ?>
    </li>
    <?php } ?>
</ul>    <div>
</div>
</div>




</div>

</body>
</html>
