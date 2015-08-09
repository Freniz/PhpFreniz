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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<style>
.curve {
    -moz-border-radius : 25px; /* Firefox */
    -webkit-border-radius :25px; /* Safari & Chrome */
    -khtml-border-radius : 25px; /* Linux browsers */
    border-radius : 25px; /* CSS3 compatible browsers */
}
body {
    margin: 0;
    padding: 0;
    text-align: center; /* !!! */
}
.centered {
    margin: 0 auto;
    text-align: left;
    width: 1024px;
	
}
</style>

</head>

<body>

<div class="centered" style="border:solid 1px">


<div id="fourth" style="width:900px; margin-left:50px; height:60px; border:solid 1px">
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">
</div>
<div class="curve" style="width:50px; height:50px;float:left; border:solid 1px">
<p style="text-align:center; margin-top:15px">1</p>
</div>
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">
</div>
<div class="curve" style="width:50px; height:50px;float:left; border:solid 1px">
<p style="text-align:center; margin-top:15px">2</p>
</div>
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">
</div>
<div class="curve" style="width:50px; height:50px;float:left; border:solid 1px">
<p style="text-align:center; margin-top:15px">3</p>
</div>
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">
</div>
<div class="curve" style="width:50px;  background-color:#3F0; height:50px;float:left; border:solid 1px">
<p style="text-align:center; margin-top:15px">4</p>
</div>
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">
</div>
<div class="curve" style="width:50px; height:50px;float:left; border:solid 1px">
<p style="text-align:center; margin-top:15px">5</p>
</div>
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">

</div>



</div>


<div style="width:1024px; border:solid 1px">
<div style=" border:solid 1px">
Favourites:<select style="width:100px"><option value="-1">Select:</option><option value="1">Books</option><option value="2">Music</option><option value="3">Movies</option><option value="4">Celebrities</option><option value="5">Games</option><option value="6">Sports</option><option value="7">Extra</option></select>
</div>

</div>

<div style="width:1024px; text-align:center; border:solid 1px">
<input type="text" style="width:400px; height:20px" />
</div>
<div style="width:1024px; margin-top:20px;border:solid 1px">
<div style=" width:600px; margin:0 auto; height:400px; border:solid 1px">
</div>
</div>


<div style="width:1024px; height:30px;border:solid 1px">
<input style="float:right" type="button" value="Go"/>
<input style="float:right" type="button" onclick="window.location.href='tab-third.php'" value="Back"/>
<input style="float:right" type="button" onclick="window.location.href='tab-fifth.php'" value="Skip"/>
</div>

</div>




</body>
</html>
