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
<script type="text/javascript" src="js/ajax.js"></script>

</head>

<body>
<?php echo $_SESSION['userid']; ?>
<div class="centered" style="border:solid 1px">

<div id="second" style="width:900px; margin-left:50px; height:60px; border:solid 1px">
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">
</div>
<div class="curve" style="width:50px; height:50px;float:left; border:solid 1px">
<p style="text-align:center; margin-top:15px">1</p>
</div>
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">
</div>
<div class="curve" style="width:50px; background-color:#3F0; height:50px;float:left; border:solid 1px">
<p style="text-align:center; margin-top:15px">2</p>
</div>
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">
</div>
<div class="curve" style="width:50px; height:50px;float:left; border:solid 1px">
<p style="text-align:center; margin-top:15px">3</p>
</div>
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">
</div>
<div class="curve" style="width:50px; height:50px;float:left; border:solid 1px">
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

 <div style=" width:600px; height:750px; float:left; ">
        <?php $personalinfo = unserialize($_SESSION['userdetails']['personalinfo'])?>
        
<div style="width:600px; height:80px; float:left; border:solid 1px">
    Body:<input type="text" value="<?php if(isset( $personalinfo['body'])) echo $personalinfo['body']; ?>" id="body_tpe" name="body_type" />
   

</div>

        <div style="width:600px; height:80px; float:left; border:solid 1px">
    Look:<input type="text" value="<?php if(isset( $personalinfo['look'])) echo $personalinfo['look']; ?>" id="look_tpe" name="look_type" />
   

</div>
        <div style="width:600px; height:80px; float:left; border:solid 1px">
    Ethicity:<input type="text" value="<?php if(isset( $personalinfo['ethnicity'])) echo $personalinfo['ethnicity']; ?>" id="ethnicity_tpe" name="ethnicity_type" />
   

</div>
        <div style="width:600px; height:80px; float:left; border:solid 1px">
    Smoking:<input type="text" value="<?php if(isset( $personalinfo['smoke'])) echo $personalinfo['smoke']; ?>" id="smoke_tpe" name="smoke_type" />
   

</div>
        <div style="width:600px; height:80px; float:left; border:solid 1px">
    Drinking:<input type="text" value="<?php if(isset( $personalinfo['drink'])) echo $personalinfo['drink']; ?>" id="drink_tpe" name="drink_type" />
   

</div>
        <div style="width:600px; height:80px; float:left; border:solid 1px">
    Pet:<input type="text" value="<?php if(isset( $personalinfo['pets'])) echo $personalinfo['pets']; ?>" id="pet_tpe" name="pet_type" />
   

</div>
        <div style="width:600px; height:80px; float:left; border:solid 1px">
    Sexual:<input type="text" value="<?php if(isset( $personalinfo['sexual'])) echo $personalinfo['sexual']; ?>" id="sexual_tpe" name="sexual_type" />
   

</div>
        <div style="width:600px; height:80px; float:left; border:solid 1px">
    Humor:<input type="text" value="<?php if(isset( $personalinfo['humor'])) echo $personalinfo['humor']; ?>" id="humor_tpe" name="humor_type" />
   

</div>
<div style="width:600px; height:80px; float:left; border:solid 1px">
    Passions:<input type="text" value="<?php if(isset( $personalinfo['passion'])) echo $personalinfo['passion']; ?>" id="passion_tpe" name="passion_type" />
   

</div>

 
</div>


<div style="width:1024px;float:left;border:solid 1px">
<input style="float:right" type="button" onclick="personalinfo();window.location.href='tab-third.php';" value="Go"/>
<input style="float:right" type="button" onclick="window.location.href='tab-third.php'" value="Skip"/>
</div>

</div>




</body>
</html>
